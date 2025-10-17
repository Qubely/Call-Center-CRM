<?php

namespace App\Http\Controllers\Admin\DataLibrary\CampaignType\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\CampaignType\Crud\ValidateStoreLibCampaignType;
use App\Repositories\Admin\DataLibrary\CampaignType\Crud\ILibCampaignTypeCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibCampaignTypeCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibCampaignTypeCrudRepository $iLibCampaignTypeCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.campaign-type.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libcampaigntype crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibCampaignTypeCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.campaign-type.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libcampaigntype crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibCampaignTypeCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStorelibcampaigntype $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibCampaignType $request): JsonResponse
    {
        return $this->iLibCampaignTypeCrudRepo->store($request);
    }

    /**
     * Index page for view
     *
     * @param integer|string $id
     * @param Request $request
     * @return view
     */
    public function edit($id,Request $request) : view
    {
        $data = $this->iLibCampaignTypeCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.campaign-type.crud.index', compact('data'));
    }

    /**
     * Update procedure for libcampaigntype
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibCampaignTypeCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibCampaignTypeCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibCampaignTypeCrudRepo->updateList($request);
    }

}