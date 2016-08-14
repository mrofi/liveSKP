<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $judul or 'Judul' }} | {{ $namaApp or 'SKPNS - Penilaian Sasaran Kerja Pegawai Negeri Sipil Kota Pekalongan' }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{ asset('backend/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/font-awesome/4.4.0/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2/select2-bootstrap.min.css') }}">
  <!-- Datepicker -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datepicker/datepicker3.css') }}">
  <!-- datatables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">
  <!-- I Check -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/iCheck/square/blue.css') }}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/skins/skin-blue.min.css') }}">

  <style type="text/css">
    .user-label {
        width: 30px;
        height: 30px;
        text-align: center;
        background-color: rgba(85, 85, 85, 0.25);
        color: #fff;
        border-radius: 50%;
        margin-top: -5px;
        margin-bottom: -5px;
        padding: 5px;
        position: absolute;
    }

  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
@if(auth()->user())
@section('templateBody')
<body class="skin-blue fixed layout-top-nav">
<div class="wrapper">

  </header>
   <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="/" class="navbar-brand">@yield('nama.app.full', '<b>SKP</b>NS')</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <!-- Optionally, you can add icons to the links -->
            <li class="@if(request()->is('home'))active @endif"><a href="{{ asset('home') }}"><i class="fa fa-lg fa-home"></i></a></li>
            @if(auth()->user()->is_admin || count(auth()->user()->pns->bawahan))
            <li class="@if(request()->is('penilaian*'))active @endif"><a href="{{ asset('penilaian') }}"></i> <span>@if (auth()->user()->is_admin) Laporan @endif Penilaian SKP</span></a></li>
            @endif
          @if(!auth()->user()->is_admin)
            <li class="@if(request()->is('skp*'))active @endif"><a href="{{ asset('skp') }}"><span>SKP Saya</span></a></li>
            <li class="@if(request()->is('me*'))active @endif"><a href="{{ asset('me') }}"><span>Profile Saya</span></a></li>
          @else
            <li class="@if(request()->is('profileMatching*'))active @endif"><a href="{{ asset('profileMatching') }}"><span>Profile Matching</span></a></li>
            <li class="@if(request()->is('instansi*'))active @endif"><a href="{{ asset('instansi') }}"><span>Instansi</span></a></li>
            <li class="@if(request()->is('jabatan*'))active @endif"><a href="{{ asset('jabatan') }}"><span>Jabatan</span></a></li>
            <li class="@if(request()->is('pns*'))active @endif"><a href="{{ asset('pns') }}"><span>PNS</span></a></li>
            <li class="@if(request()->is('me*'))active @endif"><a href="{{ asset('me') }}"><span>Profile Saya</span></a></li>
          @endif
            <!-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
          </ul>
          <!-- <form class="navbar-form navbar-left hidden-xs" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form> -->
        </div>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                @if (!($picture = auth()->user()->foto_thumbnail))
                <div class="user-label">
                  <span>{{ auth()->user()->getInitial() }}</span>
                </div>
                @else
                <img src="{{$picture}}" class="user-image" alt="User Image">
                @endif
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span @if (!$picture) style="margin-left: 40px;" @endif class="hidden-xs">{{auth()->user()->name}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  @if ($picture)
                  <img src="{{$picture}}" class="img-circle" alt="User Image">
                  @else
                  <i class="text-gray ion ion-person fa-5x"></i>
                  @endif
                  <p>
                    {{ auth()->user()->name }} @if(auth()->user()->pns) - {{ auth()->user()->pns->jabatan ? auth()->user()->pns->jabatan->jabatan : '' }} @endif
                  </p>
                  @if(auth()->user()->pns)
                  <p>
                    {{ auth()->user()->pns->instansi ? auth()->user()->pns->instansi->instansi : '' }}
                  </p>
                  @endif
                </li>
                <!-- Menu Body -->
                <!-- <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                </li>
                 -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="/me" class="btn btn-default btn-flat">Profile Saya</a>
                    </div>
                  <div class="pull-right">
                    <a href="/logout" class="btn btn-default btn-flat">Logout</a>
                  </div>
                </li>
              </ul>
            </li>
            <li><a href="/logout"><i class="fa fa-lock"></i> <span class="hidden-sm">Logout</span></a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1 @if (isset($titleCenter) && $titleCenter == true) class="text-center" @endif>
          {{ $judul or 'Page Header' }}
          <small>{{ $deskripsi or 'Optional description' }}</small>
        </h1>
        <ol class="breadcrumb">
        @if(isset($breadcrumbLevel))
          <li><a href="{{ $breadcrumb1Url or '/' }}"><i class="fa fa-{{ $breadcrumb1Icon or 'dashboard' }}"></i> {{ $breadcrumb1 or 'Menu' }}</a></li>
          @if($breadcrumbLevel >= 2)<li class="{{ $breadcrumb2Class or 'active' }}"><a href="{{ $breadcrumb2Url or 'javascript:;' }}" ><i class="fa fa-{{ $breadcrumb2Icon or '' }}"></i> {{ $breadcrumb2 or 'Here' }}</a></li>@endif
          @if($breadcrumbLevel >= 3)<li class="{{ $breadcrumb3Class or 'active' }}"><a href="{{ $breadcrumb3Url or 'javascript:;' }}" ><i class="fa fa-{{ $breadcrumb3Icon or '' }}"></i> {{ $breadcrumb3 or 'Here' }}</a></li>@endif
        @endif
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        @yield('content')

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Script by <a href="mailto:achanet2384@gmail.com">Tjandra Adji</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2015 - {{\Carbon\Carbon::now()->format('Y')}} - <a href="#"></a>SKPNS - Penilaian Sasaran Kerja Pegawai Negeri Sipil Kota Pekalongan.</strong> All rights reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('backend/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('backend/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- slim scroll -->
<script src="{{ asset('backend/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- date js -->
<script src="{{ asset('backend/plugins/datejs/date.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('backend/plugins/datepicker/locales/bootstrap-datepicker.id.js') }}" charset="UTF-8"></script>
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- Bootstrap Typeahead -->
<script src="{{ asset('backend/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/select2.full.min.js') }}"></script>
<!-- autonumeric -->
<script src="{{ asset('backend/plugins/autoNumeric/autoNumeric-min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>


<script>
  String.prototype.toRp = function(a,b,c,d,e) {
    e=function(f){return f.split('').reverse().join('')};b=e(parseInt(this,10).toString());for(c=0,d='';c<b.length;c++){d+=b[c];if((c+1)%3===0&&c!==(b.length-1)){d+='.';}}return(a?a:'Rp.\t')+e(d);
  }
  $(function() {
    $.fn.datepicker.defaults.format = "{{ config('liveapp.dateformat', 'dd-MM-yyyy') }}";
    $.fn.datepicker.defaults.language = "en";
    $.fn.datepicker.defaults.todayHighlight = true;
    $.fn.datepicker.defaults.autoclose = true;
    $.fn.datepicker.defaults.forceParse = false;

    $('.datepicker').datepicker(); 
    var form = $('form');      

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.fn.modal.Constructor.DEFAULTS.backdrop = 'static';

    $.fn.liveposCurrency = {aSep: '.', aDec: ',', aSign: 'Rp. ', lZero: 'deny'};
    $.fn.liveposNumeric = {aSep: '.', aDec: ',', aSign: '', lZero: 'deny'};
    $.fn.liveposTelephone = {aSep: '', aDec: ',', aSign: '', lZero: 'keep', 'mDec': '0'};

    $('select').select2({windowdth: '100%'});    
    
    $('.input-mask.input-mask-currency').autoNumeric('init', $.fn.liveposCurrency);
    $('.input-mask.input-mask-numeric').autoNumeric('init', $.fn.liveposNumeric);
    $('.input-mask.input-mask-telephone').autoNumeric('init', $.fn.liveposTelephone);

    form.submit(function(e) {
      form.find('.btn-primary').prop('disabled', true); 
      form.find('.input-mask').each(function(i, e) {
        var v = $(this).autoNumeric('get');
        console.log(v)
        $(this).val(v);
      })
      form.find('.datepicker').each(function(i, e) {
        var v = $(this).val();
        d = Date.parseExact(v, [$.fn.datepicker.defaults.format, 'dd-MMM-yyyy']);
        newDate = d.toString('yyyy-MM-dd');
        $(this).val(newDate);
      })
      return true;
    })

      var slideToTop = $("<div />");
      slideToTop.html('<i class="fa fa-chevron-up"></i>');
      slideToTop.css({
        position: 'fixed',
        bottom: '40px',
        right: '25px',
        width: '40px',
        height: '40px',
        color: '#eee',
        'font-size': '',
        'line-height': '40px',
        'text-align': 'center',
        'background-color': '#222d32',
        cursor: 'pointer',
        'border-radius': '5px',
        'z-index': '99999',
        opacity: '.7',
        'display': 'none'
      });
      slideToTop.on('mouseenter', function () {
        $(this).css('opacity', '1');
      });
      slideToTop.on('mouseout', function () {
        $(this).css('opacity', '.7');
      });
      $('.wrapper').append(slideToTop);
      $(window).scroll(function () {
        if ($(window).scrollTop() >= 50) {
          if (!$(slideToTop).is(':visible')) {
            $(slideToTop).fadeIn(500);
          }
        } else {
          $(slideToTop).fadeOut(500);
        }
      });
      $(slideToTop).click(function () {
        $("body").animate({
          scrollTop: 0
        }, 500);
      });
  @if(isset($base))
    $('.datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ $dataUrl or url($base.'/data') }}',
        columns: [
          @foreach(array_keys($fields) as $field) { name: '{{ $field }}', data: '{{ $field }}', sortable: {{ in_array($field, $unsortables) ? 'false' : 'true'}}, searchable: {{ in_array($field, $unsortables) ? 'false' : 'true'}}}, @endforeach
          @if (!isset($withoutMenu)) { name: 'menu', data: 'menu', sortable: false, searchable: false }, @endif
        ],
    });
  @endif
  
  })

</script>

@if (isset($withoutSearch) && $withoutSearch)
<style type="text/css">
  .dataTables_filter {
    display: none;
  }
</style>
@endif

@yield('script.footer')

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
@stop
@endif
@yield('templateBody')
</html>
