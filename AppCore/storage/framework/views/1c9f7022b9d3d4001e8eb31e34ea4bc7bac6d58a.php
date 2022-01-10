<?php $__env->startSection('title'); ?>Emails <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div id="component">
	<section class="content-header">
	<h1>
		Emails recibidos 
		<small> listado</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Emails</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid" >

	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">Lista de emails</h3>
		</div>
		<div class="box-body table-responsive">
			<table id="tableList" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Email</th>
						<th>Tipo</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="email in emails">
						<th>
							{{ email.name }}
						</th>
						<th>
							{{ email.email }}
						</th>
						<th>
							{{ email.type }}
						</th>
						<th style="width: 12%;">
							<button type="button" class="btn btn-info btn-sm" v-on:click="show(email)"><i class="fa fa-eye"></i></button>
							<button type="button" class="btn btn-danger btn-sm" v-on:click="remove(email)"><i class="fa fa-trash"></i></button>
						</th>
					</tr>
					<tr v-if="emails.length == 0">
						<th colspan="2">No se encuentra ningun registro</th>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Nombre</th>
						<th>Email</th>
						<th>Tipo</th>
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
						<form role="form" id="form_" onsubmit="return false;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">Informacion de email</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<label for="name">Nombre: </label>
										<div class="form-group">								
											<input type="text" class="form-control" name="name" v-model="email.name"  disabled="disabled">
										</div>
									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<label for="name">Email: </label>
										<div class="form-group">								
											<input type="text" class="form-control" name="email" v-model="email.email"  disabled="disabled">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<label for="name">Teléfono: </label>
										<div class="form-group">								
											<input type="text" class="form-control" name="phone" v-model="email.phone"  disabled="disabled">
										</div>
									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<label for="name">Tipo: </label>
										<div class="form-group">								
											<input type="text" class="form-control" name="type" v-model="email.type"  disabled="disabled">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group" >
										<label for="message">Mensaje: </label>
										<textarea id="message" name="message" rows="10" cols="80" v-model="email.message" class="form-control" disabled="disabled"></textarea>
									</div>
								</div>

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
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/email.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/email.blade.php ENDPATH**/ ?>