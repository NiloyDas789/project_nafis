@extends('layouts.app2')

@section('content')
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
        <!--<div class="pull-right">-->
        <!--  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">-->
        <!--    Add New Patient-->
        <!--  </button>-->
        <!--</div>-->
      </h1>
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">New Patient Form</h4>
            </div>
            <form class="form-horizontal" id="formId" action="{{route('patient.store')}}" method="POST">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAge" class="col-sm-2 control-label">Age</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputAge" name="inputAge" placeholder="Age" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputGender" class="col-sm-2 control-label">Gender</label>
                  <div class="col-sm-10">
                  <select class="form-control" id="inputGender" name="inputGender" required>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
                </div>
                <div class="form-group">
                  <label for="inputMobile" class="col-sm-2 control-label">Mobile</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputMobile" name="inputMobile" placeholder="Mobile" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAddress" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Address">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right" id="submitId">Save</button>
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
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Patients</h3>

              <form action="{{route('patient.index')}}" method="GET" style="margin-top: 10px;">
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
                    <button type="submit" class="btn btn-primary"  style="margin-top: 25px;">Filter</button>
                    <a href="{{route('patient.index')}}" type="button" class="btn btn-warning" style="margin-top: 25px; margin-left: 10px;">Clear</a>
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
                    <td>{{isset($patient->last_appointment) ? date_format(date_create($patient->last_appointment),'m/d/Y h:i A') : ''}}</td>
                    <td>
                      <span class="">
                        <!-- <small class="label bg-green" style="margin-right: 15px">Send SMS</small> -->
                        <a href="{{route('patient.edit', $patient->id)}}">
                          <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                        </a>
                        <!-- <small class="label bg-red">Delete</small> -->
                        <a onclick="return confirm('Are you sure?')" href="{{route('patient.delete', $patient->id)}}">
                            <small class="label bg-red" style="margin-right: 15px">Delete</small>
                        </a>
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
