@extends('admin.master')

@section('page-header')
	Material <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($material, [
			'route' => ['materials.update', $material],
			'method' => 'put',
		])
	!!}

		@include('materials.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop