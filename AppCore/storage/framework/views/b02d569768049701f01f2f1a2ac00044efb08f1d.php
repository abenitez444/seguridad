<?php $__env->startSection('title'); ?>Editar página <?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/dropify/dist/css/dropify.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('resourcesApp/plugins/jodit/build/jodit.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Información de la página
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Editar página</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid" id="component">

	<form id="form_" enctype="multipart/form-data" method="post" onsubmit="return false;" v-on:submit="saveForm">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Editar</h3>
				<input type="hidden" name="name" id="namePage" value="<?php echo e($page->name); ?>">
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 form-group">
						<strong>(*)</strong> <label for="name">Titulo: </label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa  fa-header"></i></span>
							<input type="text" class="form-control" placeholder="Titulo de la página" name="title" value="<?php echo e($page->title); ?>" v-model="page.title">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 form-group" >
						<label for="url">Breve descripción: </label>
						<textarea class="form-control" rows="9" name="short_description" v-model="page.short_description"><?php echo e($page->short_description); ?></textarea>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<label for="logoFooter">Imagen principal </label>
						<input type="file" class="dropify" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" v-on:change="imageChange" <?php if($page->image != ''): ?> data-default-file="<?php echo e($page->getUrlImage()); ?>" data-show-remove="true" <?php endif; ?>/>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 form-group" >
						<label for="content">Contenido: </label>
						<textarea id="content" name="content" rows="10" cols="80" v-model="page.content">
                            <?php echo e($page->content); ?>

                    	</textarea>
					</div>
				</div>

				<div class="box-footer clearfix">
					<div class="callout callout-info text-left">
						<label>Los campos que deje vacio en blanco se tomará como inactivo y por ende no se mostrara</label>
					</div>
					<button type="submit" class="btn btn-primary" id="btn-save" :disabled="sending == true">
						<template id="sending" v-if="!sending">
							<i class="fa fa-save"></i> Guardar cambios
						</template>
						<template id="notSending" v-if="sending">
							<i class="fa fa-spinner fa-spin"></i>
						</template>
					</button>
				</div>
			</div>
		</form>
	</section>

	<?php $__env->stopSection(); ?>

	<?php $__env->startPush('js'); ?>
	<script src="<?php echo e(asset('resourcesApp/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>

	"></script>
	<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/jodit/build/jodit.min.js')); ?>"></script>

	<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/editPage.js')); ?>"></script>
	<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/page/edit.blade.php ENDPATH**/ ?>