<?php $__env->startSection('title'); ?>Editar slider principal <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Slider principal
			<small>Editar / listado</small>
			<button class="btn btn-sm btn-info" v-on:click="addNew()"><i class="fa fa-plus"></i> Agregar</button>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Slider principal</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">

		<div class="box box-info">
			<div class="overlay" v-if="searching == true">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			<div class="box-header">
				<h3 class="box-title">Listado de imagenes del Slider</h3>
				<ul class="pagination pagination-sm no-margin pull-right" v-if="sliders.length > 0">
					<li>
						<a href="javascript:void(0)" v-on:click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page < 1" v-if="pagination.current_page > 1">&laquo;</a>
					</li>
					<li >
						<a href="javascript:void(0)" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]" v-on:click="changePage(page)">{{ page }}</a>
					</li>
					<li >
						<a href="javascript:void(0)" v-on:click="changePage(pagination.current_page + 1)" v-if="pagination.current_page < pagination.last_page">&raquo;</a>
					</li>
				</ul>
			</div>
			<div class="box-body table-responsive">
				<table id="tableList" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center" width="20%">Imagen</th>
							<th>Título</th>
							<th>Prioridad</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="slide in sliders">
							<th class="text-center" width="20%">
								<img :src="'<?php echo e(asset('storage')); ?>/' + slide.image" width="100">
							</th>
							<th>
								{{ slide.title }}
							</th>
							<th>
								{{ slide.order }}
							</th>
							<th>
								<template v-if="slide.is_active == 1">
									<small class="label pull-left bg-green">ACTIVO</small>
								</template>
								<template v-else>
									<small class="label pull-left bg-yellow">INACTIVO</small>
								</template>
							</th>
							<th class="text-right" width="10%">
								<button type="button" class="btn btn-warning btn-sm" v-on:click="view(slide)"><i class="fa fa-edit"></i></button>
								<button type="button" class="btn btn-danger btn-sm " v-on:click="remove(slide)"><i class="fa fa-trash"></i></button>
							</th>
						</tr>
						<tr v-if="sliders.length == 0">
							<th colspan="5">No se encuentra ningun registro</th>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th class="text-center" width="20%">Imagen</th>
							<th>Título</th>
							<th>Prioridad</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="box-footer clearfix" v-if="pagination.last_page > 0">
				<ul class="pagination pagination-sm no-margin pull-right" v-if="sliders.length > 0">
					<li>
						<a href="javascript:void(0)" v-on:click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page < 1" v-if="pagination.current_page > 1">&laquo;</a>
					</li>
					<li >
						<a href="javascript:void(0)" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]" v-on:click="changePage(page)">{{ page }}</a>
					</li>
					<li >
						<a href="javascript:void(0)" v-on:click="changePage(pagination.current_page + 1)" v-if="pagination.current_page < pagination.last_page">&raquo;</a>
					</li>
				</ul>
			</div>
		</div>
		
		<!-- NUEVA IMAGEN DEL SLIDER -->
		<div class="modal fade" id="modal-form">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="box box-info">
						<div class="box-body">
							<div class="row">
								<div class="col-md-12 col-12">
									<form role="form" id="form_" onsubmit="return false;"  enctype="multipart/form-data" v-on:submit="saveForm()">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title">Agregar & Editar</h4>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-12 col-md-12 pl-30 pr-30">
													<div class="row">
														<div class="col-8 col-sm-8 col-md-6 col-lg-6">
															<label for="title">Título: </label>
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-header"></i></span>
																	<input type="text" class="form-control" name="title" placeholder="Título del slider" v-model="slide.title">
																</div>
															</div>
														</div>
														<div class="col-4 col-sm-4 col-md-6 col-lg-6">
															<label for="is_active">Estado: </label>
															<div class="form-group">		
																<div class="checkbox icheck pl-20" >
																	<label>
																		<input type="checkbox" name="is_active" value="1" checked="checked" v-model="slide.is_active" > Activar
																	</label>
																</div>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-12 col-sm-12 col-md-12 col-lg-12">
															<label for="order">Prioridad (El se mostrará en la web desde el num. más alto hacia abajo): </label>
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
																	<input type="number" class="form-control" name="order" placeholder="Orden de prioridad de la imagen en el slider" v-model="slide.order">
																</div>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-12 col-sm-12 col-md-12 col-lg-12">
															<label for="content">Contenido: </label>
															<div class="form-group">		
																<textarea class="form-control" name="content" placeholder="Contenido para esta imagen del slider" rows="10" v-model="slide.content"></textarea>
															</div>
														</div>
													</div>

												</div>
											</div>

											<!-- IMAGENES -->
											<div class="row">
												<div class="col-12 col-md-12 pl-30 pr-30">
													<div class="row">
														<div class="col-sm-12 col-md-12 col-12" id="image">
															<strong>(*)</strong> <label for="image">Imagen </label>
															<input type="file" class="dropify" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" />
														</div>
													</div>
												</div>
											</div>					
											<!-- IMAGENES -->

										</div>
										<div class="modal-footer">
											<div class="callout callout-info text-left">
												<label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label>
											</div>
											<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-primary" :disabled="sending == true">
												<template v-if="!sending">
													<i class="fa fa-save"></i> Guardar cambios
												</template>
												<template v-if="sending">
													<i class="fa fa-spinner fa-spin"></i>
												</template>
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/web/elements/mainSlider.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/drbulla/AppGestorContenido/resources/views/admin/web/mainSlider.blade.php ENDPATH**/ ?>