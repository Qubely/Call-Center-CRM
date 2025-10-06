<?php

namespace App\Repositories\Admin\System\User\Crud;

use App\Http\Requests\Admin\System\User\Crud\ValidateUpdateAdminUser;
use App\Models\AdminUser;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Webpatser\Uuid\Uuid;
use Image;
use Hash;
class  AdminUserCrudRepository extends BaseRepository implements IAdminUserCrudRepository {

    use BaseTrait;
    public function __construct() {
        $this->LoadModels(['AdminUser']);
        $this->sizes =  [
            ['width'=> 400, 'height'=> 400,'com'=> 70],
            ['width'=> 80, 'height'=> 80,'com'=> 10],
        ];
    }

    /**
     * Get the page default resource
     *
     * @param Request $request
     * @param integer|string $id
     * @return array
     */
    public function index($request,$id=null) : array
    {
       return $this->getPageDefault(model: $this->AdminUser, id: $id);
    }


    /**
     * Yajra datatbale list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list($request) : JsonResponse
    {
        $model = AdminUser::query();
        return DataTables::of($model)
        ->editColumn('created_at', function($item) {
            return  Carbon::parse($item->created_at)->format('d-m-Y');
        })
        ->addColumn('image', function($item) {
            $image = getRowImage($item);
            return  "<img src='$image'  class='img-fluid'/>";
        })
        ->editColumn('status', function($item) {
            return  ($item?->status == 'Active') ? "<span class='badge bg-success'> Active </span>" : "<span class='badge bg-danger'> Disabled </span>";
        })
        ->escapeColumns([])
        ->make(true);
    }

    /**
     *  Bulk update list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateList($request) : JsonResponse
    {
        $i = AdminUser::whereIn('id',$request->ids)->select(['id','name'])->get();;
        $dirty = [];
        if (count($i) > 0) {
            foreach ($i as $key => $value) {
                //$value->serial = $request->serial[$value->id];
                if ($value->isDirty()) {
                    $dirty[$key] = "yes";
                }
            }
            if (count($dirty) > 0) {
                foreach ($i as $key => $value) {
                    $value->save();
                }
                $data['extraData'] = [
                    "inflate" => 'Updated successfully'
                ];
                return $this->response(['type' => 'success','data' => $data]);
            } else {
                return $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-success"> You made no changes </span>']);
            }

        } else {
            return $this->response(['type' => 'noUpdate', 'title' => 'Something went wrong, try again']);
        }
    }

    /**
     * Bulk delete list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteList($request) : JsonResponse
    {
        $errors = [];
        $i = AdminUser::whereIn('id',$request->ids)->select(['id'])->get();
        if (count($i) > 0) {
            // $errors = $this->checkInUse([
            //     "rows" => $i,
            //     "search" => ["id","id"],
            //     "denined" => ["name","name"],
            //     "targetModel" => [$this->StudentAdmission,$this->ExamResult],
            //     "targetCol" => ["lib_category_id","lib_category_id"],
            //     "exists" => ["Class Category","Class Category"],
            //     "in" => ["Stduent Table","Result Table"]
            // ]);
            if (count($errors) > 0) {
                return $this->response(['type'=>'bigError','errors'=>$errors]);
            }
            foreach ($i as $key => $value) {
                $value->delete();
            }
            $data['extraData'] = [
                "inflate" => "Deleted successfuly",
                "redirect" => null
            ];
            return $this->response(['type' => 'success',"data"=>$data]);
        } else {
            return $this->response(['type' => 'noUpdate', 'title' => 'No selected data found, try again']);
        }
    }

    /**
     * Store resource
     *
     * @param Request  $request
     * @return JsonResponse
     */
    public function store($request) : JsonResponse
    {
        try {
            $m = new AdminUser;
            $m->uuid = (string)Uuid::generate(4);
            $m->name = $request->name;
            $m->mobile_number = $request->mobile_number;
            $m->email = $request->email;
            $m->admin_type = $request->admin_type;
            $m->password = Hash::make('123456789');
            $m->user_access = json_encode(['SA']);
            $path = imagePaths()['dyn_image'];
            $image = $request->file('image');
            if ($request->hasFile('image')) {
                $image_link = (string) Uuid::generate(4);
                $extension = $image->getClientOriginalExtension();
                $image = $this->imageVersioning([
                    'image' => $image, 'path' => $path, 'image_link' => $image_link, 'extension' => $extension,
                    'appendSize' => true,
                    'onlyAppend' => $this->sizes
                ]);
                $m->image = $image_link;
                $m->extension = $extension;
            }
            $m->save();
            $response['extraData'] = ['inflate' => 'Action succesfull' ];
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            $this->saveError($this->getSystemError(['name' => 'UqProfession_store_error']), $e);
            return $this->response(['type' => 'noUpdate', 'title' => 'Something went wrong, try again']);
        }
    }

    /**
     * Update resource
     *
     * @param Requets $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update($request,$id) : JsonResponse
    {
        $row = AdminUser::find($id);
        if(empty($row)){
            return  $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-danger">Requestd resource not found, try again </span>']);
        }
        $row->name = $request->name;
        $row->mobile_number = $request->mobile_number;
        $row->email = $request->email;
        $row->admin_type = $request->admin_type;
        $row->status = $request->status;
        $row->user_access = json_encode(['SA']);
        $path = imagePaths()['dyn_image'];
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $this->deleteImageVersions([
                'path' => imagePaths()['dyn_image'],
                'image_link' => $row->image,
                'extension' => $row->extension,
                'sizes' =>  $this->sizes
            ]);
            $image_link = (string) Uuid::generate(4);
            $extension = $image->getClientOriginalExtension();
            $image = $this->imageVersioning([
                'image' => $image, 'path' => $path, 'image_link' => $image_link, 'extension' => $extension,
                'appendSize' => true,
                'onlyAppend' => $this->sizes
            ]);
            $row->image =  $image_link;
            $row->extension = $extension;
        }
        if($row->isDirty()){
            $validator = Validator::make($request->all(), (new ValidateUpdateAdminUser())->rules($request,$row));
            if ($validator->fails()) {
                return $this->response(['type' => 'validation','errors' => $validator->errors()]);
            }
            try {
                $row->update($request->all());
                $data['extraData'] = ["inflate" => 'Action successfull'];
                return $this->response(['type' => 'success','data' => $data]);
            } catch (\Exception $e) {
                $this->saveError($this->getSystemError(['name'=>'LibAssociate_update_error']), $e);
                return $this->response(["type"=>"wrong","lang"=>"server_wrong"]);
            }
        } else {
            return $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-success">You made no changes </span>']);
        }
    }

}
