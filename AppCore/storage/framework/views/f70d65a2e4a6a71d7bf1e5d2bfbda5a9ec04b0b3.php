<?php $__env->startSection('title'); ?>Perfil <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
    <style type="text/css">
        .dropify-wrapper{
            height: 300px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Perfil</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Perfil
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Simple Validation start -->
        <section class="simple-validation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <form onsubmit="return false;" id="form_" class="form form-vertical">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Imagen de perfil *</label>
                                                                    <div class="position-relative has-icon-left" id="image">
                                                                        <input type="file" class="dropify" id="image" name="image">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <div class="form-group">
                                                                            <label>Nombre *</label>
                                                                            <div class="position-relative has-icon-left">
                                                                                <input type="text" class="form-control" placeholder="Ingrese el nombre del cocinero" name="name" v-model="user.name">
                                                                                <div class="form-control-position">
                                                                                    <i class="fa fa-header"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <div class="form-group">
                                                                            <label>Apellido *</label>
                                                                            <div class="position-relative has-icon-left">
                                                                                <input type="text" class="form-control" placeholder="Ingrese el apellido del cocinero" name="last_name" v-model="user.last_name">
                                                                                <div class="form-control-position">
                                                                                    <i class="fa fa-header"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <div class="form-group">
                                                                            <label>Cédula de Identidad *</label>
                                                                            <div class="position-relative has-icon-left">
                                                                                <input type="text" class="form-control" placeholder="Ingrese la cédula de identidad del cocinero" name="dni" v-model="user.dni" data-height="400">
                                                                                <div class="form-control-position">
                                                                                    <i class="fa fa-address-card"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <div class="form-group">
                                                                            <label>Correo Electónico *</label>
                                                                            <div class="position-relative has-icon-left">
                                                                                <input type="email" class="form-control" placeholder="Correo Electónico del cocinero" name="email" v-model="user.email">
                                                                                <div class="form-control-position">
                                                                                    <i class="fa fa-envelope"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Código postal *</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" class="form-control" placeholder="Ingrese el código postal" name="postal_code" v-model="user.postal_code">
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Teléfono *</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" class="form-control" placeholder="Ingrese el número de teléfono del cocinero" name="phone" v-model="user.phone">
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Celular *</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" class="form-control" placeholder="Ingrese el número de celular del cocinero" name="cellular" v-model="user.cellular">
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Ciudad *</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" class="form-control" placeholder="Ingrese la ciudad del cocinero" name="city" v-model="user.city">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-map-pin"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Barrio *</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" class="form-control" placeholder="Ingrese el barrio del cocinero" name="neighborhood" v-model="user.neighborhood">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-map-pin"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Rango de Delivery (Km)*</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" class="form-control" placeholder="Ingrese el barrio del cocinero" name="delivery_distance_range" v-model="user.delivery_distance_range">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-minus"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Latitud *</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" class="form-control" placeholder="Ingrese la ciudad del cocinero" name="latitude" v-model="user.latitude">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-map-pin"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Longitud *</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" class="form-control" placeholder="Ingrese el barrio del cocinero" name="longitude" v-model="user.longitude">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-map-pin"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Dirección Detallada *</label>
                                                            <div class="position-relative has-icon-left">
                                                                <textarea class="form-control" placeholder="Dirección del Cliente" name="address" rows="3" v-model="user.address"></textarea>
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-12">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Contraseña de acceso al sistema</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Contraseña *</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="password" class="form-control" placeholder="Ingrese el barrio del cocinero" id="password" name="password" v-model="user.password">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-lock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Confirmar contraseña *</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="password" class="form-control" placeholder="Ingrese el barrio del cocinero" id="password2" name="password2" v-model="user.password2">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-lock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                        <div class="alert alert-primary" role="alert">
                                                            <h4 class="alert-heading">IMPORTANTE: </h4>
                                                            <p class="mb-0">
                                                                Todos los campos con (*) deben ser completados
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer modal-footer-uniform">         
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <button type="button" id="form-close-modal" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true">
                                                        <template v-if="!loading">
                                                            <i class="fa fa-sign-in"></i> Guardar
                                                        </template>
                                                        <template v-if="loading">
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
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/users/profile.js')); ?>"></script> 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/admin/showProfile.blade.php ENDPATH**/ ?>