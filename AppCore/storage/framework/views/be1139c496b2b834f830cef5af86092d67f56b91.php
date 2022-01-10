<?php $__env->startSection('title'); ?>Servicios <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/dropify/dist/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div id="component">
	<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Servicios
		<small>listado</small>
		<button class="btn btn-sm btn-info" id="addNew" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus"></i> Nuevo</button>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Servicios</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid" >

	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">Listado de servicios</h3>
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
						<th>Image / Icono</th>
						<th>Descripción</th>
						<th>Simple</th>
						<th>Destacado</th>
						<th>Principal</th>
						<th>Especializado</th>
						<th>Adicional</th>
						<th>Estado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="service in services">
						<th>
							<img :src="'/storage/'+service.image" width="50">
						</th>
						<th>{{ service.name }}</th>
						<th>
							<template v-if="service.is_simple">
								<small class="label pull-left bg-green">SI</small>
							</template>
							<template v-else>
								<small class="label pull-left bg-yellow">NO</small>
							</template>
						</th>
						<th>
							<template v-if="service.is_great">
								<small class="label pull-left bg-green">SI</small>
							</template>
							<template v-else>
								<small class="label pull-left bg-yellow">NO</small>
							</template>
						</th>
						<th>
							<template v-if="service.is_principal">
								<small class="label pull-left bg-green">SI</small>
							</template>
							<template v-else>
								<small class="label pull-left bg-yellow">NO</small>
							</template>
						</th>
						<th>
							<template v-if="service.is_special">
								<small class="label pull-left bg-green">SI</small>
							</template>
							<template v-else>
								<small class="label pull-left bg-yellow">NO</small>
							</template>
						</th>
						<th>
							<template v-if="service.is_aditional">
								<small class="label pull-left bg-green">SI</small>
							</template>
							<template v-else>
								<small class="label pull-left bg-yellow">NO</small>
							</template>
						</th>
						<th>
							<template v-if="service.is_active">
								<small class="label pull-left bg-green">ACTIVO</small>
							</template>
							<template v-else>
								<small class="label pull-left bg-yellow">INACTIVO</small>
							</template>
						</th>
						<th style="width: 12%;">
							<button type="button" class="btn btn-warning btn-sm" v-on:click="view(service)"><i class="fa fa-edit"></i></button>
							<button type="button" class="btn btn-danger btn-sm" v-on:click="remove(service)"><i class="fa fa-trash"></i></button>
						</th>
					</tr>
					<tr v-if="services.length == 0">
						<th colspan="5">No se encuentra ningun registro</th>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Image / Icono</th>
						<th>Descripción</th>
						<th>Simple</th>
						<th>Destacado</th>
						<th>Principal</th>
						<th>Especializado</th>
						<th>Adicional</th>
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
						<form role="form" id="form_" action="<?php echo e(route('services.store')); ?>" onsubmit="return false;">
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
											<input type="text" class="form-control" id="name" name="name" placeholder="Odontología Genreal" v-model="service.name">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-sm-4 col-md-4 col-lg-4">
										<div class="form-group">
											<div class="checkbox icheck pl-20">
												<label>
													<input type="checkbox" name="is_active" value="1" checked="checked" v-model="service.is_active"> Activar
												</label>
											</div>
										</div>
									</div>
									<div class="col-12 col-sm-4 col-md-4 col-lg-4">
										<div class="form-group">
											<div class="checkbox icheck pl-20">
												<label>
													<input type="checkbox" name="is_principal" value="1" checked="checked" v-model="service.is_principal"> Principal
												</label>
											</div>
										</div>
									</div>
									<div class="col-12 col-sm-4 col-md-4 col-lg-4">
										<div class="form-group">
											<div class="checkbox icheck pl-20">
												<label>
													<input type="checkbox" name="is_simple" value="1" checked="checked" v-model="service.is_simple"> Simple
												</label>
											</div>
										</div>
									</div>									
								</div>

								<div class="row">
									<div class="col-12 col-sm-4 col-md-4 col-lg-4">
										<div class="form-group">
											<div class="checkbox icheck pl-20">
												<label>
													<input type="checkbox" name="is_great" value="1" checked="checked" v-model="service.is_great"> Destacado
												</label>
											</div>
										</div>
									</div>
									<div class="col-12 col-sm-4 col-md-4 col-lg-4">
										<div class="form-group">
											<div class="checkbox icheck pl-20">
												<label>
													<input type="checkbox" name="is_special" value="1" checked="checked" v-model="service.is_special"> Especializado
												</label>
											</div>
										</div>
									</div>
									<div class="col-12 col-sm-4 col-md-4 col-lg-4">
										<div class="form-group">
											<div class="checkbox icheck pl-20">
												<label>
													<input type="checkbox" name="is_aditional" value="1" checked="checked" v-model="service.is_aditional"> Adicional
												</label>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12" id="image">
										<label for="logoFooter">Imagen / Icono </label>
										<input type="file" class="dropify" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" v-on:change="imageChange" data-default-file="" data-show-remove="true"/>
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
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('resourcesApp/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/services.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/elements2.blade.php ENDPATH**/ ?>