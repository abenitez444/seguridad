<?php $__env->startSection('title'); ?> <?php echo e($zone->element_name); ?> <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/jodit/build/jodit.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="bs-spinner loading-spiner" v-if="loading == true">
	<div class="spinner-border text-primary" role="status">
		<span class="sr-only">Loading...</span>
	</div>
</div>
<div class="container-fluid">
	<div class="page-title-box">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<h4 class="page-title">
					<?php echo e($zone->element_name); ?>

					<a href="<?php echo e(route('showPolitics')); ?>">
                        <button class="btn btn-primary" type="button">
	                        <i class="fa fa-eye"></i> Ver Documento
	                    </button>
                    </a>
				</h4>

			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>/">Estadísticas</a></li>
					<li class="breadcrumb-item active"><?php echo e($zone->element_name); ?></li>
				</ol>
			</div>
		</div> <!-- end row -->
	</div>
	<!-- end page-title -->

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form role="form" id="form_" onsubmit="return false;">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row alert alert-secondary">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <h5>Para utilizar los datos del usuario utilize los siguietes shortcodes:</h5>
                                        <ul>
                                            <li>Nombre del usuario: <b>{%name_user%}</b></li>
                                            <li>Nit del usuario: <b>{%nit_user%}</b></li>
                                            <li>Dirección del usuario: <b>{%address_user%}</b></li>
                                            <li>Teléfono del usuario: <b>{%phone_user%}</b></li>
                                            <li>Correo del usuario: <b>{%email_user%}</b></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <strong>(*)</strong> <label for="label">Titulo: </label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="title" placeholder="Escribir título principal del documento" v-model="element.title">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <label for="label">Contenido: </label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="content" id="content" placeholder="Escriba el contenido del documento" rows="8"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        <div class="alert alert-info ">
                                            <label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" :disabled="sending == true">
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
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div>
<!-- container-fluid -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/jodit/build/jodit.min.js')); ?>"></script>
<script type="text/javascript">const zone = "<?php echo e($zone->element_slug); ?>"; console.log(zone);</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/zones/show.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/admin/zones/show.blade.php ENDPATH**/ ?>