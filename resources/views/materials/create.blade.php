@extends('admin.master')

@section('page-header')
	Material <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'materials.store',
			'files' => true
		])
	!!}

		@include('materials.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
