@extends('layouts.admin.main')
@section('title')Turnos @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Turnos</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item active">Turnos</li>
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
			<h3 class="card-title">Listados de turnos</h3>

			@if(Auth::user()->is_superadmin || Auth::user()->has_role('create_shifts'))
			<div class="card-tools">
				<button class="btn btn-primary mr-1 mb-1" @click="addNew()" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus-square"></i> Agregar</button>
			</div>
			@endif
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
                	<datatable class="table table-hover table-hover-animation mb-0" :columns="columns" :data="rows" :filter="filter">
	                    <template slot-scope="{ row }">
	                        <tr>
	                            <td class="text-center">@{{ row.name }}</td>
	                            <td class="text-center">@{{ row.cant_turn }}</td>
	                            <td class="text-center">@{{ row.cant_watchmen }}</td>
	                            <td class="text-center">
	                                <is-active :is_active="row.is_active"></is-active>
	                            </td>
	                            <td class="text-right" style="width: 10%; white-space: nowrap;">
	                            	@if(Auth::user()->is_superadmin || Auth::user()->has_role('edit_shifts'))
	                                <button type="button" class="btn btn-icon btn-outline-warning mr-1 mb-1 waves-effect waves-light" v-on:click="view(row)" data-toggle="modal" data-target="#modal-form"><i class="fa fa-edit"></i></button>
	                                @endif
	                                @if(Auth::user()->is_superadmin || Auth::user()->has_role('delete_shifts'))
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
	@if(Auth::user()->is_superadmin || Auth::user()->has_role('create_shifts') || Auth::user()->has_role('edit_shifts'))
	<div class="modal modal-right fade" id="modal-form" tabindex="-1" >
		<div class="modal-dialog modal-lg">
			<form onsubmit="return false;" id="form_" class="form form-vertical">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Agregar / Editar</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-body">
                            <div class="row">
                            	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Descripción *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="text" class="form-control" placeholder="Ingrese la descripción o nombre del turno" name="name" v-model="shift.name">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fa fa-edit"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Cantidad de Vigilantes *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="number" min="1" class="form-control" placeholder="Ingrese la cantidad de vigilantes para el turno" name="cant_watchmen" v-model="shift.cant_watchmen">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-user-secret"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Nº de Dias *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="number" min="0" class="form-control" placeholder="Ingrese la cantidad de Dias en la rotación del turno" name="d" v-model="shift.d">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-sun"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Nº de Noches *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="number" min="0" class="form-control" placeholder="Ingrese la cantidad de Noches en la rotación del turno" name="n" v-model="shift.n">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-moon"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Nº de Descansos *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="number" min="0" class="form-control" placeholder="Ingrese la cantidad de Descansos en la rotación del turno" name="x" v-model="shift.x">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-cloud-moon"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            	<div class="form-group">
	                            		<div class="form-check">
						                    <input type="checkbox" class="form-check-input" id="is_active" v-model="shift.is_active">
						                    <label class="form-check-label" for="is_active"> Activo</label>
						                </div>
	                            	</div>
	                            </div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-12">
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
								<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true">
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
	@endif
	<!-- /.modal -->
</section>
<!-- /.content -->

@endsection

@push('js')
<script type="text/javascript" src="{{ asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js') }}"></script>
<script src="{{ asset('AppResources/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('AppResources/componentsVue/is-active.js') }}"></script>
<script type="text/javascript" src="{{ asset('AppResources/js/admin/shifts.js') }}"></script>
@endpush
