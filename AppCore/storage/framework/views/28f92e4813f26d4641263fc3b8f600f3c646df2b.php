<?php $__env->startSection('title'); ?>Renuncias y Despidos <?php $__env->stopSection(); ?>

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
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Renuncias y Despidos</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
					<li class="breadcrumb-item active">Renuncias y Despidos</li>
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
			<h3 class="card-title">Listados de renuncias y despidos</h3>

			<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('create_dismissal')): ?>
			<div class="card-tools">
				<button class="btn btn-primary mr-1 mb-1" @click="addNew()" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus-square"></i> Agregar</button>
			</div>
			<?php endif; ?>
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
	                        	<td class="text-center">
	                        		{{ row.type}}
	                        	</td>
	                        	<td class="text-center">
	                        		{{ row.vigilant_principal.name }}
	                        		<template v-if="row.vigilant_change != null">
	                        			<br/>
	                        			<label>Relevó en programación: </label> {{ row.vigilant_change.name }}
	                        		</template>
	                        	</td>
	                        	<td class="text-center">{{ row.date }}</td>
	                        	<td class="text-center">{{ row.details }}</td>
	                            <td class="text-right" style="width: 10%; white-space: nowrap;">
	                            	<a v-if="row.has_doc" :href="storage_folder+row.url_doc" target="_blank"><button type="button" class="btn btn-icon btn-outline-info mr-1 mb-1 waves-effect waves-light"><i class="fa fa-eye"></i> Ver documento</button></a>
	                            	<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('delete_dismissal')): ?>
	                                <button type="button" class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light" v-on:click="removeItem(row)"><i class="fa fa-trash"></i></button>
	                                <?php endif; ?>
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
		<!-- /.card-body -->
		<!-- <div class="card-footer">
			Footer
		</div>-->
		<!-- /.card-footer-->
	</div>
	<!-- /.card -->
	<!-- Modal -->
	<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('create_dismissal')): ?>
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
                            	<div class="col-12 col-sm-12 col-md-4 col-lg-4">
	                                <div class="form-group">
	                                    <label>Vigilante *</label>
	                                    <div class="input-group mb-3">
	                                        <select class="form-control" name="vigilant_id" v-model="novelty.vigilant_principal.id" @change="changeVigilant()">
	                                        	<option value="">-- Seleccionar --</option>
	                                        	<option v-for="v in all_watchmen" :value="v.id" v-if="v.is_active">{{ v.name }}</option>
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
	                                    <label>Tipo *</label>
	                                    <div class="input-group mb-3">
	                                        <select class="form-control" name="type" v-model="novelty.type" :disabled="novelty.vigilant_principal.id == ''">
	                                        	<option value="">-- Seleccionar --</option>
	                                        	<option value="Despido">Despido</option>
	                                        	<option value="Renuncia">Renuncia</option>
	                                        </select>
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-file"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>


	                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
	                                <div class="form-group">
	                                    <label>Fecha *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="date" class="form-control" name="date" v-model="novelty.date" :disabled="novelty.vigilant_principal.id == ''">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-user-clock"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="col-12 col-sm-12 col-md-4 col-lg-4" v-if="vigilant_selected.has_assignment">
	                                <div class="form-group">
	                                    <label>Vigilante relevo *</label>
	                                    <div class="input-group mb-3">
	                                        <select class="form-control" name="vigilant_change_id" v-model="vigilant_change_id" :disabled="novelty.vigilant_principal.id == ''">
	                                        	<option value="">-- Seleccionar --</option>
	                                        	<option v-for="w in watchmen_free" :value="w.id" v-if="!inListSelected(w) && w.is_active">{{ w.name }}</option>
	                                        </select>
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-user-secret"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            	<div class="form-group">
	                            		<div class="form-check">
						                    <input type="checkbox" name="has_doc" class="form-check-input" v-model="novelty.has_doc" @change="loadDoc()">
						                    <label class="form-check-label" for="has_doc"> Tiene Documento</label>
						                </div>
	                            	</div>
	                            </div>

	                            <template v-if="novelty.has_doc">
	                            	<div class="col-12 col-sm-12 col-md-3 col-lg-3"></div>
	                            	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        				<div class="form-group">
	                                        <label>Ingrese el documento (Solo archivos con la siguientes extenciones: PNG, JPG, JPEG, PDF, DOCX, CVS, XLSX, XLSM) *</label>
	                                        <div class="position-relative has-icon-left" id="image">
	                                            <input type="file" class="dropify" ref="image" name="image" v-on:change="readFile()" data-allowed-file-extensions="jpg png jpeg pdf docx cvs xlsx xlsm">
	                                        </div>
	                                    </div>
                        			</div>
                        			<div class="col-12 col-sm-12 col-md-3 col-lg-3"></div>
	                            </template>

	                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                                <div class="form-group">
	                                    <label>Observación</label>
	                                    <div class="input-group mb-3">
	                                    	<textarea class="form-control" name="details" v-model="novelty.details" :disabled="novelty.vigilant_principal.id == ''"></textarea>
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
								<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true || novelty.vigilant_principal.id == ''">
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
	<?php endif; ?>
	<!-- /.modal -->
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/resignations-and-dismissals.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/programacionlogr/public_html/AppCore/resources/views/admin/resignationsAndDismissals.blade.php ENDPATH**/ ?>