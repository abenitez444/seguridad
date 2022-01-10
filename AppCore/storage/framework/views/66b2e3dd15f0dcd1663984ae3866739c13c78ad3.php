<?php $__env->startSection('title'); ?>Logos <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/dropify/dist/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Logos
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Logos</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid" id="component">

	<form id="form_" enctype="multipart/form-data" onsubmit="return false;" v-on:submit="save">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Editar logos</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="form-group mb-0">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<label for="logoHeader">Logo del header o cabecera </label>
							<input type="file" class="dropify" name="logoHeader" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg"  v-on:change="logoChange" />
						</div>
					</div>
					<input type="hidden" name="logoHeaderDefined" value="1">
					<div class="form-group">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<label for="logoFooter">Logo del Footer o pie página </label>
							<input type="file" class="dropify" name="logoFooter" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg"   v-on:change="logoChange" />
						</div>
					</div>
				</div>
			</div>
			<img :src="'<?php echo e(asset('images')); ?>' + logoHeader.urlpath" >
			<div class="box-footer clearfix">
				<button type="submit" class="btn btn-primary" id="btn-save">
					<span id="sending">
						<i class="fa fa-save"></i> Guardar cambios
					</span>
					<span id="notSending" style="display: none;">
						<i class="fa fa-spinner fa-spin"></i>
					</span>
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

<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/logos.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/configuration/logo/logos.blade.php ENDPATH**/ ?>