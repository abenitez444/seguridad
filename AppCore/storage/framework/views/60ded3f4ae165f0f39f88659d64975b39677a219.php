<?php $__env->startSection('title'); ?>Comentarios <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Comentarios
			<small>listado</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="<?php echo e(route('publication.index')); ?>"><i class="fa fa-th-list"></i> Blog</a></li>
			<li class="active">Comentarios</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">

		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Listado de comentarios</h3>
			</div>
			<div class="box-body table-responsive">
				<table id="tableList" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nombre del usuario</th>
							<th>Email del usuario</th>
							<th>Publicación</th>
							<th>Status</th>
							<th>Fecha</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="comment in comments">
							<th>
								{{ comment.author.name }}
							</th>
							<th>
								{{ comment.author.email }}
							</th>
							<th>
								{{ comment.publication }}
							</th>
							<th>
								<template v-if="comment.status == 'approved'">
									<small class="label pull-left bg-green">Aprovado</small>
								</template>
								<template v-else>
									<small class="label pull-left bg-yellow">Pendiente por revisión</small>
								</template>
							</th>
							<th>{{ comment.created_at }}</th>
							<th class="text-right" style="width: 10%;">
								<button type="button" class="btn btn-info btn-sm" v-on:click="view(comment)"><i class="fa fa-eye"></i></button>
								<button type="button" class="btn btn-danger btn-sm " v-on:click="remove(comment)"><i class="fa fa-trash"></i></button>
							</th>
						</tr>
						<tr v-if="comments.length == 0">
							<th colspan="6">No se encuentra ningun registro</th>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Nombre del usuario</th>
							<th>Email del usuario</th>
							<th>Publicación</th>
							<th>Status</th>
							<th>Fecha</th>
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
		
		<!-- MODAL DE EDICIO -->
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
										<div class="col-6 col-sm-6 col-md-6 col-lg-6">
											<label for="author">Nombre del usuario: </label>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" class="form-control"  v-model="comment.author.name" disabled="disabled">
												</div>
											</div>
										</div>
										<div class="col-6 col-sm-6 col-md-6 col-lg-6">
											<label for="author">Email del usuario: </label>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
													<input type="text" class="form-control"  v-model="comment.author.email" disabled="disabled">
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-12 col-md-12 col-lg-12">
											<label for="publication">Publicación: </label>
											<div class="form-group">		<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
													<input type="text" class="form-control"  v-model="comment.publication" disabled="disabled">
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-12 col-sm-6 col-md-6 col-lg-6">
											<label for="created_at">Fecha: </label>
											<div class="form-group">		<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
													<input type="text" class="form-control"  v-model="comment.created_at" disabled="disabled">
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-6 col-md-6 col-lg-6">
											<strong>(*)</strong> <label for="status">Status: </label>
											<div class="form-group">	
												<select class="form-control" v-model="comment.status" name="status" style="width: 100%;">
													<option value="approved">Aprovado</option>
													<option value="pending_review">Pending Review</option>
												</select>
											</div>
										</div>
									</div>


									<div class="row">
										<div class="col-12 col-sm-6 col-md-6 col-lg-6">
											<label for="title">Mostrar en la web: </label>
											<div class="form-group">
												<div class="checkbox icheck pl-20" >
													<label>
														<input type="checkbox" name="is_active" value="1" checked="checked" v-model="comment.is_active" > Activar
													</label>
												</div>
											</div>
										</div>							
									</div>

									<div class="row">
										<div class="col-12 col-sm-12 col-md-12 col-lg-12">
											<label for="title">Contenido del comentario: </label>
											<div class="form-group">
												<textarea class="form-control" name="text" v-model="comment.text" rows="10"></textarea>
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
<script src="<?php echo e(asset('resourcesApp/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/blog/comments.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/blog/comments.blade.php ENDPATH**/ ?>