@can('agent_application_modal_view')
    @if( $data['agentApplication'] != null)
        <form id="frmAddAgentDoc" autocomplete="off">
            <input type="hidden" value="{{$data['agentApplication']?->id}}" name="agent_application_id" />
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="form-group text-left mb-3">
                                <label class="form-label"> <b>{{ pxLang($data['lang'],'fields.lib_agent_doc_id')}}</b> <em class="required">*</em> <span id="lib_agent_doc_id_error"></span></label>
                                <div class="input-group">
                                <select class="form-control" name="lib_agent_doc_id" id="lib_agent_doc_id">
                                    <option value=""> -- {{pxLang($data['lang'],'','common.text.option_select')}} --</option>
                                    @foreach ($data['libAgentDocs'] as $item)
                                        <option value="{{$item?->id}}">{{$item?->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group text-left mb-3">
                                <label class="form-label"> <b>{{ pxLang($data['lang'],'fields.document')}}</b> PDF | DOCX (Max: 1MB) <em class="required">*</em> <span id="document_error"></span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="document" id="document" />
                                </div>
                            </div>
                            @can('agent_application_modal_store')
                            <div class="mb-3 mt-3 text-end">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> {{ pxLang($data['lang'],'','common.btns.crud_add') }}</button>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="loadAgentApplicationDoc" class="mt-3">
            @include('admin.pages.agent.application.crud.modal.mange-agent-doc.fragments._addedDocuments')
        </div>
    @else
        @include('common.view.fragments.-item-404')
    @endif
@else
    @include('common.view.fragments.-item-403')
@endcan
