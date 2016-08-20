<div class="row">
	<div class="col-md-7">
		<div class="box">
		  	<div class="box-body">
				{!! Form::model($model, ['url' => action($baseClass.'@'.$action, !isset($params) ? [] : $params) , 'files' => (isset($formFiles) ? $formFiles : false)]) !!}
				
				@yield('form')
				
				@if (!isset($withoutSubmit) || $withoutSubmit != true)
				<div class="row form-group">
					<div class="col-md-3">&nbsp;</div>
					<div class="col-md-9">
						{!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
						<a href="{{ $formCancelUrl or action($baseClass.'@getIndex') }}" class="btn btn-danger">Batal</a>
					</div>
				</div>
				@endif

				{!! Form::close() !!}
		  	</div><!-- /.box-body -->
		</div><!-- /.box-->
	</div>
	<div class="col-md-5">
		@yield('sideContent')
	</div>
</div>