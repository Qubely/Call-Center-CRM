<?php

namespace App\Http\Controllers\Admin\DataLibrary\SystemStatus\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\SystemStatus\Crud\ValidateStoreLibStatus;
use App\Repositories\Admin\DataLibrary\SystemStatus\Crud\ILibStatusCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibStatusCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibStatusCrudRepository $iLibStatusCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.system-status.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libstatus crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibStatusCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.system-status.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libstatus crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibStatusCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStorelibstatus $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibStatus $request): JsonResponse
    {
        return $this->iLibStatusCrudRepo->store($request);
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
        $data = $this->iLibStatusCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.system-status.crud.index', compact('data'));
    }

    /**
     * Update procedure for libstatus
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibStatusCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibStatusCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibStatusCrudRepo->updateList($request);
    }

}