<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>
<!--  Modal content for the above example -->
<div id="modal-form-residential" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Editar eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="form_" onsubmit="return false;" v-on:submit="saveForm()">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <strong>(*)</strong> <label for="name">Nombre: </label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del conjunto residencial" v-model="residential.name">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <strong>(*)</strong> <label for="email">Email: </label>
                            <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email del conjunto residencial" v-model="residential.email">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <strong>(*)</strong> <label for="email">Teléfono: </label>
                            <div class="form-group">
                                
                                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Email del conjunto residencial" v-model="residential.phone">
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="address">Dirección: </label>
                            <div class="form-group">        
                                <textarea class="form-control" name="address" placeholder="Descripción del diseño" rows="10" v-model="residential.address"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="is_active">Status: </label>
                            <div class="form-group">
                                <div class="checkbox icheck pl-20" >
                                    <label>
                                        <input type="checkbox" name="is_active" value="1" checked="checked" v-model="residential.is_active" > Activar
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h4 class="page-title">Datos de la persona de contacto</h4>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <strong>(*)</strong> <label for="name">Nombre: </label>
                            <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del conjunto residencial" v-model="residential.contact_person.name">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <strong>(*)</strong> <label for="email">Email: </label>
                            <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email del conjunto residencial" v-model="residential.contact_person.email">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <strong>(*)</strong> <label for="email">Teléfono: </label>
                            <div class="form-group">
                                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Email del conjunto residencial" v-model="residential.contact_person.phone">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="callout callout-info text-left">
                        <label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label>
                    </div>
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
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $__env->startPush('vuejs'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/conjuntosResidenciales/form.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/admin/conjuntosResidenciales/form.blade.php ENDPATH**/ ?>