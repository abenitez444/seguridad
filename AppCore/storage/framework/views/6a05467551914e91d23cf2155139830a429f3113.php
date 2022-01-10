<?php $__env->startSection('title'); ?>Perfil <?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
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
					Editar Perfil
				</h4>

			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>/">Estadísticas</a></li>
					<li class="breadcrumb-item active">Perfil</li>
				</ol>
			</div>
		</div> <!-- end row -->
	</div>
	<!-- end page-title -->

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">

                <form role="form" id="form_" onsubmit="return false;">
	                <div class="card-body">
	                    <div class="row">
	                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            <div class="row">
	                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                    <div class="row">
	                                        <div v-if="user.is_admin == '2'" class="col-12 col-sm-12 col-md-12 col-lg-12">
	                                            <strong>(*)</strong> <label for="name">NIT: </label>
	                                            <div class="form-group">
	                                                <input type="text" class="form-control" name="nit" placeholder="NIT" v-model="user.residential.nit">
	                                            </div>
	                                        </div>
	                                        <div v-if="user.is_admin == '1'" class="col-12 col-sm-12 col-md-12 col-lg-12">
	                                            <strong>(*)</strong> <label for="name">Nombre: </label>
	                                            <div class="form-group">
	                                                <input type="text" class="form-control" name="name" placeholder="Ingrese su Nombre Completo" v-model="user.name">
	                                            </div>
	                                        </div>
	                                        <div v-if="user.is_admin == '1'" class="col-12 col-sm-12 col-md-12 col-lg-12">
	                                            <strong>(*)</strong> <label for="email">Email: </label>
	                                            <div class="form-group">
	                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" v-model="user.email">
	                                            </div>
	                                        </div>
	                                         <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                                            <strong>(*)</strong> <label for="email">Teléfono: </label>
	                                            <div class="form-group">
	                                                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Ingrese su Teléfono" v-model="user.phone">
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div v-if="user.is_admin == '1'" class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                    <div class="row">
	                                        <div class="col-sm-12 col-md-12 col-12" id="image">
	                                            <strong>(*)</strong> <label for="image">Imagen principal </label>
	                                            <input type="file" class="dropify" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" />
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                            <label for="email">Contraseña de acceso: </label>
	                            <div class="form-group">
	                                    <input type="password" class="form-control" id="password" name="password" placeholder="**********" v-model="user.password">
	                            </div>
	                        </div>
	                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                            <label for="email">Confirma contraseña de acceso: </label>
	                            <div class="form-group">
	                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="**********" v-model="user.password2">
	                            </div>
	                        </div>
	                        <div v-if="user.is_admin == '2'" class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            <label for="address">Dirección: </label>
	                            <div class="form-group">        
	                                <textarea class="form-control" name="address" placeholder="Dirección del conjunto residencial" rows="6" v-model="user.residential.address"></textarea>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="row" v-if="user.is_admin == '0'">
	                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            <h4 class="page-title">Datos de la persona de contacto</h4>
	                        </div>
	                        
	                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            <strong>(*)</strong> <label for="name">Nombre: </label>
	                            <div class="form-group">
	                                    <input type="text" class="form-control" name="contact_person[name]" placeholder="Nombre del conjunto residencial" v-model="user.residential.contact_person.name">
	                            </div>
	                        </div>
	                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            <strong>(*)</strong> <label for="email">Email: </label>
	                            <div class="form-group">
	                                    <input type="email" class="form-control" name="contact_person[email]" placeholder="Email del conjunto residencial" v-model="user.residential.contact_person.email">
	                            </div>
	                        </div>
	                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            <strong>(*)</strong> <label for="email">Teléfono: </label>
	                            <div class="form-group">
	                                    <input type="phone" class="form-control" name="contact_person[phone]" placeholder="Email del conjunto residencial" v-model="user.residential.contact_person.phone">
	                            </div>
	                        </div>
	                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            <label for="address">Dirección: </label>
	                            <div class="form-group">        
	                                <textarea class="form-control" name="contact_person[address]" placeholder="Dirección de la persona de contacto del conjunto residencial" rows="6" v-model="user.residential.contact_person.address"></textarea>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
		                    <div class="col-12 col-sm-12 col-md-12">
		                    	<div class="callout callout-info float-left">
			                        <label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label>
			                    </div>
			                    <div class="float-right">
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
        </div> <!-- end col -->
    </div> <!-- end row -->

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
	const user_id = "<?php echo e(Auth::user()->id); ?>";
</script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/showProfile.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/showProfile.blade.php ENDPATH**/ ?>