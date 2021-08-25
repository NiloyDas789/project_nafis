@extends('layouts.app2')

@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        @if (Session::has('settings_update_message'))
            <div class="row">
                <div class="col-md-6">
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                        {{ Session::get('settings_update_message') }}</p>
                    {{ Session::forget('settings_update_message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-8">
                            <form class="form-horizontal" id="formId" action="{{ route('settings.update') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- {{ method_field('PUT') }} --}}
                                <input type="hidden" name="id" value="{{ $settings->id }}">
                                <div class="box-body">
                                    <div class="form-group">
                                        @if ($errors->has('company_name'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('company_name') }}</strong>
                                            </span>
                                        @endif
                                        <label for="company_name" class="col-sm-2 control-label">Company Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="company_name" name="company_name"
                                                value="{{ $settings->company_name }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('company_address'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">*
                                                    {{ $errors->first('company_address') }}</strong>
                                            </span>
                                        @endif
                                        <label for="company_address" class="col-sm-2 control-label">Company Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="company_address"
                                                name="company_address" value="{{ $settings->company_address }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('company_city'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('company_city') }}</strong>
                                            </span>
                                        @endif
                                        <label for="company_city" class="col-sm-2 control-label">Company City</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="company_city" name="company_city"
                                                value="{{ $settings->company_city }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                        <label for="phone" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ $settings->phone }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        <label for="company_name" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" name="email"
                                                value="{{ $settings->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('invoice_prefix'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">*
                                                    {{ $errors->first('invoice_prefix') }}</strong>
                                            </span>
                                        @endif
                                        <label for="company_name" class="col-sm-2 control-label">Invoice Prefix</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="invoice_prefix"
                                                name="invoice_prefix" value="{{ $settings->invoice_prefix }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <label class="col-sm-2 control-label custom-file-label" for="customFile">Choose
                                                file</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="custom-file-input" id="customFile"
                                                    name="customFile">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <label class="col-sm-2 control-label custom-file-label"
                                                for="customFile">Previous Image</label>
                                            <div class="col-sm-10">
                                                <img src="{{ asset($settings->image_path) }}" height="300" width="300">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        @if ($errors->has('tos'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('tos') }}</strong>
                                            </span>
                                        @endif
                                        <label for="tos" class="col-sm-2 control-label">Terms and conditions</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" id="tos"
                                                name="tos">{{ $settings->tos }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success pull-right" id="submitId"
                                        style="padding-left: 40px; padding-right: 40px">Save</button>
                                </div>
                                <!-- /.box-footer -->
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
@endsection

@push('js')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>
@endpush
