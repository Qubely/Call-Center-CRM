<?php

namespace App\Http\Controllers\Admin\Campaign\List\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Campaign\List\Crud\ValidateStoreCampaign;
use App\Models\LibCountry;
use App\Repositories\Admin\Campaign\List\Crud\ICampaignCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class CampaignCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ICampaignCrudRepository $iCampaignCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.campaign.list.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
        $this->countries = LibCountry::select(['id','name'])->get();

    }

    /**
     * Index page for campaign crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iCampaignCrudRepo->index($request);
        $data['lang'] = $this->lang;
        $data['countries'] =  $this->countries;
        return view('admin.pages.campaign.list.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for campaign crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iCampaignCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStorecampaign $request
     * @return JsonResponse
     */
    public function store(ValidateStoreCampaign $request): JsonResponse
    {
        return $this->iCampaignCrudRepo->store($request);
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
        $data = $this->iCampaignCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        $data['countries'] =  $this->countries;
        return view('admin.pages.campaign.list.crud.index', compact('data'));
    }

    /**
     * Update procedure for campaign
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iCampaignCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iCampaignCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iCampaignCrudRepo->updateList($request);
    }

}
