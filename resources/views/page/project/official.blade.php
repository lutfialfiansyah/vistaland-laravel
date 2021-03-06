@extends('master')
@section('konten')
   <section class="content-header">
      <h1>
        Users
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Customer</h3>
              <a href="{{ URL::to('users/add') }}" class="btn btn-xs btn-success pull-right">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Users
              </a>

              <a href="{{ URL::to('/users') }}" class="btn btn-xs btn-success">
                <i class="fa fa-refresh" aria-hidden="true"></i>
              </a>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="data" class="table table-bordered table-hover table-striped table-condesed">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Position</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
<script src="{{ asset('dist/sweetalert.min.js')}}"></script>
@include('sweet::alert')
@endsection

@push('script')
<script>
  $(function () {
    $('#data').DataTable({
      "responsive" : true,
      "processing" : true,
      "serverSide" : true,
      "sScrollX" : false,
      "ajax" : "{{ url('users/get-users') }}",
      "columns" : [
      	{ data : 'name' ,name: 'name'},
        { data : 'email' ,name: 'email'},
        { data : 'role', name: 'role' },
        { data : 'status', name: 'status' },
        { data : 'action', name:'action', orderable: false, searchable: false },
      ]
    });
  });

 $(document).on('click', '#confirm', function(e) {
        e.preventDefault();
        var link = $(this);
        swal({
            title: "Delete Record !",
            text: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: true
         },
         function(isConfirm){
             if(isConfirm){
                window.location = link.attr('href');
             }
             else{
                swal("cancelled","Category deletion Cancelled", "error");
             }
         });
   });
</script>
@endpush
