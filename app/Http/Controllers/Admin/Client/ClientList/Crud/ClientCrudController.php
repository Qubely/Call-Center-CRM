<?php

namespace App\Http\Controllers\Admin\Client\ClientList\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\ClientList\Crud\ValidateStoreClient;
use App\Repositories\Admin\Client\ClientList\Crud\IClientCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class ClientCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private IClientCrudRepository $iClientCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.client.client-list.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for client crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iClientCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.client.client-list.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for client crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iClientCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreclient $request
     * @return JsonResponse
     */
    public function store(ValidateStoreClient $request): JsonResponse
    {
        return $this->iClientCrudRepo->store($request);
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
        $data = $this->iClientCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.client.client-list.crud.index', compact('data'));
    }

    /**
     * Update procedure for client
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iClientCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iClientCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iClientCrudRepo->updateList($request);
    }

}