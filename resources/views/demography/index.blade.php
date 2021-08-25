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
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Patients</h3>

              <form action="{{route('demography.index')}}" method="GET" style="margin-top: 10px;">
                <div class="col-auto">
                  <div class="col-sm-2">
                    <label for="inputAgeFrom">Age From</label>
                    <input type="text" class="form-control mb-2" id="inputAgeFrom" name="inputAgeFrom" placeholder="Age From">
                  </div>
                </div>
                <div class="col-auto">
                  <div class="col-sm-2">
                    <label for="inputAgeTo">Age To</label>
                    <input type="text" class="form-control mb-2" id="inputAgeTo" name="inputAgeTo" placeholder="Age To">
                  </div>
                </div>
                <div class="col-auto">
                  <div class="col-sm-2">
                    <label for="inputGender2">Gender</label>
                    <select class="form-control  mb-2" id="inputGender2" name="inputGender2">
                        <option></option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="col-sm-2">
                    <label for="inputTreatmentType">Treatment Type</label>
                    <select class="form-control mb-2" id="inputTreatmentType" name="inputTreatmentType">
                        <option></option>
                        <option value="skin">Skin</option>
                        <option value="hair">Hair</option>
                        <option value="prp">PRP</option>
                        <option value="laser">Laser Treatment</option>
                      </select>
                  </div>
                </div>
                <div class="col-auto">
                    <div class="col-sm-2">
                        <label for="lastAppointment">Last Appointment</label>
                            <input type="text" id="lastAppointment" name="lastAppointment" class="form-control  mb-2 datetimepicker1">
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary"  style="margin-top: 25px;">Filter</button>
                    <a href="{{route('demography.index')}}" type="button" class="btn btn-warning" style="margin-top: 25px; margin-left: 10px;">Clear</a>
                </div>
              </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
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
                </thead>
                <tbody>
                <?php $cnt = 1; ?>
                  @foreach ($patients as $patient)
                  <tr>
                    <td>{{$cnt++}}</td>
                    <td>{{$patient->name}}</td>
                    <td>{{$patient->age}}</td>
                    <td>{{$patient->gender}}</td>
                    <td>{{$patient->treatment_type}}</td>
                    <td>{{$patient->mobile}}</td>
                    <td>{{$patient->address}}</td>
                    <td>{{date_format(date_create($patient->last_appointment),'m/d/Y h:i A') }}</td>
                    <td>
                      <span class="">
                        <!-- <small class="label bg-green" style="margin-right: 15px">Send SMS</small> -->
                        <a href="{{route('patient.edit', $patient->id)}}">
                          <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                        </a>
                        <!-- <small class="label bg-red">Delete</small> -->
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

      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <form action="{{route('demography.send')}}" method="POST" style="margin-top: 10px;">
              @csrf
              <div class="row">
                  <div class="col">
                      <div class="form-group">
                          <label for="inputGreetings" class="col-sm-4 control-label">Message Text</label>
                          <div class="col-sm-8">
                              <textarea class="form-control" id="inputGreetings" name="inputGreetings" rows="3" required></textarea>
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
            // minDate: new Date(),
        });
        $('.datetimepicker1').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY hh:mm A'));
        });
        $('.datetimepicker1').on('cancel.daterangepicker', function(ev, picker) {
              $(this).val('');
        });

    });

</script>
@endpush
