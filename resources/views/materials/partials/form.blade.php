<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'code', 'Codigo del Material') !!}
{{-- 			
			{!! Form::myInput('number', 'group', 'Grupo') !!} --}}
			
			{!! Form::myInput('text', 'name', 'Nombre del Material') !!}

			{!! Form::myInput('text', 'measure', 'Unidad de Medida <small>no utilice abreviaciones solo palabras completas. ejemplo: libras, bolsas, unidad.</small>') !!}
			
			{!! Form::myInput('number', 'stock', 'Existencia física') !!}

			{!! Form::myInput('number', 'min', 'Cantidad Minima') !!}
		</div>  
	</div>
</div>