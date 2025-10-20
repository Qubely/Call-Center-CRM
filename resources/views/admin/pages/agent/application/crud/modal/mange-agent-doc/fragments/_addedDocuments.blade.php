<h5> {{pxLang($data['lang'],'title.available')}}</h5>
<table class="table table-striped dataTable">
    <thead>
        <tr>
            <th> {{pxLang($data['lang'],'table.doc_type')}}</th>
            <th> {{pxLang($data['lang'],'table.doc')}}</th>
            <th class="text-end">Actions</th>
        </tr>
    </thead>
    <tbody>
         @foreach ($data['agentApplicationDoc'] as $item)
            <tr id="agent_app_doc_{{$item?->id}}">
                <td>{{$item?->type?->name}}</td>
                <td>
                    <a href="{{getFileUri($item)}}" download> <i class="fa fa-paperclip me-2"></i>  <span>{{pxLang($data['lang'],'title.download')}}</span> </a>
                </td>
                <td class="text-end">
                    <span data-id="{{$item?->id}}" class="btn btn-outline-danger btn-sm deleteDocument" title="Delete Doc">
                        Delete
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
