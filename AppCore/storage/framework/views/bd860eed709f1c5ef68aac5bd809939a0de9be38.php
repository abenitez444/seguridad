<?php $__env->startSection('title'); ?>Contacto <?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/timepicker/bootstrap-timepicker.min.css')); ?> ">
 <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Información de contacto
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Contacto</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid" id="component">

	<form id="form_" enctype="multipart/form-data" onsubmit="return false;">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Editar información de contacto</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 form-group">
						<strong>(*)</strong> <label for="name">Nombre de la empresa: </label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-building"></i></span>
							<input type="text" class="form-control" placeholder="Nombre de la empresa" name="name" v-model="contact.name">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 form-group">
						<label for="phone">Teléfono: </label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<input type="text" class="form-control" placeholder="Telélefono sin espacios ni carácteres ej: 123456789" name="phone" v-model="contact.phone">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 form-group">
						<label for="email">Email: </label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="email" class="form-control" placeholder="Email" name="email" v-model="contact.email">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 form-group">
						<label for="working_hours">Horario de trabajo: </label>
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa  fa-clock-o"></i></span>
									<input type="text" class="form-control timepicker" placeholder="Apertura" name="in" title="Horario de apertura" v-model="contact.in">
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa  fa-clock-o"></i></span>
									<input type="text" class="form-control timepicker" placeholder="cierre" name="out" title="Horario de salida" v-model="contact.out">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 form-group" >
						<label for="url">Dirección: </label>
						<textarea class="form-control" rows="3" name="address" v-model="contact.address"></textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 form-group" >
						<label for="url">Breve descripción: </label>
						<textarea class="form-control" rows="3" name="description" v-model="contact.description"></textarea>
					</div>
				</div>

				<div class="box-footer clearfix">
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
	<!-- bootstrap time picker -->
	<script src="<?php echo e(asset('resourcesApp/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/contact.js')); ?>"></script>
	<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/configuration/contact.blade.php ENDPATH**/ ?>