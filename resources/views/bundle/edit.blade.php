@extends('layouts.app2')

@section('content')
    <section class="content-header">
        <h1>
            Edit Bundle
            <small>Control panel</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        @if (Session::has('stock_add_message'))
            <div class="row">
                <div class="col-md-6">
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                        {{ Session::get('stock_add_message') }}</p>
                    {{ Session::forget('stock_add_message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        {{-- <h3 class="box-title"></h3> --}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="" style="margin-left: 10px;">
                                            <h3>Products</h3>
                                        </div>
                                        <div class="" style="margin-left: 10px;">
                                            <div class="">
                                                <input type="text" placeholder="Search.."
                                                    style="height: 40px; max-width: 500px; min-width: 200px;"
                                                    id="productSearch" name="productSearch"
                                                    onkeyup="productSearchFunction()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="timeline-body">
                                            @foreach ($products as $product)
                                                <div class="col-md-3" id="{{ $product->id }}"
                                                    style="margin-left: 10px; margin-right: 10px;">
                                                    <div class="row text-center">
                                                        <span class="" style="margin-left: 10px;">
                                                            {{ mb_strimwidth($product->title, 0, 25, '...') }}
                                                        </span>
                                                    </div>
                                                    <div class="row text-center">
                                                        <img src="{{ $product->image_path }}" height="100" width="150"
                                                            class="margin" style=""
                                                            onclick="onImageClick({{ $product->id }}, {{ $product->unit_price }}, '{{ strval($product->title) }}', '{{ strval($product->art_no) }}', {{ $product->stock }})"
                                                            id="img-{{ $product->id }}">
                                                    </div>
                                                    <div class="row text-center">
                                                        Stock: {{ $product->stock }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h3>selected items</h3>
                                {{--  --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" action="{{ route('bundles.update', $bundle->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="box box-default" style="width: 80%;">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="bundleName" class="col-sm-3 control-label">Bundle Name
                                                            *</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="bundleName"
                                                                name="bundleName" placeholder="Name"
                                                                value="{{ $bundle->name }}">
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /.box-body -->
                                            </div>

                                            <div class="col-md-11">
                                                <table class="table table-hover" id="dynamic_field" onchange="">
                                                    <thead>
                                                        <tr>
                                                            <th>Art. No.</th>
                                                            <th>Name</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Price</th>
                                                            <th>Subtotal</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>

                                                <div class=" col-lg-12 text-center">
                                                    <br>
                                                    <button type="submit" style="padding-right: 50px; padding-left: 50px;"
                                                        class="btn btn-lg btn-success" name="makeOrder" id="makeOrder">Make
                                                        Bundle</button>
                                                </div>
                                                <!-- /.col-lg-6 -->

                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        </div>

    </section>
@endsection

@push('js')

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('.select2').select2()
        });

        // function alertOnEmptyCart() {
        //     if (document.getElementById('dynamic_field').rows.length < 2) {

        //     }
        // }
        // Search

        //  Previous product selection
        @foreach ($bundleProducts as $bundleProduct)
            onImageClick({{ $bundleProduct->id }}, {{ $bundleProduct->unit_price }}, "{{ $bundleProduct->title }}",
            "{{ $bundleProduct->art_no }}",
            {{ $bundleProduct->stock }}, {{ $bundleProduct->quantity }});
        @endforeach

        const pId = [
            @foreach ($products as $p)
                [{{ $p->id }}, "{{ $p->title }}"],
            @endforeach
        ];

        var i = 0;

        function productSearchFunction() {
            var x = document.getElementById("productSearch").value;

            if (x == '') {
                console.log('All products:');
                pId.forEach(function(value) {
                    console.log(value[0], value[1]);
                    document.getElementById(value[0]).style.display = 'block';
                });
            } else {
                var filter = x.toUpperCase();
                pId.forEach(function(value) {
                    var textValue = value[1].toUpperCase();
                    console.log(textValue, filter);
                    if (textValue.indexOf(filter) !== -1) {
                        document.getElementById(value[0]).style.display = 'block';
                    } else {
                        document.getElementById(value[0]).style.display = 'none';
                    }
                });
            }
        }
        // Search End
        // Image select
        function onImageClick(prodId, unitPrice, title, artNo, stock, prevQuantity = 1) {
            console.log(stock);
            var styleValue = document.getElementById("img-" + prodId).style.border;
            if (styleValue == '5px solid green') {
                document.getElementById("img-" + prodId).style.border = '';
                // remove row from cart
                this.removeProductOnCross(prodId);
            } else {
                document.getElementById("img-" + prodId).style.border = '5px solid green';
                // add row in cart

                var table = document.getElementById('dynamic_field');
                var rowCount = document.getElementById('dynamic_field').rows.length;
                var row = table.insertRow(rowCount);
                row.id = 'row' + prodId;
                row.className = "targetfields";
                var cell0 = row.insertCell(0);
                var cell1 = row.insertCell(1);
                var cell2 = row.insertCell(2);
                var cell3 = row.insertCell(3);
                var cell4 = row.insertCell(4);
                var cell5 = row.insertCell(5);
                var cell6 = row.insertCell(6);

                cell0.innerHTML = artNo;
                cell1.innerHTML = title;

                cell2.innerHTML =
                    '<input type="number" name="quantity[]" id="quantity[]" class="form-control qty" value="' +
                    prevQuantity + '" min="1"  onchange="matchUnitAndSubTotal()"/>';
                cell3.innerHTML = '<input type="text" name="unitPrice[]" class="form-control" value="' + unitPrice +
                    '" onchange="matchUnitAndSubTotal()"/>';
                cell4.innerHTML =
                    '<input type="text" name="subTotal[]" id="subTotal[]" class="form-control subtotal" value="' +
                    unitPrice + '"/>';

                cell5.innerHTML = '<button type="button" name="remove" id="' + rowCount +
                    '" class="btn btn-danger btn_remove" onclick="removeProductOnCross(' + prodId + ')">X</button>';

                cell6.innerHTML = '<input type="hidden" name="productId[]" id="productId[]" class="form-control" value="' +
                    prodId + '"/>';
            }
        }

        function removeProductOnCross(button_id) {
            var rowId = 'row' + button_id;
            var row = document.getElementById(rowId);
            row.parentNode.removeChild(row);
            document.getElementById("img-" + button_id).style.border = '';
        }
        // Image select End
        // Update Form Fileds

        function calculatex() {
            var table = document.getElementById("dynamic_field");
            var totQty = 0;
            const val = document.querySelectorAll('.form-control.qty');
            let sum = 0;
            for (let v of val) {
                sum += parseInt(v.value);
                // console.log(sum);
            }
            var totalQty = document.getElementById('totalQty');
            totalQty.value = sum;

            const val2 = document.querySelectorAll('.form-control.subtotal');
            let sum2 = 0.0;
            for (let v of val2) {
                sum2 = sum2 + parseFloat(v.value);
                console.log(sum2);
            }
            var returnDateElement = document.getElementById('returnDate');
            var returnDate = returnDateElement.value;

            // Start date new added
            var startDateElement = document.getElementById('startDate');
            var startDate = startDateElement.value;

            const date1 = new Date(returnDate);
            const date2 = new Date(startDate);
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            // Showing time difference from start date to end date
            document.getElementById("rentTime").innerHTML = diffDays + " days for rent";

            var totalAmount = document.getElementById('totalAmount');
            diffDays
                ?
                totalAmount.value = sum2 * diffDays :
                totalAmount.value = sum2;
        }

        function matchUnitAndSubTotal() {
            var table = document.getElementById('dynamic_field');
            for (var i = 1, row; row = table.rows[i]; i++) {
                row.cells[4].querySelector("input").value = row.cells[2].querySelector("input").value * row.cells[3]
                    .querySelector("input").value;
            }
        }

        function checkButton() {
            var button = document.getElementById('makeOrder');
            if (document.getElementById('dynamic_field').getElementsByTagName('tr').length > 1) {
                button.style.display = '';
            } else {
                button.style.display = 'none';
            }
        }



        $(function() {
            $('.datetimepicker1').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                timePicker: false,
                showDropdowns: true,
                timePicker24Hour: false,
                minDate: new Date(),
            });
            $('.datetimepicker1').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
            $('.datetimepicker1').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $(document).ready(function() {
                setInterval("checkButton()", 500);
            });
        });

    </script>

@endpush
