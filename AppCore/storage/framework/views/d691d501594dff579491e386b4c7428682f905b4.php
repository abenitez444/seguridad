<?php $__env->startSection('title'); ?>Usuarios <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div id="component">
	<section class="content-header">
		<h1>
			Usuarios registrados
			<small> listado</small>
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
				<h3 class="box-title">Lista de usuarios</h3>
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
			<div class="box-body table-responsive">
				<table id="tableList" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Email</th>
							<th>Teléfono</th>
							<th>Tipo</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="user in users">
							<th>
								{{ user.name }}
							</th>
							<th>
								{{ user.email }}
							</th>
							<th>
								{{ user.phone }}
							</th>
							<th>
								<template v-if="user.type == 'admin' ">
									ADMINISTRADOR
								</template>
								<template v-if="user.type == 'user' ">
									CLIENTE
								</template>
							</th>
							<th>
								<template v-if="user.is_active == 1">
									<small class="label pull-left bg-green">ACTIVO</small>
								</template>
								<template v-else>
									<small class="label pull-left bg-yellow">INACTIVO</small>
								</template>
							</th>
							<th style="width: 12%;">
								<a :href="'<?php echo e(url('/')); ?>/admin_/general/user/' + user.id">
									<button type="button" class="btn btn-warning btn-sm" v-on:click="view(user)" v-if="user.id != '<?php echo e(Auth::user()->id); ?>'"><i class="fa fa-edit"></i></button>
								</a>
								<!--<button type="button" class="btn btn-danger btn-sm " v-on:click="remove(brand)"><i class="fa fa-trash"></i></button>-->
							</th>
						</tr>
						<tr v-if="users.length == 0">
							<th colspan="6">No se encuentra ningun registro</th>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Nombre</th>
							<th>Email</th>
							<th>Teléfono</th>
							<th>Tipo</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
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
<script type="text/javascript">const ID_AUTH = "<?php echo e(Auth::user()->id); ?>";</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/general/users/index.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/admin/general/users/index.blade.php ENDPATH**/ ?>