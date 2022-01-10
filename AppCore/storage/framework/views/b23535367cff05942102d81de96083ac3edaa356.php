<?php $__env->startSection('title'); ?>Registro de Apartamento <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
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
					Registro de Apartamentos
					<button class="btn btn-primary" type="button" v-on:click="addNew()">
	                    <i class="fa fa-plus"></i> Nuevo
	                </button>
				</h4>

			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>/">Estadísticas</a></li>
					<li class="breadcrumb-item active">Registro de Apartamentos</li>
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
                                        <th>{{ row.owner_name }}</th>
                                        <th>{{ row.owner_id }}</th>
                                        <th>{{ row.tower }}</th>
                                        <th>{{ row.apartament_num }}</th>
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
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Agregar / Editar Apartamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="form_" onsubmit="return false;">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <strong>(*)</strong> <label for="owner_name">Nombre del propietario: </label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="owner_name" placeholder="Escriba el nombre del propietario del Apartamento" v-model="departament.owner_name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <strong>(*)</strong> <label for="owner_id">Cédula del propietario: </label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="owner_id" placeholder="Escriba la cédula del propietario del Apartamento" v-model="departament.owner_id">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <strong>(*)</strong> <label for="tower">Torre: </label>
                                            <div class="form-group">
                                                    <input type="text" class="form-control" id="tower" name="tower" placeholder="Torre donde pertenece el Apartamento" v-model="departament.tower">
                                            </div>
                                        </div>
                                         <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <strong>(*)</strong> <label for="apartament_num">Nº De Apartamento: </label>
                                            <div class="form-group">
                                                <input type="number" min="0" class="form-control" id="apartament_num" name="apartament_num" placeholder="Escriba el número del Apartamento" v-model="departament.apartament_num">
                                            </div>
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
                                        <input type="checkbox" name="is_active" v-model="departament.is_active" > Activar
                                    </label>
                                </div>
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/departament.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/departament.blade.php ENDPATH**/ ?>