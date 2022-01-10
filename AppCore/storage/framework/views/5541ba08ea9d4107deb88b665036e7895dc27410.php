<?php $__env->startSection('title'); ?>Marcas <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Marcas
			<small>listado</small>
			<button class="btn btn-sm btn-info" v-on:click="addNew()"><i class="fa fa-plus"></i> Nuevo</button>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="#"><i class="fa fa-shopping-cart"></i> Shop</a></li>
			<li class="active">Marcas</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">

		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Listado de marcas</h3>
				<ul class="pagination pagination-sm no-margin pull-right" v-if="brands.length > 0">
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
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Cant. Artículos</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="brand in brands">
							<th>
								{{ brand.name }}
							</th>
							<th>
								{{ brand.description }}
							</th>
							<th>
								{{ brand.cantArticles }}
							</th>
							<th>
								<template v-if="brand.is_active == 1">
									<small class="label pull-left bg-green">ACTIVO</small>
								</template>
								<template v-else>
									<small class="label pull-left bg-yellow">INACTIVO</small>
								</template>
							</th>
							<th class="text-right" style="width: 24%;">
								<button type="button" class="btn btn-warning btn-sm" v-on:click="view(brand)"><i class="fa fa-edit"></i></button>
								<button type="button" class="btn btn-danger btn-sm " v-on:click="remove(brand)"><i class="fa fa-trash"></i></button>
							</th>
						</tr>
						<tr v-if="brands.length == 0">
							<th colspan="5">No se encuentra ningun registro</th>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Cant. Artículos</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="box-footer clearfix" v-if="pagination.last_page > 0">
				<ul class="pagination pagination-sm no-margin pull-right" v-if="brands.length > 0">
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
		
		<!-- NUEVA CATEGORÍA -->
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
										<div class="col-12 col-sm-12 col-md-12 col-lg-12">
											<strong>(*)</strong> <label for="title">Nombre: </label>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-header"></i></span>
													<input type="text" class="form-control" id="name" name="name" placeholder="Nombre de marca" v-model="brand.name">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12 col-sm-12 col-md-12 col-lg-12">
											<label for="description">Descripción: </label>
											<div class="form-group">		
												<textarea class="form-control" id="description" name="description" placeholder="Descripción de la marca" rows="10" v-model="brand.description"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12 col-sm-12 col-md-12 col-lg-12">
											<label for="title">Estado: </label>
											<div class="form-group">
												<div class="checkbox icheck pl-20" >
													<label>
														<input type="checkbox" name="is_active" value="1" checked="checked" v-model="brand.is_active" > Activar
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
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/shop/brands.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/AppGestor/AppGestorContenido/resources/views/admin/shop/brands.blade.php ENDPATH**/ ?>