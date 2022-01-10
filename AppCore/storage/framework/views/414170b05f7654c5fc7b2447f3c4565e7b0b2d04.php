<?php $__env->startSection('title'); ?>Elementos de la pagina <?php echo e($page->name); ?> <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/dropify/dist/css/dropify.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('resourcesApp/plugins/jodit/build/jodit.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div id="component">
	<section class="content-header">
	<h1>
		Elementos de la página <b><?php echo e($page->name); ?></b>
		<small> listado</small>
		<button class="btn btn-sm btn-info" v-on:click="addNew()"><i class="fa fa-plus"></i> Nuevo</button>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Elementos de página</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid" >

	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">Listado de elementos</h3>
			<!--
				<div class="box-tools">
					<div class="input-group input-group-sm" style="width: 150px;">
						<input type="text" name="search" v-model="search" class="form-control pull-right" placeholder="Search">
						<div class="input-group-btn">
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>
			-->
		</div>
		<div class="box-body table-responsive">
			<table id="tableList" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Imagen</th>
						<th>Nombre</th>
						<th>Titulo a mostrar</th>
						<th>Tipo</th>
						<th>Estado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="element in elements">
						<th>
							<img :src="'/storage/'+element.image" width="50">
						</th>
						<th>
							{{ element.name }}
						</th>
						<th>
							{{ element.title }}
						</th>
						<th>
							{{ element.type }}
						</th>
						<th>
							<template v-if="element.is_active">
								<small class="label pull-left bg-green">ACTIVO</small>
							</template>
							<template v-else>
								<small class="label pull-left bg-yellow">INACTIVO</small>
							</template>
						</th>
						<th style="width: 12%;">
							<button type="button" class="btn btn-warning btn-sm" v-on:click="view(element)"><i class="fa fa-edit"></i></button>
							<button type="button" class="btn btn-danger btn-sm" v-on:click="remove(element)"><i class="fa fa-trash"></i></button>
						</th>
					</tr>
					<tr v-if="elements.length == 0">
						<th colspan="6">No se encuentra ningun registro</th>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Imagen</th>
						<th>Nombre</th>
						<th>Titulo a mostrar</th>
						<th>Tipo</th>
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

	<div class="modal fade" id="modal-form">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="row">
					<div class="col-md-12 col-12">
						<form role="form" id="form_" onsubmit="return false;" v-on:submit="saveForm()">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">Agregar & Editar</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<strong>(*)</strong> <label for="name">Nombre: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-header"></i></span>
												<input type="text" class="form-control" name="name" placeholder="Misión" v-model="element.name">
											</div>
										</div>
										<input type="hidden" name="page_id" v-model="page_id" value="<?php echo e($page->id); ?>">
									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<label for="name">Titulo a mostrar: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
												<input type="text" class="form-control" name="title" placeholder="Misión" v-model="element.title">
											</div>
										</div>
									</div>
								</div>
								<div class="row">									
									<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
										<strong>(*)</strong> <label for="type">Tipo de elemento: </label>
										<div class="form-group">								
											<select class="form-control" v-model="element.type" name="type" style="width: 100%;">
												<?php if($page->id != 7): ?><option value="tab">Tab Información</option><?php endif; ?>
												<option value="slider">Slider</option>
												<option value="banner">Banner</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-sm-4 col-md-4 col-lg-4">
										<div class="form-group">
											<label for="type">Mostrar en la web: </label>
											<div class="checkbox icheck pl-20">
												<label>
													<input type="checkbox" name="is_active" value="1" checked="checked" v-model="element.is_active"> Activar
												</label>
											</div>
										</div>
									</div>						
								</div>
	
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12" id="image">
										<label for="image">Imagen </label>
										<input type="file" class="dropify" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" data-default-file="" data-show-remove="true" />
									</div>	
								</div>

								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group" >
										<label for="content">Contenido: </label>
										<textarea id="content" name="content" rows="10" cols="80" v-model="element.content"></textarea>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<div class="callout callout-info text-left">
									<label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label>
									<p><label>Los campos que deje vacio en blanco se tomará como inactivo y por ende no se mostrara</label></p>
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
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('resourcesApp/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/jodit/build/jodit.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/element.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/elements.blade.php ENDPATH**/ ?>