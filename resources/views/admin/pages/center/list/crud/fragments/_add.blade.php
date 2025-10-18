<div class="bg-info pl-2 page-fragment-bar">
    <span class="text-light"> <a href=""><span class="badge badge-info cursor-pointer"> <i class='fa-solid fa-arrow-left fs-16'></i></span></a> <span class="pt-1">{{pxLang($data['lang'],'add')}}  </span> </span>
</div>
<div class="mt-4 p-3">
    @can('center_crud_store')
        <form id="frmStoreCenter" autocomplete="off">
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
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.center_address')}}</b> <em class="required">*</em> <span id="center_address_error"></span></label>
                                    <div class="input-group">
                                        <textarea  class="form-control" name="center_address" id="center_address" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.image')}} JPG|PNG|JPEG|WEBP (Max 2024KB)</b> <em class="required"></em> <span id="image_error"></span></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
                                </div>
                                <fieldset class="p-3 border rounded bg-light fieldset">
                                    <legend class="fw-bold fs-18 legend mb-3"> {{pxLang($data['lang'],'title.center_owner')}} </legend>
                                    <div class="form-group text-left mb-3">
                                        <label class="form-label"> <b>{{pxLang($data['lang'],'fields.owner_name')}}</b> <em class="required">*</em> <span id="owner_name_error"></span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="owner_name" id="owner_name">
                                        </div>
                                    </div>
                                    <div class="form-group text-left mb-3">
                                        <label class="form-label"> <b>{{pxLang($data['lang'],'fields.owner_email')}}</b> <em class="required">*</em> <span id="owner_email_error"></span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="owner_email" id="owner_email">
                                        </div>
                                    </div>
                                    <div class="form-group text-left mb-3">
                                        <label class="form-label"> <b>{{pxLang($data['lang'],'fields.owner_mobile')}}</b> <em class="required">*</em> <span id="owner_mobile_error"></span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="owner_mobile" id="owner_mobile">
                                        </div>
                                    </div>
                                </fieldset>
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

