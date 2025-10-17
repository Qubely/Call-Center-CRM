<?php

namespace App\Http\Controllers\Admin\Company\List\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\List\Crud\ValidateStoreCompany;
use App\Repositories\Admin\Company\List\Crud\ICompanyCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\LibCountry;
use App\Models\LibTimeZone;
class CompanyCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ICompanyCrudRepository $iCompanyCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.company.list.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
        $this->countries =  LibCountry::select(['id','name'])->get();
        $this->timeZones =  LibTimeZone::select(['id','name'])->get();

    }

    /**
     * Index page for company crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iCompanyCrudRepo->index($request);
        $data['lang'] = $this->lang;
        $data['countries'] = $this->countries;
        $data['timeZones'] =  $this->timeZones;
        return view('admin.pages.company.list.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for company crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iCompanyCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStorecompany $request
     * @return JsonResponse
     */
    public function store(ValidateStoreCompany $request): JsonResponse
    {
        return $this->iCompanyCrudRepo->store($request);
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
        $data = $this->iCompanyCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        $data['countries'] = $this->countries;
        $data['timeZones'] =  $this->timeZones;
        return view('admin.pages.company.list.crud.index', compact('data'));
    }

    /**
     * Update procedure for company
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iCompanyCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iCompanyCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iCompanyCrudRepo->updateList($request);
    }

}
