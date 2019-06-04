@extends('admin.master')

@section('css')
    @include('admin.partials.datatables')
@endsection

@section('page-header')
    Asignar material a Proyecto<small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        @can('projects.create')
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            {{ trans('app.add_button') }} Proyectos
        </a>
        @endcan
        
        @can('materials.create')
        <a href="{{ route('materials.create') }}" class="btn btn-secondary">
            {{ trans('app.add_button') }} Material
        </a>
        @endcan
    </div>
    
    <div class="bgc-white bd bdrs-3 p-20 mB-20 materials">
        <div class="row">
            <div class="col-4">
                {!! Form::mySelect('project_id', 'Proyecto', $projects) !!}
            </div>
            
            <div class="col-4">
                {!! Form::myInput('text','recipient', 'Receptor') !!}
            </div>
        </div>
        
        <div class="row">
            <div class="col-4">
                {!! Form::mySelect('material_id[]', 'Material', $materials) !!}
            </div>

            <div class="col-2">
                {!! Form::myInput('number','amount[]', 'Cantidad', ['min' => 0]) !!}
            </div>
            <div class="col-2 my-auto">
                <button class="btn btn-success rounded-circle" onclick="addMaterial(this.parentNode.parentNode)" data-toggle="tooltip" title="Agregar material">
                    <i class="fa fa-plus"></i>
                </button>
                <button class="btn btn-danger rounded-circle disabled" disabled onclick="deleteMaterial(this.parentNode.parentNode)" data-toggle="tooltip" title="Quitar Material">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        
        <button class="btn btn-warning pull-right" onclick="submitAssign()">
            <i class="fa fa-check"></i> Asignar Material
        </button>
        
        <div class="clearfix"></div>
    </div>
@endsection


@section('js')

    @include('admin.swals')
    
    <script>

        function addMaterial(materialDiv) {
            $('button.btn-danger').removeClass('disabled');
            $('button.btn-danger').attr('disabled', false);

            const template = `
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="material_id">Material</label>
                        <select class="form-control" id="material_id" name="material_id[]">
                            ${$('select[name^=material_id]:first').html()}
                        </select>
                    </div>
                </div>

                <div class="col-2">
                    <div class="form-group">
                        <label for="amount">Cantidad</label>
                        <input class="form-control" name="amount[]" type="number" id="amount">
                    </div>
                </div>
                <div class="col-2 my-auto">
                    <button class="btn btn-success rounded-circle"
                    onclick="addMaterial(this.parentNode.parentNode)" data-toggle="tooltip" title="Agregar material">
                        <i class="fa fa-plus"></i>
                    </button>
                    <button class="btn btn-danger rounded-circle"
                    onclick="deleteMaterial(this.parentNode.parentNode)" data-toggle="tooltip" title="Quitar Material">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>`;

            $(template).insertAfter($(materialDiv));
            
            $('[data-toggle="tooltip"]').tooltip({ trigger: 'hover' });

        }
        
        function deleteMaterial(material) {
            $(".tooltip").tooltip("hide");
            $(material).remove();

            if ($('button.btn-danger').length <= 1) {
                $('button.btn-danger').addClass('disabled');
                $('button.btn-danger').attr('disabled', true);
            }
        }

        function submitAssign() {
            let project = $('#project_id').val();
            let recipient = $('#recipient').val();
            let materials = {};

            let materials_ids = [];
            $('[name^=material_id]').filter(function() {
                return $(this).val() > 0;
            }).each(function() {
                return materials_ids.push($(this).val());
            });

            let amounts = [];
            $('[name^=amount]').filter(function() {
                return $(this).val() > 0;
            }).each(function() {
                return amounts.push($(this).val());
            });

            if (materials_ids.length != amounts.length || materials_ids.length <= 0 || amounts.length <= 0 || project <= 0 || !recipient) {
                swal("¡Alto!", "Llenar todos los campos", "warning");
                return false;
            }

            for (let i = 0; i < materials_ids.length; i++) {
                let temp = {};
                temp['amount'] = parseInt(amounts[i]);
                temp['recipient'] = recipient;
                materials[materials_ids[i]] = temp;
            }
            axios.post(`/projects/${project}/materials/assign`, {
                materials
            })
            .then(function (response) {
                // handle success
                if (response.data.status !== 'ok') {
                    throw new Error(response.data.message || 'Error desconocido')
                }
                
                swal("¡Realizado!", response.data.message, "success");

                $('.materials > .row').not('.materials > .row:first, .materials > .row:nth-child(2)').remove();
                $(':input').val('');
            })
            .catch(function (error) {
                // handle error
                swallError(error);
            });
        }
    </script>
@endsection