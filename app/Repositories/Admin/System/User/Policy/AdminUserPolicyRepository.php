<?php

namespace App\Repositories\Admin\System\User\Policy;

use App\Models\AdminUser;
use App\Models\AdminUserPermission;
use App\Models\AdminUserRole;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\JsonResponse;

class AdminUserPolicyRepository extends BaseRepository implements IAdminUserPolicyRepository {

    use BaseTrait;
    /**
     * View user policy view
     *
     * @param Request $request
     * @return array
     */
    public function index($request) : array
    {
        $data['availableUser'] = AdminUserRole::select(['code','name'])->whereNotIn('code',['SA'])->get();
        $data['systePolicies'] = $this->systemPolicies();
        $this->firstOrCreate($this->getFirstOrCreate($data['systePolicies'],$data['availableUser']));
        $data['permissions'] = AdminUserPermission::select(['id','slug','user_access'])->get();
        return $data;
    }

    /**
     * Update current user policy
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update($request) : JsonResponse
    {
       $row = AdminUser::find($id);
        if(empty($row)){
            return  $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-danger">'.pxLang($request->lang,'','common.no_resourse').'</span>']);
        }
        $row->fill($request->all());
        if($row->isDirty()){
            $validator = Validator::make($request->all(), (new ValidateUpdateAdminUser())->rules($request,$row));
            if ($validator->fails()) {
                return $this->response(['type' => 'validation','errors' => $validator->errors()]);
            }
            try {
                $row->update($request->all());
                $data['extraData'] = ["inflate" =>  pxLang($request->lang,'','common.action_success')];
                return $this->response(['type' => 'success','data' => $data]);
            } catch (\Exception $e) {
                $this->saveError($this->getSystemError(['name'=>'AdminUser_update_error']), $e);
                return $this->response(["type"=>"wrong","lang"=>"server_wrong"]);
            }
        } else {
            return $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-success">'.pxLang($request->lang,'','common.no_change').'</span>']);
        }
    }

    /**
     * List out user policies to be installed
     *
     * @param array $policies
     * @param array $users
     * @return array
     */
    private function getFirstOrCreate($policies,$users) : array
    {
        $data = [];
        foreach ($policies as $systemPolicy) {
            foreach ($systemPolicy['policies'] as $moduelPolicy) {
                foreach ($moduelPolicy['policies'] as $actionPolicy){
                    foreach ($actionPolicy['keys'] as $action){
                        $uniqueKey = getPolicyKey(\Str::class,$actionPolicy['name'].'_'.$action);
                        $data[] = [
                            "slug" => $uniqueKey
                        ];
                    }
                }
            }
        }
        return $data;
    }

    /**
     * Found or create role
     *
     * @param array $permissions
     * @return void
     */
    private function firstOrCreate($permissions) : void
    {
        foreach ($permissions as $perm) {
            AdminUserPermission::firstOrCreate(
                ['slug' => $perm['slug']],
            );
        }
    }
}
