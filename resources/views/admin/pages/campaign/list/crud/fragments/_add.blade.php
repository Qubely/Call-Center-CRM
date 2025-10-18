<div class="bg-info pl-2 page-fragment-bar">
    <span class="text-light"> <a href=""><span class="badge badge-info cursor-pointer"> <i class='fa-solid fa-arrow-left fs-16'></i></span></a> <span class="pt-1">{{pxLang($data['lang'],'add')}}  </span> </span>
</div>
<div class="mt-4 p-3">
    @can('campaign_crud_store')
        <form id="frmStoreCampaign" autocomplete="off">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-2 shadow-card card-border">
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.name')}}</b> <em class="required">*</em> <span id="name_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.type')}}</b> <em class="required">*</em> <span id="type_error"></span></label>
                                    <div class="input-group">
                                        <select type="text" class="form-control" name="type" id="type">
                                            <option value=""> -- Select -- </option>
                                            @foreach ($data['campaignTypes'] as $item)
                                                <option value="{{$item?->name}}"> {{$item?->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.country')}}</b> <em class="required">*</em> <span id="country_error"></span></label>
                                    <div class="input-group">
                                        <select type="text" class="form-control" name="country" id="country">
                                            <option value=""> -- Select -- </option>
                                            @foreach ($data['countries'] as $item)
                                                <option value="{{$item?->name}}">{{$item?->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.billing_rate')}}</b> <em class="required">*</em> <span id="billing_rate_error"></span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="billing_rate" id="billing_rate">
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.payout_rate')}}</b> <em class="required">*</em> <span id="payout_rate_error"></span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="payout_rate" id="payout_rate">
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.validity')}}</b> <em class="required">*</em> <span id="validity_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control dp" name="validity" id="validity">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3 text-end">
                                    <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-plus"></i> {{pxLang($data['lang'],'','common.btns.crud_action_add')}} </button>
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

