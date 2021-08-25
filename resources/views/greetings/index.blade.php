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
          <div class="col-lg-6 col-xs-6">
            <form action="{{route('greetings.store')}}" method="POST" style="margin-top: 10px;">
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
