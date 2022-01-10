<?php $__env->startSection('title'); ?>Perfil <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Perfil </h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Geocalización</a></li>
					<li class="breadcrumb-item active">Perfil</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 cl-md-12 col-lg-12">
				<div class="card">
					<div class="overlay dark" v-if="loading">
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					<form role="form" id="form_" onsubmit="return false;"  enctype="multipart/form-data">
						<div class="card-body">
							<div class="row">
								<div class="col-12 col-sm-12 col-md-6 col-lg-6">
									<strong>(*)</strong> <label for="title">Nombre: </label>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-header"></i></span>
											</div>
											<input type="text" class="form-control" id="name" name="name" placeholder="Nombre del Usuario" v-model="user.name">
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-6">
									<strong>(*)</strong> <label for="email">Email: </label>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="far fa-envelope"></i></span>
											</div>
											<input type="email" class="form-control" id="email" name="email" placeholder="Email del usuario par el acceso" v-model="user.email">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-12 col-md-6 col-lg-6">
									<strong>(*)</strong> <label for="phone">Teléfono: </label>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-phone"></i></span>
											</div>
											<input type="text" class="form-control" id="phone" name="phone" placeholder="Teléfono del usuario" v-model="user.phone">
										</div>
									</div>
								</div>					
							</div>
							<div class="row">
								<div class="col-12 col-sm-12 col-md-6 col-lg-6">
									<strong>(*)</strong> <label for="password">Contraseña de acceso: </label>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-asterisk"></i></span>
											</div>
											<input type="password" class="form-control" id="password" name="password" placeholder="**********" v-model="user.password" v-on:change="changePassword = 1">
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-6">
									<strong>(*)</strong> <label for="password2">Confirma contraseña de acceso: </label>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-asterisk"></i></span>
											</div>
											<input type="password" class="form-control" id="password2" name="password2" placeholder="**********" v-model="user.password2" v-on:change="changePassword2 = 1">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-12 col-12" id="image">
									<strong>(*)</strong> <label for="image">Imagen de Perfil: </label>
									<input type="file" class="dropify" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg"/>
								</div>
							</div>
						</div>
						<div class="card-footer justify-content-between">
							<div class="row" style="width: 100%;">
								<div class="callout callout-info text-left col-12 col-sm-12 col-md-12">
									<label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label>
								</div>
								<div class="col-12 col-md-12 col-sm-12 col-lg-12">
									<button type="button" class="btn btn-default float-left" data-dismiss="modal">Cancelar</button>
									<button type="submit" class="btn btn-primary float-right" :disabled="loading == true">
										<template v-if="!loading">
											<i class="fa fa-save"></i> Guardar cambios
										</template>
										<template v-if="loading">
											<i class="fa fa-spinner fa-spin"></i>
										</template>
									</button>
								</div>
							</div>					
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>	
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/usersProfile.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/icg/AppCore/resources/views/showProfile.blade.php ENDPATH**/ ?>