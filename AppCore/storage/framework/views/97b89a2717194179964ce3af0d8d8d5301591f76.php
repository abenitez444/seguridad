<?php $__env->startSection('title'); ?>Contrataciones <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/dropify/dist/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Contrataciones
		<small>listado</small>
		<button class="btn btn-sm btn-info" id="addNew" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus"></i> Nuevo</button>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Contrataciones</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid" id="component">

	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">Listado de contrataciones</h3>
		</div>
		<div class="box-body table-responsive">
			<table id="tableList" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Titulo</th>
						<th>Descripción</th>
						<th>Cant. Archivos</th>
						<th>Estado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="hiring in hirings">
						<th>
							{{ hiring.title }}
						</th>
						<th>{{ hiring.description }}</th>
						<th>
							{{ hiring.cantFiles }}
						</th>
						<th>
							<template v-if="hiring.is_active">
								<small class="label pull-left bg-green">ACTIVO</small>
							</template>
							<template v-else>
								<small class="label pull-left bg-yellow">INACTIVO</small>
							</template>
						</th>
						<th class="text-right" style="width: 24%;">
							<button type="button" class="btn btn-warning btn-sm" v-on:click="view(hiring)"><i class="fa fa-edit"></i></button>
							<button type="button" class="btn btn-danger btn-sm " v-on:click="remove(hiring)"><i class="fa fa-trash"></i></button>
							<button type="button" class="btn btn-info btn-sm " v-on:click="listFiles(hiring)"><i class="fa fa-eye"></i> Ver / Editar archivos</button>
						</th>
					</tr>
					<tr v-if="hirings.length == 0">
						<th colspan="5">No se encuentra ningun registro</th>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Titulo</th>
						<th>Descripción</th>
						<th>Cant. Archivos</th>
						<th>Estado</th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="box-footer clearfix" v-if="pagination.last_page > 0">
			<ul class="pagination pagination-sm no-margin pull-right">
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
	
	<!-- NUEVA CONTRATACION -->
	<div class="modal fade" id="modal-form">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="row">
					<div class="col-md-12 col-12">
						<form role="form" id="form_" action="<?php echo e(route('hiring.store')); ?>" onsubmit="return false;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">Agregar & Editar</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<strong>(*)</strong> <label for="title">Titulo: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-header"></i></span>
												<input type="text" class="form-control" id="title" name="title" placeholder="Convocatoria pública" v-model="hiring.title">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-sm-12 col-md-12 col-lg-12">
										<label for="title">Descripción: </label>
										<div class="form-group">
											<textarea class="form-control" name="description" v-model="hiring.description">{{ hiring.description }}</textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group">
											<div class="checkbox icheck pl-20">
												<label>
													<input type="checkbox" name="is_active" value="1" checked="checked" v-model="hiring.is_active"> Activar
												</label>
											</div>
										</div>
									</div>									
								</div>

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

	<!-- LISTA DE ARCHIVOS -->
	<div class="modal fade" id="modal-list-file">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="row">
					<div class="col-md-12 col-12">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title">Listado de archivos de <strong>{{ hiring.title }}</strong></h4>
							<button class="btn btn-sm btn-info pull-right"  v-on:click="newFile"><i class="fa fa-plus"></i> Nuevo</button>
						</div>
						<div class="modal-body">
							<div class="box box-info">
								<div class="box-body table-responsive">
									<table id="tableList" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Titulo</th>
												<th>Estado</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="file in files">
												<th>
													{{ file.name }}
												</th>
												<th>
													<template v-if="file.is_active">
														<small class="label pull-left bg-green">ACTIVO</small>
													</template>
													<template v-else>
														<small class="label pull-left bg-yellow">INACTIVO</small>
													</template>
												</th>
												<th class="text-right">
													<a :href="'/storage/'+file.url" target="_blank"><button type="button" class="btn btn-info btn-sm " ><i class="fa fa-eye"></i></button></a>
													<button type="button" class="btn btn-danger btn-sm " v-on:click="removeFile(file)"><i class="fa fa-trash"></i></button>
												</th>
											</tr>
											<tr v-if="files.length == 0">
												<th colspan="3">No se encuentra ningun registro</th>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<th>Titulo</th>
												<th>Estado</th>
												<th></th>
											</tr>
										</tfoot>
									</table>
								</div>	
							</div>
							<div class="modal-footer">
								
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>

	<!-- NUEVO ARCHIVO -->
	<div class="modal fade" id="modal-new-file">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="row">
					<div class="col-md-12 col-12">
						<form role="form" id="form-file" onsubmit="return false;" v-on:submit="saveFile">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">Agregar archivo para la contratación {{ hiring.title }}</h4>
							</div>
							<div class="modal-body">

								<div class="row">
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<strong>(*)</strong> <label for="title">Nombre: </label>
										<div class="form-group">								
											<input type="text" class="form-control" name="nameFile" placeholder="Convocatoria pública" v-model="file.name">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12" id="file">
										<strong>(*)</strong> <label for="logoFooter">Archivo </label>
										<input type="file" class="dropify" name="file" data-max-file-size="5M" data-allowed-file-extensions="pdf" data-default-file="" data-show-remove="true"/>
									</div>
								</div>

								<div class="row">
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group">
											<div class="checkbox icheck pl-20">
												<label>
													<input type="checkbox" name="is_active" value="1" checked="checked" v-model="file.is_active"> Activar
												</label>
											</div>
										</div>
									</div>									
								</div>

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

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('resourcesApp/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/hiring.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/hiring.blade.php ENDPATH**/ ?>