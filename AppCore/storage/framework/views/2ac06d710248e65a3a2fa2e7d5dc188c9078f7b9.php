<?php $__env->startSection('title'); ?>Perfil <?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/dropify/dist/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Información de usuario
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Perfil</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid" id="component">
		<form id="form_" enctype="multipart/form-data" onsubmit="return false;">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">Editar información de usuario</h3>
				</div>
				<div class="box-body">
					<div class="row mb-20">
						<div class="form-group mb-0">
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="logoHeader">Imagen de perfil</label>
								<input type="file" class="dropify" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<strong>(*)</strong> <label for="name">Nombre: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" class="form-control" placeholder="Nombre del usuario" name="name" v-model="user.name">
								<input type="hidden" name="id_user" value="<?php echo e($id); ?>">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<strong>(*)</strong> <label for="email">Email: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								<input type="text" class="form-control" placeholder="Email del usuario" name="email" v-model="user.email">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<label for="password">Contraseña: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
								<input type="password" class="form-control" placeholder="************" name="password" v-model="user.password">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							<label for="password2">Confirmar contraseña: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
								<input type="password" class="form-control" placeholder="************" name="password2" v-model="user.password2">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 form-group">
							<label for="phone">Teléfono: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone"></i></span>
								<input type="text" class="form-control" placeholder="Telélefono sin espacios ni carácteres ej: 123456789" name="phone" v-model="user.phone">
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-6 form-group">
							<label for="type">Tipo: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" class="form-control" placeholder="Tipo de usuario" name="type" v-model="user.type" disabled>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<div class="checkbox icheck pl-20">
									<label>
										<input type="checkbox" name="is_active" value="1" checked="checked" v-model="user.is_active"> Activar
									</label>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<div class="checkbox icheck pl-20">
									<label>
										<input type="checkbox" name="is_admin" value="1" checked="checked" v-model="user.is_admin"> Permisos de Administrador
									</label>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<div class="checkbox icheck pl-20">
									<label>
										<input type="checkbox" name="email_verified" value="1" checked="checked" v-model="user.email_verified"> Email Verificado
									</label>
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
<script src="<?php echo e(asset('resourcesApp/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>

"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/users/showProfile.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/users/showProfile.blade.php ENDPATH**/ ?>