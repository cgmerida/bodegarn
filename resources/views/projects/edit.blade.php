@extends('admin.master')

@section('page-header')
	Proyecto <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($project, [
			'route' => ['projects.update', $project],
			'method' => 'put',
		])
	!!}

		@include('projects.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop