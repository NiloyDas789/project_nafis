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
        @if (Session::has('customer_update_message'))
            <div class="row">
                <div class="col-md-6">
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                        {{ Session::get('customer_update_message') }}</p>
                    {{ Session::forget('customer_update_message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Update Customer</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-8">
                            <form class="form-horizontal" id="formId"
                                action="{{ route('customers.update', $customer->id) }}" method="POST">
                                @csrf
                                {{ method_field('PUT') }}
                                <input type="hidden" name="id" value="{{ $customer->id }}">
                                <div class="box-body">
                                    <div class="form-group">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $customer->name }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @endif
                                        <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="mobile" name="mobile"
                                                value="{{ $customer->mobile }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                        <label for="address" class="col-sm-2 control-label">Office Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $customer->address }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('delivery_address'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">*
                                                    {{ $errors->first('delivery_address') }}</strong>
                                            </span>
                                        @endif
                                        <label for="deliveryAddress" class="col-sm-2 control-label">Delivery Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deliveryAddress"
                                                name="deliveryAddress" value="{{ $customer->delivery_address }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('nid'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('nid') }}</strong>
                                            </span>
                                        @endif
                                        <label for="nid" class="col-sm-2 control-label">NID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nid" name="nid"
                                                value="{{ $customer->nid }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('passport'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('passport') }}</strong>
                                            </span>
                                        @endif
                                        <label for="passport" class="col-sm-2 control-label">Passport</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="passport" name="passport"
                                                value="{{ $customer->passport }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('comment'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('comment') }}</strong>
                                            </span>
                                        @endif
                                        <label for="comment" class="col-sm-2 control-label">Comment</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="comment" name="comment"
                                                value="{{ $customer->comment }}">
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
