<?php

namespace App\Http\Controllers\Admin\System\User\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\System\User\Crud\ValidateStoreAdminUser;
use App\Repositories\Admin\System\User\Crud\IAdminUserCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class AdminUserCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private IAdminUserCrudRepository $iAdminUserCrudRepo) {
        $this->middleware(['auth:admin','HasSetAdminPassword','HasAdminAuth']);
        $this->lang= 'admin.system.user';
    }

    /**
     * Index page for adminuser crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iAdminUserCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.system.user.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for adminuser crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iAdminUserCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreAdminUser $request
     * @return JsonResponse
     */
    public function store(ValidateStoreAdminUser $request): JsonResponse
    {
        return $this->iAdminUserCrudRepo->store($request);
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
        $data = $this->iAdminUserCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.system.user.crud.index', compact('data'));
    }

    /**
     * Update procedure for adminuser
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iAdminUserCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iAdminUserCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iAdminUserCrudRepo->updateList($request);
    }

}
