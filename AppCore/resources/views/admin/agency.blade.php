@extends('layouts.admin.main')
@section('title')Empresa @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Empresa</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item active">Empresa</li>
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
			<h3 class="card-title">Listados de empresas</h3>

			@if(Auth::user()->is_superadmin || Auth::user()->has_role('create_agency'))
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
	                            <td class="text-center"></td>
	                            <td class="text-center"></td>
	                            <td class="text-center"></td>
	                            <td class="text-center"></td>
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
	<!--Modal register and edit agency-->
	@if(Auth::user()->is_superadmin || Auth::user()->has_role('create_shifts') || Auth::user()->has_role('edit_shifts'))
	<div class="modal modal-right fade" id="modal-form" tabindex="-1" >
		<div class="modal-dialog">
			<form onsubmit="return false;" id="form_" class="form form-vertical">
				<div class="modal-content col-md-7 offset-3 p-10" style="border-radius:10px;">
					<div class="modal-header">
						<h5 class="modal-title"><i class="fas fa-city"></i> Agregar / Editar</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-body">
						<v-app>
							<template>
								<form enctype="multipart/form-data" id="formImg">
									<v-row>
										<v-col cols="12" md="12" lg="12" class="text-center">
											<v-avatar
											size="200"
											color="grey"
											>
												<v-img :src="previewAvatar"></v-img>
											</v-avatar>
										</v-col>
										<v-col cols="12" md="6" lg="6" class="text-center mb-6 offset-3" style="margin-top:-15px;">
											<v-file-input
												placeholder="Cargar imagen"
												prepend-icon="mdi-camera-image"
												label="Avatar"
												type="file"
												v-on:change="setAvatar"
											></v-file-input>
										</v-col>
									</v-row>
								</form>	
							</template>
							<template>
								<v-form ref="form" v-model="agency.valid" lazy-validation>
									<v-row>
										<v-col cols="12" sm="6" md="12" lg="12">
											<v-row>
											   <v-col cols="12" sm="6" md="12" lg="12">
													<small class="mb-2"> <i class="fas fa-city fa-sm"></i> Información de la empresa.</small>
											   </v-col>
											</v-row>
											<v-row>
												<v-col cols="12" md="6" lg="6">
													<v-text-field
														v-model="agency.name_agency"
														:rules="rules.nameRules"
														prepend-icon="mdi-city-variant"
														maxlength="50"
														label="Empresa"
														required>
													</v-text-field>
												</v-col>
												<v-col cols="12" md="6" lg="6">
													<v-text-field
														v-model="agency.rut"
														prepend-icon="mdi-credit-card-plus-outline"
														maxlength="50"
														label="RUT"
														required>
													</v-text-field>
												</v-col>
											</v-row>
											<v-row>
												<v-col cols="12" md="6" lg="6">
													<v-text-field
													v-model="agency.email"
													:rules="rules.emailRules"
													prepend-icon='mdi-email'
													maxlength="50"
													label="Correo"
													required>
													</v-text-field>
												</v-col>
												<v-col cols="12" md="6" lg="6">
													<v-text-field
													v-model="agency.local_agency"
													prepend-icon='mdi-phone'
													maxlength="50"
													label="Teléfono"
													>
													</v-text-field>
												</v-col>
											</v-row>
											<v-row>
												<v-col cols="12" md="6" lg="6">
													<v-text-field
														v-model="agency.tlf_agency"
														prepend-icon='mdi-cellphone-android'
														maxlength="50"
														label="Celular"
														>
													</v-text-field>
												</v-col>
												<v-col cols="12" md="6" lg="6" sm="6">
												<v-text-field
													v-model="agency.desc_sociality"
													label="Razón social"
													prepend-icon="mdi-comment"
													></v-text-field>
												</v-col>
											</v-row>
											<v-row>
												<v-col cols="6" sm="4" md="6" lg="6">
													<v-autocomplete
													v-model="agency.country"
													label="País"
													:items="countries"
													item-text="name"
													item-value="id"
													prepend-icon='mdi-map-marker'
													v-on:change="getStates"
													required>
												</v-autocomplete>
												</v-col>
												<v-col cols="6" sm="4" md="6" lg="6">
													<v-autocomplete
													v-model="agency.state"
													label="Estado"
													:items="states"
													item-text="name"
													item-value="id"
													prepend-icon='mdi-map-marker'
													v-on:change="getStates"
													:disabled="stateDisabled"
													required>
												</v-autocomplete>
												</v-col>
											</v-row>
											<v-row>
												<v-col cols="12" sm="4" md="6" lg="6">
													<v-text-field
													v-model="agency.password"
													label="Contraseña"
													name="password"
													prepend-icon="mdi-lock"
													type="password"
													:rules="rules.passwordRules"
													/>
												</v-col>
												<v-col cols="12" sm="4" md="6" lg="6">
													<v-text-field
													v-model="agency.confirmPassword"
													label="Confirmar"
													name="confirmPassword"
													prepend-icon="mdi-lock"
													type="password"
													:rules="rules.confirmPasswordRules.concat(passwordConfirmationRule)"
													/>
												</v-col>
										    </v-row>
											<v-row>
											<div class="col-12 col-sm-12 col-md-12 col-lg-12">
												<div class="form-group">
														<div class="form-check">
															<input type="checkbox" class="form-check-input" id="is_active" v-model="agency.is_active">
															<label class="form-check-label" for="is_active"> Activo</label>
														</div>
													</div>
												</div>
											</v-row>
										</v-col>
									</v-row>
								</v-form>
							</template>
						</v-app>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12">
							<div class="alert alert-primary" role="alert">
								<h4 class="alert-heading">IMPORTANTE: </h4>
								<p class="mb-0">
									Todos los campos con (*) deben ser completados
								</p>
							</div>
						</div>
					</div>
					<div class="modal-footer modal-footer-uniform">			
						<template>
							<v-row>
								<v-col cols="12" md="12" lg="12" sm="6" class="text-center">
									<v-btn type="button" id="form-close-modal" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cerrar</v-btn>
									<v-btn class="btn btn-dark mr-1 mb-1 waves-effect waves-light" @click="saveItem">Guardar</v-btn>
								</v-col>
							</v-row>
						</template>
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
<script type="text/javascript" src="{{ asset('AppResources/js/admin/agency.js') }}"></script>
@endpush
