<?php

namespace App\Http\Controllers\Admin\Agent\Application\Crud\Modal\MangeAgentDoc;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Agent\Application\Crud\Modal\ManageAgentDoc\IManageAgentDocRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\JsonResponse;
use View;
use Illuminate\Http\Request;
//vpx_imports

class MangeAgentDocModalController  extends Controller {

    use BaseTrait;
    public function __construct(private IManageAgentDocRepository $iManageAgentDocRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.agent.application.crud.modal.mange-agent-doc';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Loaded page for mangeagentdoc
     *
     * @param Request $request
     * @return View
     */
    public function display(Request $request) : JsonResponse
    {
        $data['lang'] = $this->lang;
        $data = [...$data,...$this->iManageAgentDocRepo->display($request)];
        $view = View::make('admin.pages.agent.application.crud.modal.mange-agent-doc._modal', compact('data'))->render();
        $response = ['extraData' => ['inflate' => pxLang($data['lang'],'','common.response_success')],'view' => $view];
        return $this->response(['type' => 'success', 'data' => $response]);
    }
    //vpx_attach

    /**
     * Store document
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
       return $this->iManageAgentDocRepo->store($request);
    }

    /**
     * Delete documents
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request) : JsonResponse
    {
        return $this->iManageAgentDocRepo->delete($request);
    }

}
