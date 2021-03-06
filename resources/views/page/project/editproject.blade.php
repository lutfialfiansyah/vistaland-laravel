@extends('master')
@section('konten')
   <section class="content-header">
      <h1>
        Project
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ url('/project') }}">Project</a></li>
        <li class="active"><a href="{{ url('/project/edit',$edit->id) }}">Edit Project</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Project</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ route('project.update',$edit->id) }}" method="post">
              {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                  <label for="name">Name</label>
                  <input type="text" name="name" autofocus="autofocus" class="form-control" value="{{ $edit->name }}">
                    @if($errors->has('name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                  <label for="company">Company</label>
                  <input type="text" name="company" class="form-control" value="{{ $edit->company }}">
                    @if($errors->has('company'))
                      <span class="help-block">
                        <strong>{{ $errors->first('company') }}</strong>
                      </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                  <label for="location">Location</label>
                  <input type="text" name="location" class="form-control" value="{{ $edit->location }}">
                    @if($errors->has('location'))
                      <span class="help-block">
                        <strong>{{ $errors->first('location') }}</strong>
                      </span>
                    @endif                    
                </div>

                <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                  <label for="area">Area</label>
                  <input type="number" name="area" class="form-control" value="{{ $edit->area }}">
                    @if($errors->has('area'))
                      <span class="help-block">
                        <strong>{{ $errors->first('area') }}</strong>
                      </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('unit_total') ? ' has-error' : '' }}">
                  <label for="unit_total">Unit Total</label>
                  <input type="number" name="unit_total" class="form-control" value="{{ $edit->unit_total }}">
                    @if($errors->has('unit_total'))
                      <span class="help-block">
                        <strong>{{ $errors->first('unit_total') }}</strong>
                      </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('nup_free') ? ' has-error' : '' }}">
                  <label for="nup_free">NUP Free</label>
                  <input type="number" name="nup_free" class="form-control" value="{{ $edit->nup_free }}">
                    @if($errors->has('nup_free'))
                      <span class="help-block">
                        <strong>{{ $errors->first('nup_free') }}</strong>
                      </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('nup_comission') ? ' has-error' : '' }}">
                  <label for="nup_comission">NUP Comission</label>
                  <input type="text" name="nup_comission" class="form-control" value="{{ $edit->nup_comission }}">
                    @if($errors->has('nup_comission'))
                      <span class="help-block">
                        <strong>{{ $errors->first('nup_comission') }}</strong>
                      </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('booking_free') ? ' has-error' : '' }}">
                  <label for="booking_free">Booking Free</label>
                  <input type="number" name="booking_free" class="form-control" value="{{ $edit->booking_free }}">
                    @if($errors->has('booking_free'))
                      <span class="help-block">
                        <strong>{{ $errors->first('booking_free') }}</strong>
                      </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('booking_comission') ? ' has-error' : '' }}">
                  <label for="booking_comission">Booking Comission</label>
                  <input type="number" name="booking_comission" class="form-control" 
                  value="{{ $edit->booking_comission }}">
                    @if($errors->has('booking_comission'))
                      <span class="help-block">
                        <strong>{{ $errors->first('booking_comission') }}</strong>
                      </span>
                    @endif                      
                </div>

                <div class="form-group{{ $errors->has('akad_comission') ? ' has-error' : '' }}">
                  <label for="akad_comission">Akad Comission</label>
                  <input type="number" name="akad_comission" class="form-control" value="{{ $edit->akad_comission }}">
                    @if($errors->has('akad_comission'))
                      <span class="help-block">
                        <strong>{{ $errors->first('akad_comission') }}</strong>
                      </span>
                    @endif                     
                </div>
                
                <div class="form-group">
                 <a href="{{ route('project.view') }}" class="btn btn-danger" 
                 onclick="return confirm('Click Ok untuk membatalkan !')">BATAL</a>
                  <input type="submit" class="btn btn-primary" value="UPDATE">
                </div>

              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
  
@endsection
