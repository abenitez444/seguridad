<?php $__env->startSection('title'); ?>Artículos <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Artículos
			<small>listado</small>
			<a href="<?php echo e(route('shop.products.create')); ?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Nuevo</button></a>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="#"><i class="fa fa-shopping-cart"></i> Shop</a></li>
			<li class="active">Artículos</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">

		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Listado de artículos</h3>
				<ul class="pagination pagination-sm no-margin pull-right" v-if="articles.length > 0">
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
							<th>Referencia</th>
							<th>Marca</th>
							<th>Categoría</th>
							<th>Precio</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="article in articles">
							<th>
								{{ article.name }}
							</th>
							<th>
								{{ article.reference }}
							</th>
							<th>
								<template v-if="article.brand != null">
									{{ article.brand.name }}
								</template>
								<template v-else>
									
								</template>
							</th>
							<th>
								{{ article.category.name }}
							</th>
							<th>
								{{ article.price }}
							</th>
							<th>
								<template v-if="article.is_active == 1">
									<small class="label pull-left bg-green">ACTIVO</small>
								</template>
								<template v-else>
									<small class="label pull-left bg-yellow">INACTIVO</small>
								</template>
							</th>
							<th class="text-right" style="width: 24%;">
								<button type="button" class="btn btn-warning btn-sm" v-on:click="view(article)"><i class="fa fa-edit"></i></button>
								<!--<button type="button" class="btn btn-danger btn-sm " v-on:click="remove(article)"><i class="fa fa-trash"></i></button>-->
							</th>
						</tr>
						<tr v-if="articles.length == 0">
							<th colspan="7">No se encuentra ningun registro</th>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Nombre</th>
							<th>Referencia</th>
							<th>Marca</th>
							<th>Categoría</th>
							<th>Precio</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="box-footer clearfix" v-if="pagination.last_page > 0">
				<ul class="pagination pagination-sm no-margin pull-right" v-if="articles.length > 0">
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
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/shop/articles.index.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/admin/shop/articles/index.blade.php ENDPATH**/ ?>