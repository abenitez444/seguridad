<?php $__env->startSection('title'); ?>Categorías <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Categorías
			<small>listado</small>
			<button class="btn btn-sm btn-info" v-on:click="addNew()"><i class="fa fa-plus"></i> Nuevo</button>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="<?php echo e(route('publication.index')); ?>"><i class="fa fa-th-list"></i> Blog</a></li>
			<li class="active">Categorías</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">

		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Listado de categorías</h3>
			</div>
			<div class="box-body table-responsive">
				<table id="tableList" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Cant. Publicaciones</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="category in categories">
							<th>
								{{ category.name }}
							</th>
							<th>
								{{ category.cantPost }}
							</th>
							<th>
								<template v-if="category.is_active == 1">
									<small class="label pull-left bg-green">ACTIVO</small>
								</template>
								<template v-else>
									<small class="label pull-left bg-yellow">INACTIVO</small>
								</template>
							</th>
							<th class="text-right" style="width: 24%;">
								<button type="button" class="btn btn-warning btn-sm" v-on:click="view(category)"><i class="fa fa-edit"></i></button>
								<button type="button" class="btn btn-danger btn-sm " v-on:click="remove(category)" v-if="category.is_default == 0"><i class="fa fa-trash"></i></button>
							</th>
						</tr>
						<tr v-if="categories.length == 0">
							<th colspan="4">No se encuentra ningun registro</th>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Nombre</th>
							<th>Cant. Publicaciones</th>
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
							<form role="form" id="form_" onsubmit="return false;">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title">Agregar & Editar</h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-6 col-sm-8 col-md-8 col-lg-8">
											<strong>(*)</strong> <label for="title">Nombre: </label>
											<div class="form-group">		<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-header"></i></span>
													<input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la categoría" v-model="category.name">
												</div>
											</div>
										</div>
										<div class="col-6 col-sm-4 col-md-4 col-lg-4" v-if="category.is_default == 0">
											<label for="title">Mostrar en la web: </label>
											<div class="form-group">
												<div class="checkbox icheck pl-20" >
													<label>
														<input type="checkbox" name="is_active" value="1" checked="checked" v-model="category.is_active" > Activar
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
																			
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

<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/blog/category.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/blog/category.blade.php ENDPATH**/ ?>