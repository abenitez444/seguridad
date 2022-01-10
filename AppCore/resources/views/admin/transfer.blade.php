@extends('layouts.admin.main')
@section('title')Traslado de vigilantes @endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Traslado de vigilantes</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content" id="app-main">

	<!-- Default box -->
    <div class="card">
        <div class="overlay dark" v-if="loading">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
            <h3 class="card-title">Listados de traslados</h3>

            <div class="card-tools">
                @if(Auth::user()->is_superadmin || Auth::user()->has_role('create_transfer'))
                <button class="btn btn-primary mr-1 mb-1" @click="addNew()" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus-square"></i> Agregar</button>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6"></div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12">
                                    Filtrar: 
                                </div>
                            </div>
                            <input type="text" name="filter" v-model="filter" class="form-control" placeholder="Escriba para filtrar los resultados">
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12">
                                    Mostrar: 
                                </div>
                            </div>
                            <select class="form-control" v-model="pagination.per_page" v-on:change="getAllWithPagination()">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="300">300</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                                <option :value="pagination.total+1">Todo</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row table-responsive mt-1">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <datatable class="table table-hover table-hover-animation mb-0" :columns="columns" :data="operations" :filter="filter">
                        <template slot-scope="{ row }">
                            <tr>
                                <td class="text-center">@{{ row.id }}</td>
                                <td class="text-center">@{{ row.created_at.split(' ')[0] }}</td>
                                <td class="text-center">@{{ row.clients_origin.name }}</td>
                                <td class="text-center">@{{ row.watchmen.name }}</td>
                                <td class="text-center">@{{ row.clients_destiny.name }}</td>
                                <td class="text-right" style="width: 10%; white-space: nowrap;">
                                    @if(Auth::user()->is_superadmin || Auth::user()->has_role('view_transfer'))
                                    <button type="button" class="btn btn-icon btn-outline-info mr-1 mb-1 waves-effect waves-light" data-toggle="modal" data-target="#modal-form" v-on:click="viewItem(row)"><i class="fa fa-eye"></i> Ver Detalle</button>
                                    @endif
                                     @if(Auth::user()->is_superadmin || Auth::user()->has_role('delete_transfer'))
                                    <button type="button" class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light" v-on:click="removeItem(row)"><i class="fa fa-trash"></i></button>
                                    @endif
                                </td>
                            </tr>
                        </template>
                    </datatable>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center mt-2">
                            <li class="page-item prev-item" v-if="pagination.current_page > 1" v-on:click="changePage(pagination.current_page - 1)">
                                <a class="page-link" href="javascript:void(0)">
                                    <i class="feather icon-chevron-left"></i>
                                </a>
                            </li>

                            <li class="page-item" v-for="page in pagesNumber" :class="page == isActived ? 'active' : '' " aria-current="page"><a class="page-link" href="javascript:void(0)" v-on:click="changePage(page)">@{{ page }}</a></li>
                            
                            <li class="page-item next-item">
                                <a class="page-link" href="javascript:void(0)" v-if="pagination.current_page < pagination.last_page" v-on:click="changePage(pagination.current_page + 1)">
                                    <i class="feather icon-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer">
            Footer
        </div>-->
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    <!-- Modal -->
    <div class="modal modal-right fade" id="modal-form" tabindex="-1" >
        <div class="modal-dialog modal-lg">
            <form onsubmit="return false;" id="form_" class="form form-vertical">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ver / Editar Traslado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <h5 class="modal-title">Completar la información de origen</h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Seleccionar Puesto *</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="clients_id" v-model="operation.clients_id" v-on:change="setClientSelected()" :disabled="action != 'save'">
                                                <option value="">-- Seleccionar --</option>
                                                <option v-for="c in clients" :value="c.id" v-if="c.is_active && !c.is_delete && c.assignments.length > 0">@{{ c.name }}</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-users"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Programación *</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="assignment_id" v-model="operation.assignment_id" :disabled="operation.clients_id == '' || action != 'save'" v-on:change="setAssignment()">
                                                <option value="">-- Seleccionar --</option>
                                                <optgroup v-for="a in operation.client_selected.assignments" :label="'ID: '+a.id">
                                                    <option  :value="a.id">@{{ a.date_ini }} - @{{ a.date_end }}</option>
                                                </optgroup>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-users-cog"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Vigilante *</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="watchmen_id" v-model="operation.watchmen_id" :disabled="operation.assignment_id == '' || action != 'save'" v-on:change="setWatchmen()">
                                                <option value="">-- Seleccionar --</option>
                                                <option v-for="w in operation.assignment_selected.watchmen" :value="w.id">@{{ w.name }}</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-secret"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>En programación desde: </label>
                                        <div class="input-group mb-3">
                                            <input type="text" :disabled="1==1" class="form-control" v-model="operation.watchmen_selected.pivot.date_ini">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-clock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Turno: </label>
                                        <div class="input-group mb-3">
                                            <input type="text" :disabled="1==1" class="form-control" v-model="operation.watchmen_selected.shift.name">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-clock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Inicia de: </label>
                                        <div class="input-group mb-3">
                                            <input type="text" :disabled="1==1" class="form-control" v-model="operation.watchmen_selected.pivot.start">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-clock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr/>

                                <!-- INFORMACIÓN PARA EL TRASLADO -->
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <h5 class="modal-title">Completar la información de traslado</h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Seleccionar Puesto Destino *</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="clients_transfer_id" v-model="operation.clients_transfer_id" v-on:change="setClientTransfer()" :disabled="operation.clients_id == '' || operation.assignment_id == '' || operation.watchmen_id == '' || action != 'save'">
                                                <option value="">-- Seleccionar --</option>
                                                <option v-for="c in clients" :value="c.id" v-if="c.is_active && !c.is_delete && c.assignments.length > 0 && operation.clients_id != c.id">@{{ c.name }}</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-users"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Programación *</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="assignment_transfer_id" v-model="operation.assignment_transfer_id" :disabled="operation.clients_transfer_id == '' || action != 'save'" v-on:change="setAssignmentTransfer()">
                                                <option value="">-- Seleccionar --</option>
                                                <optgroup v-for="a in operation.client_transfer_selected.assignments" :label="'ID: '+a.id">
                                                    <option  :value="a.id">@{{ a.date_ini }} - @{{ a.date_end }}</option>
                                                </optgroup>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-users-cog"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Turno *</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="shift_selected" v-model="operation.shift_selected" :disabled="operation.assignment_transfer_id == '' || action != 'save'" v-if="operation.client_transfer_selected.type_of_programming == 2">
                                                <option value=""> -- Seleccionar -- </option>
                                                <option v-for="shift in operation.client_transfer_selected.shifts_selected" :value="shift.id">@{{ shift.name }}</option>
                                            </select>
                                            <select class="form-control" name="shift_selected" v-model="operation.shift_selected" :disabled="operation.assignment_transfer_id == '' || action != 'save'" v-if="operation.client_transfer_selected.type_of_programming == 1">
                                                <option value="">-- Seleccionar --</option>
                                                <option :value="operation.client_transfer_selected.shift.id"> @{{ operation.client_transfer_selected.shift.name }} </option>
                                            </select>
                                            <select name="shift_selected" v-if="operation.client_transfer_selected.type_of_programming != 2 && operation.client_transfer_selected.type_of_programming != 1" class="form-control" disabled="disabled" v-model="operation.shift_selected">
                                                <option value="">-- Seleccionar --</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-clock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Selecciona el inicio *</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="start_vigilant" v-model="operation.start_vigilant" :disabled="operation.shift_selected == '' || action != 'save'">
                                                <option value=""> -- Seleccionar -- </option>

                                                <option value="D" v-if="(operation.client_transfer_selected.shift.id != 4 && operation.client_transfer_selected.shift.id != 7 && operation.client_transfer_selected.shift.id != 9 && operation.client_transfer_selected.shift.id != 11 && operation.client_transfer_selected.shift.id != 12) && (operation.shift_selected != 4 && operation.shift_selected != 7 && operation.shift_selected != 9 && operation.shift_selected != 11 && operation.shift_selected != 12)">Día</option>
                                                <option value="N" v-if="(operation.client_transfer_selected.shift.id != 5 && operation.client_transfer_selected.shift.id != 6 && operation.client_transfer_selected.shift.id != 8 && operation.client_transfer_selected.shift.id != 10) && (operation.shift_selected != 5 && operation.shift_selected != 6 && operation.shift_selected != 8 && operation.shift_selected != 10)">Noche</option>
                                                <option value="X">Descanso</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-users-cog"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Fecha de inicio *:</label>
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" name="start_date_vigilant" v-model="operation.start_date_vigilant" :disabled="operation.clients_id == '' || operation.assignment_id == '' || operation.watchmen_id == '' || action != 'save'":min="operation.assignment_transfer_selected.date_ini" :max="operation.assignment_transfer_selected.date_end">
                                        </div>
                                    </div>
                                </div>

                                <!-- INFORMACIÓN PARA EL TRASLADO -->

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12" v-if="action == 'save'">
                                    <div class="alert alert-primary" role="alert">
                                        <h4 class="alert-heading">IMPORTANTE: </h4>
                                        <p class="mb-0">
                                            Todos los campos con (*) deben ser completados
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">         
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <button type="button" id="form-close-modal" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" v-if="action == 'save'" :disabled="loading == true">
                                    <template v-if="!loading">
                                        <i class="fa fa-sign-in"></i> Guardar
                                    </template>
                                    <template v-if="loading">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </template>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal -->

</section>
<!-- /.content -->

@endsection

@push('js')
<script type="text/javascript" src="{{ asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js') }}"></script>
<script src="{{ asset('AppResources/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('AppResources/js/admin/transfer.js') }}"></script>
@endpush
