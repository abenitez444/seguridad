<?php $__env->startSection('title'); ?>Usuarios <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div id="component">
	<section class="content-header">
		<h1>
			Usuarios registrados
			<small> listado</small>
			<button class="btn btn-sm btn-info" v-on:click="addNew()"><i class="fa fa-plus"></i> Agregar</button> 
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Usuarios</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid" >

		<div class="box box-info">
			<div class="overlay" v-if="searching == true">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			<div class="box-header">
				<div class="row">
					<div class="col-12 col-sm-6 col-md-6 col-lg-6">
						<h3 class="box-title">Listado de usuarios</h3>
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
						<ul class="pagination pagination-sm no-margin pull-right" v-if="users.length > 0">
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
				<datatable :columns="columns" :data="users" :filter-by="filter" class="table table-bordered table-striped" id="tableList">
					<template scope="{ row }" v-if="users.length != 0">
						<tr>
							<th>
								{{ row.name }}
							</th>
							<th>
								{{ row.email }}
							</th>
							<th>
								{{ row.phone }}
							</th>
							<th>
								<template v-if="row.type == 'admin' ">
									ADMINISTRADOR
								</template>
								<template v-if="row.type == 'user' ">
									CLIENTE / USUARIO 
								</template>
							</th>
							<th><is-active :is_active="row.is_active"></is-active></th>
							<th class="text-right" style="width: 14%;">
								<button type="button" class="btn btn-warning btn-sm" v-on:click="view(row)"><i class="fa fa-edit"></i></button>
								<!-- <button type="button" class="btn btn-danger btn-sm " v-on:click="remove(row)"><i class="fa fa-trash"></i></button>-->
							</th>
						</tr>
					</template>
				</datatable>
			</div>
			<div class="box-footer clearfix" v-if="pagination.last_page > 0">
				<ul class="pagination pagination-sm no-margin pull-right" v-if="users.length > 0">
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
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript">const ID_AUTH = "<?php echo e(Auth::user()->id); ?>";</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/general/users/index.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/drbulla/AppGestorContenido/resources/views/admin/general/users/index.blade.php ENDPATH**/ ?>