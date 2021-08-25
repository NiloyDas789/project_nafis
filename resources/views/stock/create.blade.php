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
        @if(Session::has('stock_add_message'))
            <div class="row">
                <div class="col-md-6">
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('stock_add_message') }}</p>
                    {{Session::forget('stock_add_message')}}
                </div>
            </div>
        @endif
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Product Stock</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-8">
                    <form class="form-horizontal" id="formId" action="{{route('stocks.store', $product->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"  value="{{$product->title}}"disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="art_no" class="col-sm-2 control-label">Art. No.</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="art_no" name="art_no" value="{{$product->art_no}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <label class="col-sm-2 control-label custom-file-label" for="customFile">Image</label>
                                    <div class="col-sm-10">
                                        <img src="{{asset($product->image_path)}}" height="300" width="300">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="quantity" name="quantity"  value="{{$product->stock}}"disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new_stock" class="col-sm-2 control-label">Add Stock</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="new_stock" name="new_stock" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new_stock" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <span class="">Note: New stocks will be added to Quantity.</span>
                                    {{-- <input type="text" class="form-control" id="new_stock" name="new_stock" required> --}}
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right" id="submitId" style="padding-left: 40px; padding-right: 40px">Add New Stock</button>
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
