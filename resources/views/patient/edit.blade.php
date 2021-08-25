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
              <h3 class="box-title">Patient Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form class="form-horizontal" id="formId" action="{{route('patient.update', $patient->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$patient->id}}">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="inputName" value="{{$patient->name}}" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputAge" class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputAge" name="inputAge" value="{{$patient->age}}" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputGender" class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-10">
                        <select class="form-control" id="inputGender" name="inputGender" required>
                          <option
                            @if ($patient->gender == 'Male')
                                selected
                            @endif
                            >Male
                          </option>
                          <option
                            @if ($patient->gender == 'Female')
                                selected
                            @endif
                            >Female
                          </option>
                        </select>
                      </div>
                      </div>
                      <div class="form-group">
                        <label for="inputMobile" class="col-sm-2 control-label">Mobile</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputMobile" name="inputMobile" value="{{$patient->mobile}}" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputAddress" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputAddress" name="inputAddress" value="{{$patient->address}}">
                        </div>
                      </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-info pull-right" id="submitId">Save</button>
                    </div>
                    <!-- /.box-footer -->
                  </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>

    </section>
@endsection

@push('js')

@endpush
