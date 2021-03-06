<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Vistaland</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="{{ asset('dist/sweetalert.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/keyframes.css')}}">
	<link rel="icon" type="image/png" href="{{ asset('home.png') }}">
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('AdminLTE/css/AdminLTE.css') }}">
	<link rel="stylesheet" href="{{ asset('AdminLTE/css/skins/_all-skins.min.css') }}">
	<link rel="stylesheet" href="{{ asset('font-awesome-4.6.3/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{asset('ionic/css/ionicons.min.css')}}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
	<!-- Morris chart -->
	<link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
	<!-- jvectormap -->
	<link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
	<!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
	<!-- dropzone -->
	<link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.min.css') }}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
	<!-- select2 -->
	<link rel="stylesheet" href="{{ asset('plugins/select2/select2.css') }}">
	<!-- datetimepicker -->
	<link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/datetimepicker/jquery.datetimepicker.min.css')}}">

</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('bagian.header')
		@include('bagian.aside')
		<div class="content-wrapper">
			@yield('konten')
		</div>
		@include('bagian.footer')
		<div class="control-sidebar-bg"></div>
	</div>

	<!-- jQuery -->
	<!-- Jquery -->

	<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
	<!-- Data Tables -->
	<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
	@stack('script')
	<!-- Bootstrap 3.3.6 -->
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('plugins/jQueryUI/1.11.4/jquery-ui.min.js') }}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- inputmask-->
	<script type="text/javascript" src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
	<!-- timepickeer-->
<script type="text/javascript" src="{{ asset('plugins/timepicker/bootstrap-timepicker.js') }}">
</script>
<script type="text/javascript" src="{{asset('plugins/datetimepicker/jquery.datetimepicker.full.js')}}"></script>
	<!-- sweetalert-->
	<script type="text/javascript" src="{{ asset('dist/sweetalert.min.js') }}"></script>
	<!-- sweetalert-->
	<script type="text/javascript" src="{{ asset('plugins/select2/select2.min.js') }}"></script>
	<!-- Morris.js charts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
	<!-- Sparkline -->
	<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
	<!-- jvectormap -->
	<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
	<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<!-- jQuery Knob Chart -->
	<script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
	<!-- daterangepicker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
	<!-- datepicker -->
	<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
	<!-- Slimscroll -->
	<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
	<!-- Drop Zone -->
	<script src="{{ asset('plugins/dropzone/dropzone.min.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('AdminLTE/js/app.min.js') }}"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="{{ asset('AdminLTE/js/pages/dashboard.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('AdminLTE/js/demo.js') }}"></script>
	<!-- page script -->
</body>
</html>

{{-- <img src="{{asset('load.gif')}}" id="loadbro" style="margin-top: 0%;"><br>
    <button onmousedown="tampil()">contoh</button>
@push('script')
<script>
document.getElementById('loadbro').style.display = 'none';
function tampil(){
  document.getElementById('loadbro').style.display = '';
}
</script>
@endpush --}}