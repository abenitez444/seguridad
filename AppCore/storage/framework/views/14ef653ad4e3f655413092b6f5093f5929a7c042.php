<?php $__env->startSection('title'); ?>Precio del Envió <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Precio del Envió</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Precio del envió
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
                            <div class="row" style="width: 100%;">
                                <form onsubmit="return false;" id="form_" class="form form-vertical" style="width: 100%;">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Ingrese el costo del envió *</label>
                                                        <div class="position-relative has-icon-left">
                                                            <money type="text" class="form-control" placeholder="Ingrese el barrio del cocinero" name="cost" v-model="cost" v-bind="money"></money>
                                                            <div class="form-control-position">
                                                                <i class="fa fa-money"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <fieldset>
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input type="checkbox" name="is_active" value="1" v-model="is_active">
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                                <span class="">Activo</span>
                                                            </div>
                                                        </fieldset>
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
                                        <div class="modal-footer modal-footer-uniform">         
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <!-- <button type="button" id="form-close-modal" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cerrar</button>-->
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
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/v-money-master/dist/v-money.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/cooks/shippingCost.js')); ?>"></script> 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/cooks/shippingCost.blade.php ENDPATH**/ ?>