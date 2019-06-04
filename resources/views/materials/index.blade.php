@extends('admin.master')

@section('css')
    @include('admin.partials.datatables')
@endsection

@section('page-header')
    Materiales <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        @can('materials.create')
        <a href="{{ route('materials.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
        @endcan
    </div>

    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Grupo</th>
                    <th>Nombre</th>
                    <th>Unidad de Medida</th>
                    <th>Existencia Física</th>
                    <th>Cantidad Minima</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Código</th>
                    <th>Grupo</th>
                    <th>Nombre</th>
                    <th>Unidad de Medida</th>
                    <th>Existencia Física</th>
                    <th>Cantidad Minima</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        
        </table>
    </div>

@endsection

@section('js')
    @include('admin.swals')

    <script>
        let dtable;
        $(function () {
            dtable = $('#dataTable').DataTable({
                ajax: '/api/materials',
                columns: [
                    {data: 'code'},
                    {data: 'group'},
                    {data: 'name'},
                    {data: 'measure'},
                    {data: 'stock'},
                    {data: 'min'},
                    {data: 'actions'}
                ]
            });
        });

        
        function addMaterial(url) {
            $(".tooltip").tooltip("hide");

            let amount = 0;
            const body = {
                amount: amount
            };
            mySwall('Ingresar Material', 'Agregar a Bodega', 'put', body, url);
        }
        
        function mySwall(title, btn_txt, method, body, url){
            swal.fire({
                title: title,
                input: 'number',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: btn_txt,
                showLoaderOnConfirm: true,
                preConfirm: (amount) => {
                    if (amount <= 0) {
                        swal.showValidationMessage('Ingrese un número mayor a 0');
                        return false;
                    }
                    body.amount = amount;
                    return axios.put(url, body)
                    .then(function (response) {
                        // handle success
                        if (response.data.status === 'error') {
                            throw new Error(response.data.message)
                        }
                        
                        return response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        swal.showValidationMessage(error);
                    });
                },
                allowOutsideClick: () => !swal.isLoading()
            })
            .then(function (data) {
                if (data.value) {
                    dtable.ajax.reload();
                    swal.fire("¡Realizado!", data.value.message, "success");
                }
            });
        }
    </script>
@endsection