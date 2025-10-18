<div class="bg-info pl-2 page-fragment-bar">
    <span class="text-light"> <a href="{{url('admin/agent/application')}}"><span class="badge badge-info cursor-pointer"> <i class='fa-solid fa-arrow-left fs-16'></i></span></a> <span class="pt-1"> {{pxLang($data['lang'],'update')}}   </span> </span>
</div>
<div class="mt-4 p-3">
    @can('agent_application_crud_edit')
        <form id="frmUpdateAgentApplication" autocomplete="off">
            @method('PATCH')
            <input type="hidden" id="patch_id" value="{{$data['item']?->id}}" />
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-2 shadow-card card-border">
                                 <div class="form-group text-left mb-3">
                                    <label class="form-label">
                                        <b>{{ pxLang($data['lang'], 'fields.name') }}</b> <em class="required">*</em>
                                        <span id="name_error"></span>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" id="name" value="{{$data['item']?->name}}">
                                    </div>
                                </div>

                                <div class="form-group text-left mb-3">
                                    <label class="form-label">
                                        <b>{{ pxLang($data['lang'], 'fields.mobile_number') }}</b> <em class="required">*</em>
                                        <span id="mobile_number_error"></span>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{$data['item']?->mobile_number}}">
                                    </div>
                                </div>

                                <div class="form-group text-left mb-3">
                                    <label class="form-label">
                                        <b>{{ pxLang($data['lang'], 'fields.email') }}</b> <em class="required">*</em>
                                        <span id="email_error"></span>
                                    </label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="email" id="email" value="{{$data['item']?->email}}">
                                    </div>
                                </div>

                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.image')}} JPG|PNG|JPEG|WEBP (Max 2024KB)</b> <em class="required"></em> <span id="image_error"></span></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="image" id="image" >
                                    </div>
                                </div>
                                <div>
                                    <img src="{{getRowImage($data['item'],'80X80')}}" class="img-fluid" />
                                </div>

                                <div class="form-group text-left mb-3">
                                    <label class="form-label">
                                        <b>{{ pxLang($data['lang'], 'fields.address') }}</b> <em class="required">*</em>
                                        <span id="address_error"></span>
                                    </label>
                                    <div class="input-group">
                                        <textarea class="form-control" rows="3" name="address" id="address">{{$data['item']?->address}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3 text-end">
                                    <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-save"></i> {{pxLang($data['lang'],'','common.btns.crud_action_update')}} </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        @include('common.view.fragments.-item-403')
    @endcan
</div>
