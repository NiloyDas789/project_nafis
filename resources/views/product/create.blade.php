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
        @if (Session::has('product_add_message'))
            <div class="row">
                <div class="col-md-6">
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                        {{ Session::get('product_add_message') }}</p>
                    {{ Session::forget('product_add_message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add New Product</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-8">
                            <form class="form-horizontal" id="formId" action="{{ route('products.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id">
                                <div class="box-body">
                                    <div class="form-group">
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                        <label for="title" class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                        <label for="description" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="description" name="description"
                                                rows="3"></textarea>
                                        </div>
                                    </div>

                                    {{-- Added New Category --}}
                                    <div class="form-group">
                                        @if ($errors->has('category'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('category') }}</strong>
                                            </span>
                                        @endif
                                        <label for="category" class="col-sm-2 control-label">Category</label>
                                        <div class="col-sm-10">


                                            {{-- <select type="text" class="form-control" id="category" name="category[]" multiple="multiple" required>
                                                <option>Select Category</option>
                                                <option value="lense">Lense</option>
                                                <option value="accessories">Accessories</option>
                                                <option value="camera">Camera</option>
                                            </select> --}}

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Lense"
                                                    id="flexCheckDefault" name="category[]">
                                                <label class="form-check-label" for="category">
                                                    Lense
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Accessories"
                                                    id="flexCheckChecked" name="category[]">
                                                <label class="form-check-label" for="category">
                                                    Accessories
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Camera"
                                                    id="flexCheckChecked" name="category[]">
                                                <label class="form-check-label" for="category">
                                                    Camera
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    {{-- Added New Category --}}

                                    <div class="form-group">
                                        @if ($errors->has('quantity'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('quantity') }}</strong>
                                            </span>
                                        @endif
                                        <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="quantity" name="quantity" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('art_no'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('art_no') }}</strong>
                                            </span>
                                        @endif
                                        <label for="art_no" class="col-sm-2 control-label">Article / Serial #</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="art_no" name="art_no" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* {{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                        <label for="price" class="col-sm-2 control-label">Unit Price</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="price" name="price" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->has('is_in_service'))
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">*
                                                    {{ $errors->first('is_in_service') }}</strong>
                                            </span>
                                        @endif
                                        <label for="is_in_service" class="col-sm-2 control-label">In Service</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="is_in_service" name="is_in_service">
                                                <option value="1">Yes</option>
                                                <option value="0" selected>No</option>
                                            </select>
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
                                    {{-- img result --}}

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
