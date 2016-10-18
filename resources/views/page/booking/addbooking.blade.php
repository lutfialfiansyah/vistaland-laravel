@extends('master')
@section('konten')
   <section class="content-header">
      <h1>
        NUP
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ url('/booking') }}">Booking</a></li>
        <li class="active"><a href="{{ url('/booking/add') }}">Add Booking</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Booking</h3>
              <a href="{{ url('/Booking') }}" class="btn btn-xs btn-success pull-right">
                <i class="fa fa-eye" aria-hidden="true"></i> Lihat data
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ route('booking.add') }}" method="post">
              {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('date') ? ' has-error' : ''}}">
                  <label for="date">Date</label>
                  <input type="text" name="date" autofocus="autofocus" class="form-control " value="{{date('d-M-Y')}}" disabled="">
                    @if($errors->has('date'))
                      <span class="help-block">
                        <strong>{{ $errors->first('date') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('nup') ? ' has-error' : ''}}">
                  <label>NUP</label>
                  <select name="nup" id="nup" class="form-control" required>
                    <option value="">NUP</option>
                  </select>
                  <span class="help-block"></span>
                </div>
                <div class="form-group {{ $errors->has('kavling') ? ' has-error' : ''}}">
                  <label>Kavling</label>
                  <select name="kavling" id="kavling" class="form-control" required>
                    <option value="">KAVLING</option>
                  </select>
                  <span class="help-block"></span>
                </div>
                <div class="form-group {{ $errors->has('promo') ? ' has-error' : ''}}">
                  <label>Promo</label>
                  <select name="promo" id="promo" class="form-control" required>
                    <option value="">PROMO</option>
                  </select>
                  <span class="help-block"></span>
                </div>
                <div class="form-group {{ $errors->has('comission_status') ? ' has-error' : ''}}">
                  <label>Comission Status</label>
                  <select name="comission_status" id="comission_status" class="form-control" required>
                    <option value="">Pending</option>
                    <option value="">Paid</option>
                  </select>
                  <span class="help-block"></span>
                </div>

                <div class="form-group">
                  <button type="reset" class="btn btn-default">RESET</button>
                  <input type="submit" class="btn btn-primary pull-right" value="Submit">

                </div>

              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>

@endsection