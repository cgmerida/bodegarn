@extends('admin.master')

@section('page-header')
	Proyecto <small>ver</small>
@stop

@section('content')
	{!! Form::model($project, [
            'id' => 'main-form'
		])
	!!}

		@include('projects.partials.form')
		
		@include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection