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
        @if(Session::has('product_update_message'))
            <div class="row">
                <div class="col-md-6">
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('product_update_message') }}</p>
                    {{Session::forget('product_update_message')}}
                </div>
            </div>
        @endif
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Update Product</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-8">
                    <form class="form-horizontal" id="formId" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <div class="box-body">
                            <div class="form-group">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* {{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                                <label for="title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" value="{{$product->title}}" required>
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
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{$product->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* {{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                                <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{$product->stock}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                @if ($errors->has('art_no'))
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* {{ $errors->first('art_no') }}</strong>
                                    </span>
                                @endif
                                <label for="art_no" class="col-sm-2 control-label">Art. No.</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="art_no" name="art_no" value="{{$product->art_no}}" required>
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
                                    <input type="text" class="form-control" id="price" name="price" value="{{$product->unit_price}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <label class="col-sm-2 control-label custom-file-label" for="customFile">Choose file</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="custom-file-input" id="customFile" name="customFile">
                                    </div>
                                </div>
                            </div>
                            {{-- img result --}}
                            <div class="form-group">
                                <div class="custom-file">
                                    <label class="col-sm-2 control-label custom-file-label" for="customFile">Previous Image</label>
                                    <div class="col-sm-10">
                                        <img src="{{asset($product->image_path)}}" height="300" width="300">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right" id="submitId" style="padding-left: 40px; padding-right: 40px">Save</button>
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
