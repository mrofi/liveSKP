@extends('themes.adminLTE.template')

@section('templateBody')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo text-center">
    <img src="/images/logo.png">
    <a href="/">@yield('nama.app.full', '<b>SKP</b>NS') <br>Kota Pekalongan</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silakan Login</p>

    {!! Form::open() !!}
        @if($errors->first('credential')) <span class="lead label label-danger">{{ $errors->first('credential') }}</span>@endif 
        <div class="form-group has-feedback">
            {!! Form::text('credential', null, ['class' => 'form-control', 'placeholder' => 'NIP atau Email']) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        @if($errors->first('password')) <span class="lead label label-danger">{{ $errors->first('password') }}</span>@endif 
        <div class="form-group has-feedback">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                    {!! Form::checkbox('remember') !!}
                    Ingat Saya
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-unlock"></i> Login</button>
            </div>
        <!-- /.col -->
        </div>
    {!! Form::close() !!}

    <!-- /.social-auth-links -->

<!--     <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>
 -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/backend/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('/backend/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('/backend/plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
@stop