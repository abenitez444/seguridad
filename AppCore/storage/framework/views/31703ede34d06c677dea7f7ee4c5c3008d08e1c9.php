<?php $__env->startSection('title'); ?>Certificaciones <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Cerificaciones
			<small>Editar / listado de certificaciones</small>
			<button class="btn btn-sm btn-info" v-on:click="addNew()"><i class="fa fa-plus"></i> Agregar</button> 
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Cerificaciones</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">

		<div class="box box-info">
			<div class="overlay" v-if="searching == true">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			<div class="box-header">
				<div class="row">
					<div class="col-12 col-sm-6 col-md-6 col-lg-6">
						<h3 class="box-title">Listado de certificaciones</h3>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6">
						<div class="box-tools pull-right">
							<div class="row">
								<div class="col-12 col-sm-6 col-md-6 col-lg-6">
									<div class="input-group input-group-sm" style="width: 100%;">
										<input type="text" name="table_search" class="form-control pull-right" placeholder="Filtrar resultados" v-model="filter">
									</div>
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-6">
									<div class="input-group input-group-sm" style="width: 100%;" v-on:change="changePerPage()">
										<select class="form-control pull-right" v-model="per_page">
											<option value="10">10</option>
											<option value="15">15</option>
											<option value="20">20</option>
											<option value="30">30</option>
											<option value="50">50</option>
											<option value="100">100</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-body table-responsive">
				<div class="row box-footer clearfix">
					<div class="col-12 col-md-12">
						<ul class="pagination pagination-sm no-margin pull-right" v-if="elements.length > 0">
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
				<datatable :columns="columns" :data="rows" :filter-by="filter" class="table table-bordered table-striped">
					<template scope="{ row }" v-if="elements.length != 0">
						<tr>
							<th class="text-center" width="20%">
								<img :src="'<?php echo e(asset('storage')); ?>/' + row.image" width="100">
							</th>
							<th>{{ row.title }}</th>
							<th>{{ row.content }}</th>
							<th><is-active :is_active="row.is_active"></is-active></th>
							<th class="text-right" style="width: 14%;">
								<button type="button" class="btn btn-warning btn-sm" v-on:click="view(row)"><i class="fa fa-edit"></i></button>
								<button type="button" class="btn btn-danger btn-sm " v-on:click="remove(row)"><i class="fa fa-trash"></i></button>
							</th>
						</tr>
					</template>
				</datatable>
			</div>
			<div class="box-footer clearfix" v-if="pagination.last_page > 0">
				<ul class="pagination pagination-sm no-margin pull-right" v-if="elements.length > 0">
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
																	<input type="text" class="form-control" name="title" placeholder="Título del elemento" v-model="element.title">
																</div>
															</div>
														</div>
														<div class="col-4 col-sm-4 col-md-6 col-lg-6">
															<label for="is_active">Estado: </label>
															<div class="form-group">		
																<div class="checkbox icheck pl-20" >
																	<label>
																		<input type="checkbox" name="is_active" value="1" checked="checked" v-model="element.is_active" > Activar
																	</label>
																</div>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-12 col-sm-12 col-md-12 col-lg-12">
															<label for="content">Contenido: </label>
															<div class="form-group">		
																<textarea class="form-control" name="content" placeholder="Contenido para este elemento" rows="10" v-model="element.content"></textarea>
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
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/web/elements/certification.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/drbulla/AppGestorContenido/resources/views/admin/web/certification.blade.php ENDPATH**/ ?>