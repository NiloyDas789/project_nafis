@extends('layouts.app2')

@section('content')
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
        {{-- <div class="pull-right">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-plus" style="margin-right: 5px;"></i>
            Add New Appointment
          </button>
        </div> --}}
      </h1>
      {{-- <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">New Appointment Form</h4>
            </div>
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
                    <label for="inputAppointmentTime" class="col-sm-2 control-label">Appointment At</label>
                    <div class="col-sm-10">
                        <input type="text" id="datepicker" name="inputAppointmentTime"  class="form-control datetimepicker1"  required>
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
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> --}}
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Messages</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>Patient (Nm, Gn, Age)</th>
                    <th>Mobile</th>
                    <th>For</th>
                    <th>Status</th>
                    <th>Text</th>
                    <th>Sent At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $cnt = 1; ?>
                    @foreach ($messages as $message)
                    <tr>
                        <td>{{ $cnt++ }}</td>
                        <td>{{$message->name}} - {{$message->age}} - {{$message->gender}}</td>
                        <td>{{$message->mobile}}</td>
                        <td>{{$message->for}}</td>
                        <td>
                            @if ($message->status=='Sent')
                                <small class="label bg-green">Sent</small>
                            @else
                            <small class="label bg-red">Failed</small>
                            @endif
                        </td>
                        <td>{{$message->text}}</td>
                        <td>{{date_format(date_create($message->created_at),'m/d/Y h:i A') }}</td>
                        <td>
                          <span class="">
                            <a href="{{route('message.store', $message->id)}}">
                              <small class="label bg-green" style="margin-right: 15px">Resend</small>
                            </a>
                          </span>
                        </td>
                      </tr>
                    @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <th>Sr.</th>
                    <th>Patient (Nm, Gn, Age)</th>
                    <th>Mobile</th>
                    <th>For</th>
                    <th>Status</th>
                    <th>Text</th>
                    <th>Sent At</th>
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
@endpush
