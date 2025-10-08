@extends('admin.layouts.main-layout',["tabTitle" => config('i.service_name')." | ".pxLang($data['lang'],'breadCum.title') ])
@section('page')
@section('breadCum')
    <h4 class="mb-0">{{pxLang($data['lang'],'breadCum.title')}}</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{pxLang($data['lang'],'breadCum.b1')}} </a></li>
            <li class="breadcrumb-item active">{{pxLang($data['lang'],'breadCum.b2')}} </li>
        </ol>
    </div>
@endsection
<div class="thepage">
	<div id="defaultPage" class="pages">
		<div class="data-summary">
			<div class="card p-2">
				<form id="frmAdminUpdateProfile" autocomplete="off">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-2 shadow-card card-border">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group text-left mb-3">
                                                    <label class="form-label"> <b> {{pxLang($data['lang'],'fields.name')}}   </b> <em class="required">*</em> <span id="name_error"> </span></label>
                                                    <div class="input-group">
                                                        <input type="text"  class="form-control" name="name" id="name" value="{{$data['item']->name}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group text-left mb-3">
                                                    <label class="form-label"> <b> {{pxLang($data['lang'],'fields.name')}}   </b> <em class="required">*</em> <span id="name_error"> </span></label>
                                                    <div class="input-group">
                                                        <input type="text"  class="form-control" name="name" id="name" value="{{$data['item']->name}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group text-left mb-3">
                                                    <label class="form-label"> <b> {{pxLang($data['lang'],'fields.name')}}   </b> <em class="required">*</em> <span id="name_error"> </span></label>
                                                    <div class="input-group">
                                                        <input type="text"  class="form-control" name="name" id="name" value="{{$data['item']->name}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 mt-3 text-end">
                                            <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i>  {{pxLang($data['lang'],'btns.update')}}  </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
@endsection
