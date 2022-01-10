<?php $__env->startSection('title'); ?>Información de contacto <?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Información de contacto
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Información</li>
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
					<h3 class="box-title">Complete la información de contacto</h3>
				</div>
				<div class="box-body">
					<div class="row mb-20">
						<div class="mb-0">
							<div class="col-xs-12 col-sm-6 col-md-6" >
								<label for="logoHeader"><strong>(*)</strong> Logo del header o cabecara</label>
								<div class="form-group" id="logoHeader">
									<input type="file" class="dropify" name="logoHeader" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" />
								</div>
							</div>
						</div>
						<div class="mb-0">
							<div class="col-xs-12 col-sm-6 col-md-6" >
								<label for="logoFooter">Logo del footer o pie de página</label>
								<div class="form-group" id="logoFooter">
									<input type="file" class="dropify" name="logoFooter" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" />
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<strong>(*)</strong> <label for="name">Nombre: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" class="form-control" placeholder="Nombre de la empresa" name="name" v-model="company.name">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<strong>(*)</strong> <label for="email">Email: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								<input type="text" class="form-control" placeholder="Email de la empresa" name="email" v-model="company.email">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<strong>(*)</strong> <label for="phone">Teléfono: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone"></i></span>
								<input type="text" class="form-control" placeholder="Telélefono sin espacios ni carácteres ej: 123456789" name="phone" v-model="company.phone">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<label for="urlWeb">Url Web: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone"></i></span>
								<input type="text" class="form-control" placeholder="Ingrese la url de la página web" name="urlWeb" v-model="company.urlWeb">
							</div>
						</div>

						<div class="col-12 col-sm-12 col-md-12 col-lg-12">
							<strong>(*)</strong> <label for="address">Dirección: </label>
							<div class="form-group">		
								<textarea class="form-control" name="address" placeholder="Dirección de la empresa" rows="10" v-model="company.address"></textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 form-group">
							<label>Redes sociales de la empresa: </label>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="row">
								<div class="col-12 col-xs-12 col-sm-6 col-md-6 mb-20" v-if="socialNetworks.length > 0" v-for="social in socialNetworks">
									<label for="social.name">{{ social.name }}: </label>
									<div class="input-group">
										<span class="input-group-addon"><i :class="social.ico"></i></span>
										<input type="text" class="form-control" :placeholder="social.name" :name="'socials['+ social.id +']'" :value="getNameUserSocial(social.id)">
									</div>
								</div>
								<div class="col-12 col-xs-12 col-sm-6 col-md-6" v-else>
									<label>NO SE HA REGISTRADO NINGUNA RED SOCIAL EN EL SISTEMA</label>
								</div>
							</div>
						</div>
					</div>

					<div class="box-footer clearfix">
						<div class="callout callout-info text-left">
							<label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label>
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
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/configuration/company.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/drbulla/AppGestorContenido/resources/views/admin/configuration/company.blade.php ENDPATH**/ ?>