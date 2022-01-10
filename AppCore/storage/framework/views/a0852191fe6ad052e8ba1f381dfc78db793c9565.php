<?php $__env->startSection('title'); ?>Cocineros <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
	<style type="text/css">
		.dropify-wrapper{
			height: 300px;
		}
	</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Cocineros</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Cocineros
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <button class="btn btn-dark mr-1 mb-1 waves-effect waves-light" @click="addNew()" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus-square"></i> Agregar</button>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Simple Validation start -->
        <section class="simple-validation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        	<div class="row"  style="width: 90%">
                        		<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        			<h4 class="card-title">Listado de Cocineros</h4>
                        		</div>
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
                    		<div class="heading-elements">
                                <ul class="list-inline mb-0">
                                	<li>
                                		
                                	</li>
                                    <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    <li><a v-on:click="getAllWithPagination()"><i class="feather icon-rotate-cw"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body table-responsive">
                            	<datatable class="table table-hover table-hover-animation mb-0" :columns="columns" :data="rows" :filter="filter">
                            		<template slot-scope="{ row }">
                            			<tr>
                            				<td class="text-center">{{ row.dni }}</td>
                            				<td class="text-center">{{ row.name }}</td>
                            				<td class="text-center">{{ row.email }}</td>
                            				<td class="text-center">{{ row.phone }}</td>
                            				<td class="text-center">{{ row.administrative_fee }} %</td>
                            				<td class="text-center">
                            					<is-active :is_active="row.is_active"></is-active>
                            				</td>
                            				<td class="text-right" style="width: 20%; white-space: nowrap;">
												<button type="button" class="btn btn-icon btn-outline-warning mr-1 mb-1 waves-effect waves-light" v-on:click="view(row)" data-toggle="modal" data-target="#modal-form"><i class="fa fa-edit"></i></button>
												<button type="button" class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light" v-on:click="removeItem(row)"><i class="fa fa-trash"></i></button>
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

                                        <li class="page-item" v-for="page in pagesNumber" :class="page == isActived ? 'active' : '' " aria-current="page"><a class="page-link" href="javascript:void(0)" v-on:click="changePage(page)">{{ page }}</a></li>
                                        
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
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->
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
                            	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            		<div class="row">
                            			<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            				<div class="form-group">
		                                        <label>Imagen de perfil *</label>
		                                        <div class="position-relative has-icon-left" id="image">
		                                            <input type="file" class="dropify" id="image" name="image">
		                                        </div>
		                                    </div>
                            			</div>
                            			<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            				<div class="row">
                            					<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				                                    <div class="form-group">
				                                        <label>Nombre *</label>
				                                        <div class="position-relative has-icon-left">
				                                            <input type="text" class="form-control" placeholder="Ingrese el nombre del cocinero" name="name" v-model="user.name">
				                                            <div class="form-control-position">
				                                                <i class="fa fa-header"></i>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
				                                    <div class="form-group">
				                                        <label>Apellido *</label>
				                                        <div class="position-relative has-icon-left">
				                                            <input type="text" class="form-control" placeholder="Ingrese el apellido del cocinero" name="last_name" v-model="user.last_name">
				                                            <div class="form-control-position">
				                                                <i class="fa fa-header"></i>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
				                                    <div class="form-group">
				                                        <label>Cédula de Identidad *</label>
				                                        <div class="position-relative has-icon-left">
				                                            <input type="text" class="form-control" placeholder="Ingrese la cédula de identidad del cocinero" name="dni" v-model="user.dni" data-height="400">
				                                            <div class="form-control-position">
				                                                <i class="fa fa-address-card"></i>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
				                                    <div class="form-group">
				                                        <label>Correo Electónico *</label>
				                                        <div class="position-relative has-icon-left">
				                                            <input type="email" class="form-control" placeholder="Correo Electónico del cocinero" name="email" v-model="user.email">
				                                            <div class="form-control-position">
				                                                <i class="fa fa-envelope"></i>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
                            				</div>
                            			</div>
                            		</div>
                            	</div>
                                
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Código postal *</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" placeholder="Ingrese el código postal" name="postal_code" v-model="user.postal_code">
                                            <div class="form-control-position">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Teléfono *</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" placeholder="Ingrese el número de teléfono del cocinero" name="phone" v-model="user.phone">
                                            <div class="form-control-position">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Celular *</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" placeholder="Ingrese el número de celular del cocinero" name="cellular" v-model="user.cellular">
                                            <div class="form-control-position">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Ciudad *</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" placeholder="Ingrese la ciudad del cocinero" name="city" v-model="user.city">
                                            <div class="form-control-position">
                                                <i class="feather icon-map-pin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Barrio *</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" placeholder="Ingrese el barrio del cocinero" name="neighborhood" v-model="user.neighborhood">
                                            <div class="form-control-position">
                                                <i class="feather icon-map-pin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Rango de Delivery (Km)*</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" placeholder="Ingrese el barrio del cocinero" name="delivery_distance_range" v-model="user.delivery_distance_range">
                                            <div class="form-control-position">
                                                <i class="feather icon-minus"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Latitud *</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" placeholder="Ingrese la ciudad del cocinero" name="latitude" v-model="user.latitude">
                                            <div class="form-control-position">
                                                <i class="feather icon-map-pin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Longitud *</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" class="form-control" placeholder="Ingrese el barrio del cocinero" name="longitude" v-model="user.longitude">
                                            <div class="form-control-position">
                                                <i class="feather icon-map-pin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>% Tarifa cobro por servicio *</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="number" class="form-control" name="administrative_fee" v-model="user.administrative_fee">
                                            <div class="form-control-position">
                                                <i class="feather icon-percent"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Dirección Detallada *</label>
                                        <div class="position-relative has-icon-left">
                                            <textarea class="form-control" placeholder="Dirección del Cliente" name="address" rows="3" v-model="user.address"></textarea>
                                            <div class="form-control-position">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-12">
                                	<div class="card-header">
		                                <h4 class="card-title">Contraseña de acceso al sistema</h4>
		                            </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Contraseña *</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="password" class="form-control" placeholder="Ingrese el barrio del cocinero" id="password" name="password" v-model="user.password">
                                            <div class="form-control-position">
                                                <i class="feather icon-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Confirmar contraseña *</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="password" class="form-control" placeholder="Ingrese el barrio del cocinero" id="password2" name="password2" v-model="user.password2">
                                            <div class="form-control-position">
                                                <i class="feather icon-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                	<div class="form-group">
                                		<fieldset>
                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                <input type="checkbox" name="is_active" value="1" v-model="user.is_active">
                                                <span class="vs-checkbox">
                                                    <span class="vs-checkbox--check">
                                                        <i class="vs-icon feather icon-check"></i>
                                                    </span>
                                                </span>
                                                <span class="">Activo</span>
                                            </div>
                                        </fieldset>
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
	<!-- /.modal -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/users/cooks.js')); ?>"></script> 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/admin/users/cooks.blade.php ENDPATH**/ ?>