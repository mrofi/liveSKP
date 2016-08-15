@extends('layout')

@section('templateBody')
<body>
<div class="wrapper">
<h1>Penilaian SKP Daftar Semua SKP</h1>
<div class="box">
  	<div class="box-body">
		<table class="table datatables">
			<thead>
                <tr>
                    <th>ID</th>
                    <th>PNS</th>
                    <th>Nilai</th>
                    <th>Tanggal Penilaian</th>
                    <th>Menu</th>
                </tr>
			</thead>
		</table>  	  	
  	</div><!-- /.box-body -->
</div><!-- /.box-->
</div>
<!-- DataTables -->
<script src="{{ asset('backend/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  @if(isset($base))
    var table = $('.datatables').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[-1], ['All']],
        ajax: '{{ $dataUrl or url($base.'/data') }}',
        columns: [
          @foreach(array_keys($fields) as $field) { name: '{{ $field }}', data: '{{ $field }}', sortable: {{ in_array($field, $unsortables) ? 'false' : 'true'}}, searchable: {{ in_array($field, $unsortables) ? 'false' : 'true'}}}, @endforeach
          @if (!isset($withoutMenu)) { name: 'menu', data: 'menu', sortable: false, searchable: false }, @endif
        ],
    });
    table.on( 'draw', function () {
        setTimeout(function() {window.print()}, 1000);
    } );
  @endif

</script>
<style type="text/css">
  .dataTables_length, .dataTables_filter, .dataTables_paginate {
    display: none;
  }

</style>
</body>
@stop