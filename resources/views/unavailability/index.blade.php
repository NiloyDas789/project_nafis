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
        @if(Session::has('message'))
            <div class="row">
                <div class="col-md-6">
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    {{Session::forget('message')}}
                </div>
            </div>
        @endif
        <div class="row">
          <div class="col-md-8">
            <form action="{{route('informUnavailability.store')}}" method="POST" style="margin-top: 10px;">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="unavailableFrom" class="col-sm-4 control-label">Unavailable From</label>
                            <div class="col-sm-8">
                                <input type="text" id="unavailableFrom" name="unavailableFrom" class="form-control datetimepicker1"
                                required autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="unavailableTo" class="col-sm-4 control-label">Unavailable To</label>
                            <div class="col-sm-8">
                                <input type="text" id="unavailableTo" name="unavailableTo"  class="form-control datetimepicker1"
                                required autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="unavailabilityMsg" class="col-sm-2 control-label">Message Text</label>
                            <button type="button" class="col-sm-2 btn btn-sm btn-success" id="generateMsg" onclick="changeMsg()" style="">Generate Message</button>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="unavailabilityMsg" name="unavailabilityMsg" rows="3" required>This will automatically be updated after clicking on the left sided button . Select time range first.</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 5px; margin-right: 2px;">
                    <div class="col pull-right">
                        N.B.: Sending messages to all patients might take a while.
                    </div>
                </div>
                <div class="row" style="padding: 10px;">
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success pull-right">Send Message To All</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

      </section>


@endsection

@push('js')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
{{-- moment js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
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
            $(this).val(picker.startDate.format('MM/DD/YYYY hh:mm A'));
            console.log(document.getElementById("unavailableFrom").value);
        });
        $('.datetimepicker1').on('cancel.daterangepicker', function(ev, picker) {
              $(this).val('');
        });

    });

</script>
<script type="text/javascript">
     function changeMsg() {
        var x = document.getElementById("unavailableFrom").value;
        var y = document.getElementById("unavailableTo").value;
        // var d1 = moment(x, "DD MM YYYY");
        var d1 = moment.utc(x).format('DD MMMM YYYY');
        var d2 = moment.utc(y).format('DD MMMM YYYY');
        if (d1 == d2){
            document.getElementById("unavailabilityMsg").innerHTML = 'Doctor will be unavailable on '+ d1 + '. Sorry, your appointment has been cancelled';
        }
        else {
            document.getElementById("unavailabilityMsg").innerHTML = 'Doctor will be unavailable from '+ d1 + ' to ' + d2 + '. Sorry, your appointment has been cancelled';
    
        }
        }
</script>
@endpush
