<div class="bg-info pl-2 page-fragment-bar">
    <span class="text-light"> <a href="{{url('admin/system/user/user-role')}}"><span class="badge badge-info cursor-pointer"> <i class='fa-solid fa-arrow-left fs-16'></i></span></a> <span class="pt-1"> {{pxLang($data['lang'],'update')}}   </span> </span>
</div>
<div class="mt-4 p-3">
    @can('company_crud_edit')
        <form id="frmUpdateCompanyRole" autocomplete="off">
            @method('PATCH')
            <input type="hidden" id="patch_id" value="{{$data['item']?->id}}" />
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-2 shadow-card card-border">
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.name')}}</b> <em class="required">*</em> <span id="name_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" id="name" value="{{$data['item']?->name}}">
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.country')}}</b> <em class="required">*</em> <span id="country_error"></span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="country" id="country">
                                            <option value="">-- Select -- </option>
                                            @foreach ($data['countries']  as $item)
                                                <option {{($data['item']?->country == $item?->name) ? 'selected':''}} value="Bangladesh"> Bangladesh </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.time_zone')}}</b> <em class="required">*</em> <span id="time_zone_error"></span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="time_zone" id="time_zone">
                                            <option value="">-- Select -- </option>
                                            @foreach ($data['timeZones'] as $item)
                                                <option {{($data['item']?->time_zone == $item?->name) ? 'selected':''}} value="{{$item?->name}}"> {{$item?->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.address')}}</b> <em class="required">*</em> <span id="address_error"></span></label>
                                    <div class="input-group">
                                        <textarea rows="4" class="form-control" name="address" id="address">{{$data['item']?->address}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.tax_id')}}</b> <em class="required">*</em> <span id="tax_id_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="tax_id" id="tax_id" value="{{$data['item']?->tax_id}}"/>
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.email')}}</b> <em class="required">*</em> <span id="email_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" id="email" value="{{$data['item']?->email}}"/>
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
