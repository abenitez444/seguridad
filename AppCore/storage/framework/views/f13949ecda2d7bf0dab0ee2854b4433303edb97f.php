<?php $__env->startSection('title'); ?>Whatsapp para la web <?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Configuración del whatsapp flotante en la web
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Whatsapp</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">
		<form id="form_" enctype="multipart/form-data" onsubmit="return false;">
			<div class="box box-info">
				<div class="overlay" v-if="searching == true">
					<i class="fa fa-refresh fa-spin"></i>
				</div>
				<div class="box-header">
					<h3 class="box-title">Complete la configuración necesaria</h3>
				</div>
				<div class="box-body">
					<div class="row mb-20">
						<div class="mb-0">
							<div class="col-xs-12 col-sm-6 col-md-6" >
								<label for="logoHeader"><strong>(*)</strong> Imagen o logo tipo del boton</label>
								<div class="form-group" id="logo">
									<input type="file" class="dropify" name="logo" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg svg"/>
								</div>
							</div>
						</div>
						<div class="col-6 col-sm-4 col-md-4 col-lg-4">
							<label for="whatsapp_active">Activar el boton flotante de whatsapp en la web: </label>
							<div class="form-group">
								<div class="checkbox icheck pl-20" >
									<label>
										<input type="checkbox" name="whatsapp_active" v-model="whatsapp_active" > Activar
									</label>
								</div>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<strong>(*)</strong> <label for="phone">Teléfono: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone"></i></span>
								<input type="text" class="form-control" placeholder="Teléfono sin espacios ej: +57123456789" title="Teléfono sin espacios ej: +57123456789" name="phone" v-model="phone" :disabled="whatsapp_active == false">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<strong>(*)</strong> <label for="popupMessage">Mensaje de bienvenida: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
								<input type="text" class="form-control" placeholder="Mensaje de saludo al usuario" name="popupMessage" v-model="popupMessage" :disabled="whatsapp_active == false">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<strong>(*)</strong> <label for="message">Mensaje inicial: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
								<input type="text" class="form-control" placeholder="Mensaje de saludo al usuario" name="message" v-model="message" :disabled="whatsapp_active == false">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<strong>(*)</strong> <label for="headerTitle">Titulo: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-header"></i></span>
								<input type="text" class="form-control" placeholder="Titulo para del popup" name="headerTitle" v-model="headerTitle" :disabled="whatsapp_active == false">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<strong>(*)</strong> <label for="headerColor">Color principal: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-edit"></i></span>
								<input type="text" class="form-control my-colorpicker1" placeholder="Color principal" name="headerColor" v-model="headerColor" :disabled="whatsapp_active == false">
							</div>
						</div>
					</div>

					<div class="box-footer clearfix">
						<div class="callout callout-info text-left">
							<label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label>
						</div>
						<button type="submit" class="btn btn-primary" id="btn-save" :disabledd="sending == true">
							<template id="sending" v-if="!sending">
								<i class="fa fa-save"></i> Guardar cambios
							</template>
							<template id="notSending" v-if="sending">
								<i class="fa fa-spinner fa-spin"></i>
							</template>
						</button>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>

"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/configuration/whatsapp.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/drbulla/AppGestorContenido/resources/views/admin/configuration/whatsapp.blade.php ENDPATH**/ ?>