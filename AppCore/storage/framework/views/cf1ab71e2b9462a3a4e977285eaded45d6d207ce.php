<?php $__env->startSection('title'); ?>Redes Sociales <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Redes Sociales
		<small>listado</small>
		<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus"></i> Nuevo</button>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Redes sociales</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid" id="component">

	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">Listado de redes sociales</h3>
		</div>
		<div class="box-body table-responsive">
			<table id="tableList" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Descripción</th>
						<th>Icono</th>
						<th>URL</th>
						<th>Estado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="social in socials">
						<th>{{ social.name }}</th>
						<th><i v-bind:class="social.ico"></i></th>
						<th>{{ social.url }}</th>
						<th>
							<template v-if="social.is_active">
								<small class="label pull-left bg-green">Activo</small>
							</template>
							<template v-else>
								<small class="label pull-left bg-yellow">Inactivo</small>
							</template>
						</th>
						<th>
							<button type="button" class="btn btn-warning btn-sm" v-on:click="view(social)"><i class="fa fa-edit"></i></button>
							<button type="button" class="btn btn-danger btn-sm" v-on:click="remove(social)"><i class="fa fa-trash"></i></button>
						</th>
					</tr>
					<tr v-if="socials.length == 0">
						<th colspan="5">No se encuentra ningun registro</th>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Descripción</th>
						<th>Icono</th>
						<th>URL</th>
						<th>Estado</th>
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

	<div class="modal fade" id="modal-form">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="row">
					<div class="col-md-12 col-12">
						<form role="form" id="form_" action="<?php echo e(route('socialNetworks.store')); ?>" onsubmit="return false;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">Agregar & Editar</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<strong>(*)</strong> <label for="name">Red social: </label>
										<div class="form-group">	
											<select class="form-control" v-model="social.name" name="name" style="width: 100%;">
												<option value="facebook">Facebook</option>
												<option value="github">Github</option>
												<option value="google+">Google+</option>
												<option value="instagram">Instagram</option>
												<option value="linkedin">Linkedin</option>
												<option value="pinterest">Pinterest</option>
												<option value="tumblr">Tumblr</option>
												<option value="twitter">Twitter</option>
												<option value="youtube">YouTube</option>
												<option value="whatsapp">Whatsapp</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<strong>(*)</strong> <label for="url">Enlace: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-link"></i></span>
												<input type="text" class="form-control" id="url" name="url" placeholder="https://www.facebook.com/" v-model="social.url">
											</div>					
											
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group">
											<div class="checkbox icheck pl-20">
												<label>
													<input type="checkbox" name="is_active" value="1" checked="checked" v-model="social.is_active"> Activar
												</label>
											</div>
										</div>

									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group">
											<div class="checkbox icheck pl-20">
												<label>
													<input type="checkbox" name="new_windows" value="0" checked="checked" v-model="social.new_windows"> Mostrar en una nueva pestaña
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
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-facebook" class="minimal icheck" checked="checked">
														<i class="fa fa-facebook"></i>
													</label>								
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-facebook-f" class="minimal icheck">
														<i class="fa fa-facebook-f"></i>
													</label>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa-facebook-official" class="minimal icheck">
														<i class="fa fa-facebook-official"></i>
													</label>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-facebook-square" class="minimal icheck">
														<i class="fa fa-facebook-square"></i>
													</label>
												</div>
											</div>
										</div>

										<div id="icos_github">
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-github-alt" class="minimal icheck">
														<i class="fa fa-github-alt"></i>
													</label>								
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-github-square" class="minimal icheck">
														<i class="fa fa-github-square"></i>
													</label>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-github" class="minimal icheck">
														<i class="fa fa-github"></i>
													</label>
												</div>
											</div>				
										</div>

										<div id="icos_google">
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-google" class="minimal icheck">
														<i class="fa fa-google"></i>
													</label>								
												</div>
											</div>								
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-facebook-ffa-google-plus" class="minimal icheck">
														<i class="fa fa-google-plus"></i>
													</label>
												</div>
											</div>								
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-google-plus-square" class="minimal icheck">
														<i class="fa fa-google-plus-square"></i>
													</label>
												</div>
											</div>								
										</div>

										<div id="icos_instagram">
											<div class="form-group"></div>
											<div class="col-xs-3 col-sm-2 col-md-2">
												<label>
													<input type="radio" name="ico" v-model="social.ico" value="fa fa-instagram" class="minimal icheck">
													<i class="fa fa-instagram"></i>
												</label>								
											</div>
										</div>

										<div id="icos_linkedin">
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-linkedin" class="minimal icheck">
														<i class="fa fa-linkedin"></i>
													</label>								
												</div>
											</div>								
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-linkedin-square" class="minimal icheck">
														<i class="fa fa-linkedin-square"></i>
													</label>
												</div>
											</div>								
										</div>

										<div id="icos_pinterest">
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-pinterest" class="minimal icheck">
														<i class="fa fa-pinterest"></i>
													</label>								
												</div>
											</div>								
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-pinterest-p" class="minimal icheck">
														<i class="fa fa-pinterest-p"></i>
													</label>
												</div>
											</div>								
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-pinterest-square" class="minimal icheck">
														<i class="fa fa-pinterest-square"></i>
													</label>
												</div>
											</div>								
										</div>

										<div id="icos_tumblr">
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-tumblr" class="minimal icheck">
														<i class="fa fa-tumblr"></i>
													</label>								
												</div>
											</div>								
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-tumblr-square" class="minimal icheck">
														<i class="fa fa-tumblr-square"></i>
													</label>
												</div>
											</div>								
										</div>

										<div id="icos_twitter">
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-twitter" class="minimal icheck">
														<i class="fa fa-twitter"></i>
													</label>								
												</div>
											</div>								
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-twitter-square" class="minimal icheck">
														<i class="fa fa-twitter-square"></i>
													</label>
												</div>
											</div>								
										</div>

										<div id="icos_youtube">
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-youtube" class="minimal icheck">
														<i class="fa fa-youtube"></i>
													</label>								
												</div>
											</div>								
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-youtube-play" class="minimal icheck">
														<i class="fa fa-youtube-play"></i>
													</label>
												</div>
											</div>	
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-youtube-square" class="minimal icheck">
														<i class="fa fa-youtube-square"></i>
													</label>
												</div>
											</div>								
										</div>

										<div id="icos_whatsapp">
											<div class="form-group">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<label>
														<input type="radio" name="ico" v-model="social.ico" value="fa fa-whatsapp" class="minimal icheck">
														<i class="fa fa-whatsapp"></i>
													</label>								
												</div>
											</div>								
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('resourcesApp/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('resourcesApp/js/admin/socialsNetworks.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/configuration/social.blade.php ENDPATH**/ ?>