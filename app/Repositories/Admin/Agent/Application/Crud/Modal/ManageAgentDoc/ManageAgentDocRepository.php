<?php

namespace App\Repositories\Admin\Agent\Application\Crud\Modal\ManageAgentDoc;

use App\Models\AgentApplication;
use App\Models\AgentApplicationDoc;
use App\Models\LibAgentDoc;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Response;
use Webpatser\Uuid\Uuid;
use View;
class ManageAgentDocRepository extends BaseRepository implements IManageAgentDocRepository
{

    /**
     * Retturn load model data
     *
     * @param Request $request
     * @return array
     */
    public function display($request) : array
    {
        $data['agentApplication'] = AgentApplication::find($request->id);
        $data['agentApplicationDoc'] = AgentApplicationDoc::with(['type'])->where([['agent_application_id','=',$request->id]])->get();
        $data['libAgentDocs'] = LibAgentDoc::select(['id','name'])->get();
        return $data;
    }

    /**
     * Store applicant document
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store($request) : JsonResponse
    {
        $messages = [
        ];
        $rules = [
            'agent_application_id' => 'required|exists:agent_applications,id',
            'lib_agent_doc_id'=> [
                'required',
                'string',
                'max:253',
                function($attr,$value,$fail) use($request) {
                    $ex = AgentApplicationDoc::where([['lib_agent_doc_id','=',$request?->lib_agent_doc_id],['agent_application_id','=',$request->agent_application_id]])->first();
                    if($ex != null) {
                        $fail(pxLang($request->lang,'title.doc_added'));
                    }
                }
            ],
            'document' => 'required|file|mimes:pdf,docx,doc|max:1024'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return Response::json(
            array(
                'success' => false,
                'errors'  => $validator->getMessageBag()->toArray(),
            ));
        }
        $path = imagePaths()['dyn_image'];
        try {
            $doc = $request->file('document');
            $m = new AgentApplicationDoc;
            $m->agent_application_id = $request->agent_application_id;
            $m->lib_agent_doc_id = $request->lib_agent_doc_id;
            $image_link = (string) Uuid::generate(4);
            $extension = $doc->getClientOriginalExtension();
            $doc->move($path, $image_link . '.' . $extension);
            $m->document = $image_link.'.'.$extension;
            $m->save();
            $data['lang'] = $request->lang;
            $data['agentApplicationDoc'] = AgentApplicationDoc::with(['type'])->where([['agent_application_id','=',$request->agent_application_id]])->get();
            $view = View::make('admin.pages.agent.application.crud.modal.mange-agent-doc.fragments._addedDocuments', compact('data'))->render();
            $response['extraData'] = ['inflate' => pxLang($request->lang,'','common.action_success'),'view' => $view];
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            $this->saveError($this->getSystemError(['name' => 'store_application_doc_error']), $e);
            return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
        }
    }

    /**
     * Delete applicant document
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete($request) : JsonResponse
    {
        try {
            AgentApplicationDoc::find($request->id)->delete();
            $response['extraData'] = ['inflate' => pxLang($request?->lang,'','common.action_success'),'id'=>$request->id];
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            $this->saveError($this->getSystemError(['name' => 'delete_applicant_doc']), $e);
            return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
        }
    }
}
