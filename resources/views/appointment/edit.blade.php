@extends('layouts.app2')

@section('content')
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
        <div class="pull-right">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-plus" style="margin-right: 5px;"></i>
            Appointment Information
          </button>
        </div>
      </h1>
</section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Appointments</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" action="{{route('appointment.update', $appointment->id)}}" method="POST">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="inputPatient" class="col-sm-2 control-label">Patient</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" id="patientId" name="patientId" style="width: 100%;" required>
                        @foreach ($patients as $patient)
                            <option
                                value="{{$patient->id}}" {{ $appointment->patients_id == $patient->id ? 'selected' : ''}}>{{$patient->name}} - {{$patient->age}} - {{$patient->gender}}

                            </option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                    <label for="inputAppointmentTime" class="col-sm-2 control-label">Appointment At</label>
                    <div class="col-sm-10">
                        <input type="text" id="datepicker" name="inputAppointmentTime"  class="form-control datetimepicker1"
                        value="{{ date_format(date_create($appointment->appointment_at),'m/d/Y h:i A') }}"
                        required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTreatmentType" class="col-sm-2 control-label">Treatment Type</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="inputTreatmentType" name="inputTreatmentType"  required>
                            <option></option>
                            <option value="skin" {{ $appointment->treatment_type == 'skin' ? 'selected' : ''}}>Skin</option>
                            <option value="hair" {{ $appointment->treatment_type == 'hair' ? 'selected' : ''}}>Hair</option>
                            <option value="prp" {{ $appointment->treatment_type == 'prp' ? 'selected' : ''}}>PRP</option>
                            <option value="laser" {{ $appointment->treatment_type == 'laser' ? 'selected' : ''}}>Laser Treatment</option>
                            <option value="others" {{ $appointment->treatment_type == 'others' ? 'selected' : ''}}>Others</option>
                        </select>
                    </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Add Appointment</button>
              </div>
              <!-- /.box-footer -->
            </form>
            <!-- /.box-body -->
          </div>
        </div>
      </div>

    </section>


@endsection

@push('js')
<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
{{-- moment js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
	$(function() {
        $('.datetimepicker1').daterangepicker({
             autoUpdateInput: false,
            singleDatePicker: true,
            timePicker: true,
            showDropdowns: true,
            timePicker24Hour: false,
            minDate: new Date(),
        });
        $('.datetimepicker1').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY hh:mm A'));
        });
        $('.datetimepicker1').on('cancel.daterangepicker', function(ev, picker) {
              $(this).val('');
        });
    });
    //init select2
    $(function () {
        $('.select2').select2()
    });
</script>
@endpush
