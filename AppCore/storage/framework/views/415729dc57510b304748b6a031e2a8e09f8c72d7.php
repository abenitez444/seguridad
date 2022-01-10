<?php $__env->startSection('title'); ?>Adicionales <?php $__env->stopSection(); ?>

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
                    <h2 class="content-header-title float-left mb-0">Adicionales</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Adicionales
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
                        			<h4 class="card-title">Listado de Adicionales</h4>
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
                                            <td class="text-center">
                                                <img :src="'<?php echo e(asset("storage")); ?>/' + row.image" width="100">
                                            </td>
                            				<td class="text-center">{{ row.name }}</td>
                            				<td class="text-center">{{ row.description }}</td>
                                            <td class="text-center">{{ row.price }}</td>
                                            <td class="text-center">{{ row.tax }}</td>
                            				<td class="text-center">{{ row.price_total }}</td>
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
		                                        <label>Imagen del servico *</label>
		                                        <div class="position-relative has-icon-left" id="image">
		                                            <input type="file" class="dropify" ref="image" name="image" v-on:change="readFile">
		                                        </div>
		                                    </div>
                            			</div>
                            			<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            				<div class="row">
                            					<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				                                    <div class="form-group">
				                                        <label>Nombre *</label>
				                                        <div class="position-relative has-icon-left">
				                                            <input type="text" class="form-control" placeholder="Ingrese el nombre del adicional a ofrecer" name="name" v-model="service.name" />
				                                            <div class="form-control-position">
				                                                <i class="fa fa-header"></i>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
				                                    <div class="form-group">
				                                        <label>Precio (Sin Impuesto) *</label>
				                                        <div class="position-relative has-icon-left">
				                                            <money type="text" class="form-control" name="price" v-model="service.price" v-bind="money" v-on:input="calculatedPriceTotal()"></money>
				                                            <div class="form-control-position">
				                                                <i class="fa fa-money"></i>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
				                                    <div class="form-group">
				                                        <label>% Impuesto *</label>
				                                        <div class="position-relative has-icon-left">
				                                            <money type="text" class="form-control" name="tax" v-model="service.tax" v-bind="money"></money>
				                                            <div class="form-control-position">
				                                                <i class="fa fa-percent"></i>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label>Precio Total de Venta *</label>
                                                        <div class="position-relative has-icon-left">
                                                            <money type="text" class="form-control" name="price_total" v-model="service.price_total" disabled="disabled" v-bind="money"></money>
                                                            <div class="form-control-position">
                                                                <i class="fa fa-money"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                            				</div>
                            			</div>
                            		</div>
                            	</div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Descripción Detallada *</label>
                                        <div class="position-relative has-icon-left">
                                            <textarea class="form-control" placeholder="Descripción detallada del adicional" name="description" rows="3" v-model="service.description"></textarea>
                                            <div class="form-control-position">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-12">
                                    <div class="">
                                        <h4 class="card-title">Seleccione la disponibilidad del adicional </h4>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <fieldset>
                                            <div class="vs-radio-con">
                                                <input type="radio" name="availability" value="1" v-model="service.availability">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="">Todos los Días</span>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <fieldset>
                                            <div class="vs-radio-con">
                                                <input type="radio" name="availability" value="2" v-model="service.availability">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="">Selecionar rango</span>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <fieldset>
                                            <div class="vs-radio-con">
                                                <input type="radio" name="availability" value="3" v-model="service.availability">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="">Selecionar Fechas</span>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3" v-if="service.availability == 3">
                                    <div class="form-group">
                                        <div class="position-relative has-icon-left">
                                            <button v-on:click="service.date_availability.push(new Date())" type="button" class="btn pt-1 pb-1 btn-outline-primary btn-sm waves-effect waves-light"><i class="fa fa-plus-square"></i> Agregar Fecha</button>
                                        </div>
                                    </div>
                                </div>

                                <template v-if="service.availability == 2">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Desde *</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="date" class="form-control" name="date_ini_activated" v-model="service.date_ini_activated">
                                                <div class="form-control-position">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Hasta *</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="date" class="form-control" name="date_end_activated" v-model="service.date_end_activated">
                                                <div class="form-control-position">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <template v-if="service.availability == 3">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6" v-for="(data, index) in service.date_availability">
                                        <div class="form-group">
                                            <label>Seleccione la fecha *</label>
                                            <div class="position-relative has-icon-left">
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="date_availability[]" v-model="service.date_availability[index]">
                                                    <div class="input-group-append">
                                                        <a href="javascript:void(0)" v-on:click="servicie.date_availability.splice(index, 1)"><span class="input-group-text" style="width: 100%;height: 100%;border-radius: 0px;"><i class="fa fa-trash"></i></span></a>
                                                    </div>
                                                </div>                                               
                                                <div class="form-control-position">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </template>



                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                	<div class="form-group">
                                		<fieldset>
                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                <input type="checkbox" name="is_active" value="1" v-model="service.is_active">
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
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/v-money-master/dist/v-money.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/cooks/additional.js')); ?>"></script> 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/cooks/additional.blade.php ENDPATH**/ ?>