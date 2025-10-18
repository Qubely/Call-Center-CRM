<?php

namespace App\Http\Controllers\Admin\Agent\Application\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Agent\Application\Crud\ValidateStoreAgentApplication;
use App\Repositories\Admin\Agent\Application\Crud\IAgentApplicationCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class AgentApplicationCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private IAgentApplicationCrudRepository $iAgentApplicationCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.agent.application.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for agentapplication crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iAgentApplicationCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.agent.application.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for agentapplication crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iAgentApplicationCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreAgentApplication $request
     * @return JsonResponse
     */
    public function store(ValidateStoreAgentApplication $request): JsonResponse
    {
        return $this->iAgentApplicationCrudRepo->store($request);
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
        $data = $this->iAgentApplicationCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.agent.application.crud.index', compact('data'));
    }

    /**
     * Update procedure for agentapplication
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iAgentApplicationCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iAgentApplicationCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iAgentApplicationCrudRepo->updateList($request);
    }

}
