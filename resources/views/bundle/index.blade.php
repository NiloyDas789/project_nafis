@extends('layouts.app2')

@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        @if (Session::has('order_delete_message'))
            <div class="row">
                <div class="col-md-6">
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                        {{ Session::get('order_delete_message') }}</p>
                    {{ Session::forget('order_delete_message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Bundles</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID #</th>
                                    <th>Bundle Name</th>
                                    {{-- <th>Number of product</th> --}}
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cnt = 1; ?>
                                @foreach ($bundles as $bundle)
                                    <tr>
                                        <td>{{ $bundle->id }}</td>
                                        <td>{{ $bundle->name }}</td>
                                        {{-- <td>{{ $bundle->no_of_product }}</td> --}}
                                        <td>{{ $bundle->created_at }}</td>
                                        <td>{{ $bundle->updated_at }}</td>

                                        <td>
                                            <span class="">
                                                <a href="{{ route('bundles.edit', $bundle->id) }}">
                                                    <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                                                </a>
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ route('bundles.delete', $bundle->id) }}">
                                                    <small class="label bg-red" style="margin-right: 15px">Cancel</small>
                                                </a>

                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID #</th>
                                    <th>Bundle Name</th>
                                    <th>Number of product</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
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
        $(function() {
            $('#example1').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        });

    </script>
@endpush
