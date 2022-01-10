<?php $__env->startSection('title'); ?>Publicaciones <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Publicaciones
			<small>listado</small>
			<a href="<?php echo e(route('publication.create')); ?>"><button class="btn btn-sm btn-info" ><i class="fa fa-plus"></i> Nuevo</button>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Publicaciones</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">

		<div class="box box-info">
			<div class="overlay" v-if="searching == true">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			<div class="box-header">
				<h3 class="box-title">Listado de publicaciones</h3>
				<ul class="pagination pagination-sm no-margin pull-right" v-if="publications.length > 0">
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
							<th>Titulo</th>
							<th>Autor</th>
							<th>Categorías</th>
							<th>Visibilidad</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="publication in publications">
							<th>
								{{ publication.title }}
							</th>
							<th>
								{{ publication.author }}
							</th>
							<th>
								<b></b>
								<template v-for="category in publication.categories">
									<b>{{ category.name }}</b>,
								</template>
							</th>
							<th>{{ publication.visibility }}</th>
							<th>
								<template v-if="publication.is_active">
									<small class="label pull-left bg-green">ACTIVO</small>
								</template>
								<template v-else>
									<small class="label pull-left bg-yellow">INACTIVO</small>
								</template>
							</th>
							<th class="text-right" style="width: 10%;">
								<a :href="'<?php echo e(url('/')); ?>/admin_/blog/publication/'+publication.id+'/edit'"><button type="button" class="btn btn-warning btn-sm" ><i class="fa fa-edit"></i></button></a>
								<button type="button" class="btn btn-danger btn-sm " v-on:click="remove(publication)"><i class="fa fa-trash"></i></button>
							</th>
						</tr>
						<tr v-if="publications.length == 0">
							<th colspan="6">No se encuentra ningun registro</th>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Titulo</th>
							<th>Autor</th>
							<th>Categorías</th>
							<th>Visibilidad</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="box-footer clearfix" v-if="publications.length > 0">
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
	</section>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/blog/publications.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/drbulla/AppGestorContenido/resources/views/admin/blog/publicationsList.blade.php ENDPATH**/ ?>