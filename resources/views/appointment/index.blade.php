@extends('layouts.app2')

@section('content')
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
        <div class="pull-right">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-plus" style="margin-right: 5px;"></i>
            Add New Appointment
          </button>
        </div>
      </h1>
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Create an Appointment</h4>
              <ul class="nav nav-tabs">
                <li class="active"><a href="#appointmentpatient" data-toggle="tab">New Patient</a></li>
                <li><a href="#Appointment" data-toggle="tab">Existing Patient</a></li>

              </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane" id="Appointment">
                    <form class="form-horizontal" action="{{route('appointment.store')}}" method="POST">
                        @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputPatient" class="col-sm-2 control-label">Patient</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="patientId" name="patientId" style="width: 100%;" required>
                                    @foreach ($patients as $patient)
                                        <option value="{{$patient->id}}">{{$patient->name}} - {{$patient->age}} - {{$patient->gender}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAppointmentTime" class="col-sm-2 control-label">Time</label>
                            <div class="col-sm-10">
                                <input type="text" id="datepicker" name="inputAppointmentTime"  class="form-control datetimepicker1"  required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTreatmentType" class="col-sm-2 control-label">Treatment Type</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="inputTreatmentType" name="inputTreatmentType"  required>
                                    <option></option>
                                    <option value="skin">Skin</option>
                                    <option value="hair">Hair</option>
                                    <option value="prp">PRP</option>
                                    <option value="laser">Laser Treatment</option>
                                    <option value="others">Others</option>
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
                </div>

                <div class="active tab-pane" id="appointmentpatient">
                    <form class="form-horizontal" action="{{route('appointment.multi')}}" method="POST">
                        @csrf
                        <div class="box-body">
                          <div class="form-group">
                            <label for="mAppointmentTime" class="col-sm-2 control-label">Time</label>
                            <div class="col-sm-10">
                                <input type="text" id="mdatepicker" name="mAppointmentTime"  class="form-control datetimepicker1"  required autocomplete="off">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="mName" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="mName" name="mName" placeholder="Name" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="mAge" class="col-sm-2 control-label">Age</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="mAge" name="mAge" placeholder="Age" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="mGender" class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                            <select class="form-control" id="mGender" name="mGender" required>
                              <option>Male</option>
                              <option>Female</option>
                            </select>
                          </div>
                          </div>
                          <div class="form-group">
                            <label for="mMobile" class="col-sm-2 control-label">Mobile</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="mMobile" name="mMobile" placeholder="Mobile" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="mAddress" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="mAddress" name="mAddress" placeholder="Address">
                            </div>
                          </div>


                            <div class="form-group">
                                <label for="mTreatmentType" class="col-sm-2 control-label">Treatment Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="mTreatmentType" name="mTreatmentType"  required>
                                        <option></option>
                                        <option value="skin">Skin</option>
                                        <option value="hair">Hair</option>
                                        <option value="prp">PRP</option>
                                        <option value="laser">Laser Treatment</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                          <button type="submit" class="btn btn-info pull-right" id="submitId">Create</button>
                        </div>
                        <!-- /.box-footer -->
                      </form>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Appointments</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>Patient (Nm, Gn, Age)</th>
                    <th>Mobile</th>
                    <th>Treatment Type</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>Reminder Msg Sent</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $cnt = 1; ?>
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $cnt++ }}</td>
                        <td>{{$appointment->name}} - {{$appointment->age}} - {{$appointment->gender}}</td>
                        <td>{{$appointment->mobile}}</td>
                        <td>
                            @if($appointment->treatment_type == 'skin')
                                Skin
                            @elseif($appointment->treatment_type == 'hair')
                                Hair
                            @elseif($appointment->treatment_type == 'prp')
                                PRP
                            @elseif($appointment->treatment_type == 'laser')
                                Laser Treatment
                            @elseif($appointment->treatment_type == 'others')
                                Others
                            @endif
                        </td>
                        <td>{{date_format(date_create($appointment->appointment_at),'m/d/Y h:i A') }}</td>
                        <td>
                            @if ($appointment->confirmed)
                                <small class="label bg-green">Confirmed</small>
                            @else <small class="label bg-red">Cancelled</small>
                            @endif
                        </td>
                        <td>{{$appointment->address}}</td>
                        <td>{{$appointment->reminder_sms_sent ? 'Yes' : 'No'}}</td>
                        <td>
                          <span class="">
                            <!-- <small class="label bg-green" style="margin-right: 15px">Send SMS</small> -->
                            <a href="{{route('appointment.edit', $appointment->id)}}">
                              <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                            </a>
                            {{-- <small class="label bg-red">Delete</small> --}}
                          </span>
                        </td>
                      </tr>
                    @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Treatment Type</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Last Appointment</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>

    </section>


@endsection

@push('js')
<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });
</script>
<script>
    $(function () {
        $('.select2').select2()
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
        // new
        $('.datetimepicker1').on('click', function(e) {
           e.preventDefault();
           $(this).attr("autocomplete", "off");
        });
    });
</script>
@endpush
