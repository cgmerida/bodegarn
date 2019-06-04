@extends('admin.master')

@section('page-header')
	Material <small>ver</small>
@stop

@section('content')
	{!! Form::model($material, [
            'id' => 'main-form'
		])
	!!}

		@include('materials.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection