
<ul class="list-inline">
    @can('materials.show')
    <li class="list-inline-item">
        <a href="{{ route('materials.show', $id) }}" data-toggle="tooltip"
        title="Ver" class="btn btn-sm btn-outline-secondary">
            <span class="ti-eye"></span>
        </a>
    </li>
    @endcan
    
    @can('materials.edit')
    
    <li class="list-inline-item">
        <button onclick="addMaterial('{{ route('materials.add', $id) }}')" 
        title="Agregar al Stock" data-toggle="tooltip"
        class="btn btn-outline-info btn-sm">
            <span class="ti-plus"></span>
        </button>
    </li>
    
    <li class="list-inline-item">
        <a href="{{ route('materials.edit', $id) }}" 
        title="{{ trans('app.edit_title') }}" data-toggle="tooltip"
        class="btn btn-outline-primary btn-sm">
            <span class="ti-pencil"></span>
        </a>
    </li>
    @endcan
    
    @can('materials.destroy')
    <li class="list-inline-item">
        {!! Form::open([
            'class'=>'delete',
            'route'  => ['materials.destroy', $id], 
            'method' => 'DELETE',
            ]) 
        !!}

            <button class="btn btn-outline-danger btn-sm" data-toggle="tooltip"
            title="{{ trans('app.delete_title') }}">
                <i class="ti-trash"></i>
            </button>
            
        {!! Form::close() !!}
    </li>
    @endcan
</ul>