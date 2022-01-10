<?php $__env->startSection('title'); ?>Nueva publicación <?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/dropify/dist/css/dropify.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('resourcesApp/plugins/jodit/build/jodit.min.css')); ?>">
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Publicacion
			<small> crear nueva</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="<?php echo e(route('publication.index')); ?>"><i class="fa fa-th-list"></i> Blog</a></li>
			<li class="active">Nueva publicación</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">
		<form id="form_" enctype="multipart/form-data" onsubmit="return false;">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-8">
					<div class="box box-info">
						<div class="box-header">
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 form-group">
									<strong>(*)</strong> <label for="title">Titulo: </label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa  fa-header"></i></span>
										<input type="text" class="form-control" placeholder="Titulo de la publicación" name="title" v-model="title">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 form-group">
									<label for="content">Contenido: </label>
									<textarea id="content" name="content" v-model="content"></textarea>
								</div>
							</div>
						</div>
						<div class="box-footer clearfix">
							<div class="callout callout-info text-left">
								<label>Los campos que deje vacio en blanco se tomará como inactivo y por ende no se mostrara</label>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<button type="submit" class="btn btn-primary pull-right" :disabled="sending == true">
										<template v-if="!sending">
											<i class="fa fa-save"></i> Guardar cambios
										</template>
										<template v-if="sending">
											<i class="fa fa-spinner fa-spin"></i>
										</template>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4">
					<div class="box box-info">
						<div class="box-header">
							<div class="row">
								<div class="col-12 col-sm-12 col-md-12 col-lg-12">
									<strong>(*)</strong> <label for="author">Autor: </label>
									<div class="form-group">	
										<select class="form-control" v-model="author" name="author" style="width: 100%;">
											<option v-for="author in authors" :value="author.id">{{ author.name }}</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-12 col-sm-12 col-md-12 col-lg-12">
									<strong>(*)</strong> <label for="visibility">Visibilidad: </label>
									<div class="form-group">	
										<select class="form-control" v-model="visibility" name="visibility" style="width: 100%;">
											<option value="public" selected="selected">Publico</option>
											<option value="private">Privado</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-7 col-md-7 col-lg-7">
									<div class="form-group">
										<div class="checkbox icheck pl-20">
											<label>
												<input type="checkbox" name="allow_comments" value="1" checked="checked" v-model="allow_comments"> Permitir comentarios
											</label>
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-5 col-md-5 col-lg-5">
									<div class="form-group">
										<div class="checkbox icheck pl-20">
											<label>
												<input type="checkbox" name="is_active" value="1" checked="checked" v-model="is_active"> Activar
											</label>
										</div>
									</div>
								</div>								
							</div>
						</div>
						<div class="box-footer clearfix">
							<div class="row">
								<div class="col-xs-12 col-md-12 col-sm-12">
									<label for="image">Categorías </label>
									<div id="container-categories" v-if="categories.length > 0">
										<ul>
											<li v-for="category in categories">
												<label>
													<input type="checkbox" name="category[]" value="category.id" :value="category.id"> {{ category.name }}
												</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-12 col-12">
									<label for="image">Imagen principal </label>
									<input type="file" class="dropify" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" />
								</div>
							</div>
						</div>
						<div class="box-footer clearfix">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<button type="submit" class="btn btn-primary pull-right" :disabled="sending == true">
										<template v-if="!sending">
											<i class="fa fa-save"></i> Guardar cambios
										</template>
										<template v-if="sending">
											<i class="fa fa-spinner fa-spin"></i>
										</template>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		
	</section>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
	<script src="<?php echo e(asset('resourcesApp/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/jodit/build/jodit.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/blog/newPublication.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/blog/publicationCreate.blade.php ENDPATH**/ ?>