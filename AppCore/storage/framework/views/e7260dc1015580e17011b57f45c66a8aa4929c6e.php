<?php $__env->startSection('title'); ?>Redes Sociales <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/select2/dist/css/select2.min.css')); ?>">
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/iCheck/square/blue.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Redes Sociales
		<small>crear nuevo</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo e(route('socialNetworks.index')); ?>"><i class="fa fa-group"></i> Redes sociales</a></li>
		<li class="active">Crear</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="box box-primary">
		<!-- /.box-header -->
		<div class="box-body" id="create">
			<form role="form" id="form_" action="<?php echo e(route('socialNetworks.store')); ?>" onsubmit="return false;">
				<div class="box-body">

					<div class="row">
						<div class="col-12 col-sm-6 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="name">Red social: </label>
							<div class="form-group">								
								<select class="form-control " name="name" style="width: 100%;">
									<option selected="selected" value="facebook">Facebook</option>
									<option value="github">Github</option>
									<option value="google+">Google+</option>
									<option value="instagram">Instagram</option>
									<option value="linkedin">Linkedin</option>
									<option value="pinterest">Pinterest</option>
									<option value="tumblr">Tumblr</option>
									<option value="twitter">Twitter</option>
									<option value="whatsapp">Whatsapp</option>
								</select>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="url">Enlace: </label>
							<div class="form-group">								
								<input type="text" class="form-control" id="url" name="url" placeholder="https://www.facebook.com/">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<div class="checkbox icheck">
									<label for="is_active">
										<input type="checkbox" name="is_active" checked="checked"> Activar
									</label>
								</div>
							</div>
							
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<div class="checkbox icheck">
									<label for="new_windows">
										<input type="checkbox" name="new_windows" checked="checked"> Mostrar en una nueva pestaña
									</label>
								</div>
							</div>
							
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-12 col-sm-12 col-lg-12">
							<div class="form-group">
								<strong>(*)</strong> <label for="ico">Icono a mostrar de la red social seleccionada</label>
							</div>
						</div>
						<div class="iconos" style="font-size: 22px;">
							<div id="icos_facebook">
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-facebook" class="minimal icheck" checked="checked">
											<i class="fa fa-facebook"></i>
										</label>								
									</div>
								</div>
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-facebook-f" class="minimal icheck">
											<i class="fa fa-facebook-f"></i>
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa-facebook-official" class="minimal icheck">
											<i class="fa fa-facebook-official"></i>
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-facebook-square" class="minimal icheck">
											<i class="fa fa-facebook-square"></i>
										</label>
									</div>
								</div>
							</div>

							<div id="icos_github">
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-github-alt" class="minimal icheck">
											<i class="fa fa-github-alt"></i>
										</label>								
									</div>
								</div>
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-github-square" class="minimal icheck">
											<i class="fa fa-github-square"></i>
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-github" class="minimal icheck">
											<i class="fa fa-github"></i>
										</label>
									</div>
								</div>				
							</div>

							<div id="icos_google">
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-google" class="minimal icheck">
											<i class="fa fa-google"></i>
										</label>								
									</div>
								</div>								
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-facebook-ffa-google-plus" class="minimal icheck">
											<i class="fa fa-google-plus"></i>
										</label>
									</div>
								</div>								
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-google-plus-square" class="minimal icheck">
											<i class="fa fa-google-plus-square"></i>
										</label>
									</div>
								</div>								
							</div>

							<div id="icos_instagram">
								<div class="form-group"></div>
								<div class="col-12 col-sm-3 col-md-3 col-lg-3">
									<label>
										<input type="radio" name="ico" value="fa fa-instagram" class="minimal icheck">
										<i class="fa fa-instagram"></i>
									</label>								
								</div>
							</div>

							<div id="icos_linkedin">
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-linkedin" class="minimal icheck">
											<i class="fa fa-linkedin"></i>
										</label>								
									</div>
								</div>								
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-linkedin-square" class="minimal icheck">
											<i class="fa fa-linkedin-square"></i>
										</label>
									</div>
								</div>								
							</div>

							<div id="icos_pinterest">
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-pinterest" class="minimal icheck">
											<i class="fa fa-pinterest"></i>
										</label>								
									</div>
								</div>								
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-pinterest-p" class="minimal icheck">
											<i class="fa fa-pinterest-p"></i>
										</label>
									</div>
								</div>								
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-pinterest-square" class="minimal icheck">
											<i class="fa fa-pinterest-square"></i>
										</label>
									</div>
								</div>								
							</div>

							<div id="icos_tumblr">
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-tumblr" class="minimal icheck">
											<i class="fa fa-tumblr"></i>
										</label>								
									</div>
								</div>								
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-tumblr-square" class="minimal icheck">
											<i class="fa fa-tumblr-square"></i>
										</label>
									</div>
								</div>								
							</div>

							<div id="icos_twitter">
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-twitter" class="minimal icheck">
											<i class="fa fa-twitter"></i>
										</label>								
									</div>
								</div>								
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-twitter-square" class="minimal icheck">
											<i class="fa fa-twitter-square"></i>
										</label>
									</div>
								</div>								
							</div>

							<div id="icos_whatsapp">
								<div class="form-group">
									<div class="col-12 col-sm-3 col-md-3 col-lg-3">
										<label>
											<input type="radio" name="ico" value="fa fa-whatsapp" class="minimal icheck">
											<i class="fa fa-whatsapp"></i>
										</label>								
									</div>
								</div>								
							</div>
						</div>
						
					</div>
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<div class="row">
						<div class="col-md-12 col-12">
							<label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label>
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
		<!-- /.box-body -->
	</div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<!-- Select2 -->
<script src="<?php echo e(asset('resourcesApp/plugins/select2/dist/js/select2.full.min.js')); ?>"></script>
<!-- iCheck -->
<script src="<?php echo e(asset('resourcesApp/plugins/iCheck/icheck.min.js')); ?>"></script>
<script src="<?php echo e(asset('resourcesApp/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/socialNetworks.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/configuration/socialNetworks/create.blade.php ENDPATH**/ ?>