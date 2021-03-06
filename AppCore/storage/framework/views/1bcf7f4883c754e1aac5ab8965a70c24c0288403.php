<?php $__env->startSection('title'); ?>Manuales <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/select2/dist/css/select2.min.css')); ?>">
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
                    Listado de Manuales
                    <button class="btn btn-primary" type="button" v-on:click="addNew()">
                        <i class="fa fa-plus"></i> Nuevo
                    </button>
                </h4>

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>/">Estadísticas</a></li>
                    <li class="breadcrumb-item active">Manuales</li>
                </ol>
            </div>
        </div> <!-- end row -->
    </div>
    <!-- end page-title -->

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <!--<div class="card-body-header">
                        <h4 class="mt-0 header-title">
                            Listado
                        </h4>
                    </div> -->
                    <!-- <p class="sub-title font-14">This is an experimental awesome solution for responsive tables with complex data.</p>-->
                    <div class="row m-b-30">
                        <div class="col-12 col-sm-8 col-md-8 col-lg-8"></div>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="input-group input-group-sm" style="width: 100%;">
                                <input type="text" name="table_search" class="form-control text-right" placeholder="Filtrar resultados" v-model="filter">
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <datatable :columns="columns" :data="rows" :filter-by="filter" class="table table-bordered table-hover table-striped">
                                <template scope="{ row }" v-if="rows.length != 0">
                                    <tr>
                                        <th class="text-center" width="20%">
                                            <img v-if="row.image != null" :src="'<?php echo e(asset('storage')); ?>/' + row.image" width="100">
                                        </th>
                                        <th>{{ row.title }}</th>
                                        <th style="max-width: 120px !important; white-space: normal;">{{ row.residential.name }}<br/>{{ row.residential.email }}</th>
                                        <th>{{ row.name }}</th>
                                        <th><is-active :is_active="row.is_active"></is-active></th>
                                        <th class="text-right" style="width: 10%;">
                                            <button type="button" class="btn btn-warning btn-sm" v-on:click="view(row)"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm " v-on:click="removeItem(row)"><i class="fa fa-trash"></i></button>
                                        </th>
                                    </tr>
                                </template>
                            </datatable>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
<!-- container-fluid -->

<!--  Modal content for the above example -->
<div id="modal-form" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Agregar / Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="form_" onsubmit="return false;">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <strong>(*)</strong> <label for="title">Título: </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="title" placeholder="Título del Manual" v-model="manual.title">
                                    </div>
                                </div> 
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <strong>(*)</strong> <label for="residential">Selecione el Conjunto Residencial</label>
                                    <div class="form-group">
                                        <select class="form-control" id="select2" name="residential" style="width: 100%;">
                                            <option value="" :selected="manual.users_id == ''">-- Seleccionar --</option>
                                            <option v-for="res in residentials" :value="res.id" :selected="manual.users_id == res.id">
                                                {{ res.name }} - {{ res.email }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-12" id="image">
                                            <strong>(*)</strong> <label for="image">Vista previa del manual (Imagen PNG. JPEG, JPG) </label>
                                            <input type="file" class="dropify" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-12" id="file">
                                            <strong>(*)</strong> <label for="file">Manual en PDF </label>
                                            <input type="file" class="dropify" name="file" data-max-file-size="5M" data-allowed-file-extensions="pdf" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="is_active">Status: </label>
                            <div class="form-group">
                                <div class="checkbox icheck pl-20" >
                                    <label>
                                        <input type="checkbox" name="is_active" value="1" checked="checked" v-model="manual.is_active" > Activar
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label><br/>
                                <label>Las imagenes se recomienda que sea de un ancho de  800px y un largo de 800px con un peso máximo de 2M</label><br/>
                                <label>El Documento no debe pesar más de 5M</label>
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
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/select2/dist/js/select2.full.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/manual/index.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/admin/manuals/index.blade.php ENDPATH**/ ?>