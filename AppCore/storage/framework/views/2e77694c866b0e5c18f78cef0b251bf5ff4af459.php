<?php $__env->startSection('title'); ?>Suscriptores <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div id="component">
	<section class="content-header">
	<h1>
		Suscriptores registrados
		<small> listado</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Suscriptores</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid" >

	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">Lista de suscriptores</h3>
		</div>
		<div class="box-body table-responsive">
			<table id="tableList" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Email</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="subscriber in subscribers">
						<th>
							{{ subscriber.email }}
						</th>
						<th style="width: 12%;">
							<button type="button" class="btn btn-danger btn-sm" v-on:click="remove(subscriber)"><i class="fa fa-trash"></i></button>
						</th>
					</tr>
					<tr v-if="subscribers.length == 0">
						<th colspan="2">No se encuentra ningun registro</th>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Email</th>
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
</section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/subscriber.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/paginasOdontologas/AppGestorContenido/resources/views/admin/subscriber.blade.php ENDPATH**/ ?>