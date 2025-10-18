<?php

namespace App\Http\Controllers\Admin\Center\List\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Center\List\Crud\ValidateStoreCenter;
use App\Repositories\Admin\Center\List\Crud\ICenterCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class CenterCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ICenterCrudRepository $iCenterCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.center.list.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
    }

    /**
     * Index page for center crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iCenterCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.center.list.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for center crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iCenterCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStorecenter $request
     * @return JsonResponse
     */
    public function store(ValidateStoreCenter $request): JsonResponse
    {
        return $this->iCenterCrudRepo->store($request);
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
        $data = $this->iCenterCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.center.list.crud.index', compact('data'));
    }

    /**
     * Update procedure for center
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iCenterCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iCenterCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iCenterCrudRepo->updateList($request);
    }

}
