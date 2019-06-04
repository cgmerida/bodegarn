<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Nombre del Proyecto') !!}

			@if (isset($materials) && $materials->count() > 0)
				<hr>
				<h5>Materiales</h5>
				@foreach ($materials as $material)
				<div class="row">
					<div class="col-5">
						{!! Form::myInput('text', 'material', 'Material', [], $material->name) !!}
					</div>
					<div class="col-2">
						{!! Form::myInput('text', 'amount', 'Cantidad', [], $material->pivot->amount) !!}
					</div>
					<div class="col-2">
						{!! Form::myInput('text', 'created_at', 'Fecha', [], $material->pivot->created_at->format('d-m-Y')) !!}
					</div>
					<div class="col-3">
						{!! Form::myInput('text', 'recipient', 'Receptor', [], $material->pivot->recipient) !!}
					</div>
				</div>
				@endforeach
			@endif
		</div>  
	</div>
</div>