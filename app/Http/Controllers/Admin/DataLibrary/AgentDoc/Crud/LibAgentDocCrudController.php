<?php

namespace App\Http\Controllers\Admin\DataLibrary\AgentDoc\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\AgentDoc\Crud\ValidateStoreLibAgentDoc;
use App\Repositories\Admin\DataLibrary\AgentDoc\Crud\ILibAgentDocCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibAgentDocCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibAgentDocCrudRepository $iLibAgentDocCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.agent-doc.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libagentdoc crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibAgentDocCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.agent-doc.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libagentdoc crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibAgentDocCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibAgentDoc $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibAgentDoc $request): JsonResponse
    {
        return $this->iLibAgentDocCrudRepo->store($request);
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
        $data = $this->iLibAgentDocCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.agent-doc.crud.index', compact('data'));
    }

    /**
     * Update procedure for libagentdoc
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibAgentDocCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibAgentDocCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibAgentDocCrudRepo->updateList($request);
    }

}