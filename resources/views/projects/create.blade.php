@extends('admin.master')

@section('page-header')
	Proyecto <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'projects.store',
			'files' => true
		])
	!!}

		@include('projects.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop