<?php $__env->startSection('title'); ?> <?php echo e($zone->element_name); ?> <?php $__env->stopSection(); ?>

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
					<?php echo e($zone->element_name); ?>

					<button class="btn btn-primary" type="button" v-on:click="addNew()">
	                    <i class="fa fa-plus"></i> Agregar
	                </button>
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
                                        <th>
                                            <label>Torre: {{ row.departament.tower }}<br/>
                                            Nº de Apartamento: {{ row.departament.apartament_num }}<br/>
                                        </th>
                                        <th v-for="data in row.inputs" v-if="data.is_visible">{{ data.pivot.value }}</th>
                                        <th><is-active :is_active="row.is_active"></is-active></th>
                                        <th class="text-right" style="width: 14%;">
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
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Agregar/Editar</h5>
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
                                    <strong>(*)</strong> <label for="is_active">Selecione el Apartamento</label>
                                    <div class="form-group">
                                        <select class="form-control" id="select2" name="departament" style="width: 100%;">
                                            <option value="">-- Seleccionar --</option>
                                            <option v-for="d in departaments" :value="d.id">
                                                Torre: {{ d.tower }} - Apartamento: {{ d.apartament_num }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <strong>(*)</strong> <label for="is_active">Status</label>
                                    <div class="form-group">
                                        <div class="checkbox icheck pl-20" >
                                            <label>
                                                <input type="checkbox" name="is_active" v-model="element.is_active"> Activar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div v-for="element in element.inputs" :class="element.phone_size + ' ' + element.tablet_size + ' ' + element.pc_size">
                                    <template v-if="element.type=='text' || element.type == 'email' ">
                                        <strong v-if="element.is_required == true">(*)</strong> <label :for="element.name"> {{ element.label }}</label>
                                        <div class="form-group">
                                            <input :type="element.type" :minlength="element.minlength" :maxlength="element.maxlength" class="form-control" :name="element.name" :placeholder="element.placeholder" :value="element.value" v-model="element.pivot.value">
                                        </div>
                                    </template>
                                    <template v-if="element.type == 'number' ">
                                        <strong v-if="element.is_required == true">(*)</strong> <label :for="element.name"> {{ element.label }}</label>
                                        <div class="form-group">
                                            <input :type="element.type" :min="element.min" :max="element.max" class="form-control" :name="element.name" :placeholder="element.placeholder" v-model="element.pivot.value">
                                        </div>
                                    </template>
                                    <template v-if="element.type == 'select' ">
                                        <strong v-if="element.is_required == true">(*)</strong> <label :for="element.name"> {{ element.label }}</label>
                                        <div class="form-group">
                                            <select class="form-control" v-model="element.pivot.value">
                                                <option v-for="op in element.options" :value="op.value"> {{ op.label }}</option>
                                            </select>
                                        </div>
                                    </template>
                                    <template v-if="element.type == 'textarea' ">
                                        <strong v-if="element.is_required == true">(*)</strong> <label :for="element.name"> {{ element.label }}</label>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="6" :placeholder="element.placeholder" v-model="element.pivot.value"></textarea>
                                        </div>
                                    </template>
                                    <template v-if="element.type == 'checkbox' ">
                                        <strong v-if="element.is_required == true">(*)</strong> <label :for="element.name"> {{ element.placeholder }}</label>
                                        <div class="form-group">
                                            <div class="checkbox icheck pl-20" >
                                                <label>
                                                    <input type="checkbox" :name="element.name" v-model="element.pivot.value"> {{ element.label }}
                                                </label>
                                            </div>
                                        </div>
                                    </template>
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
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/select2/dist/js/select2.full.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')); ?>"></script>
<script type="text/javascript">const zone = "<?php echo e($zone->element_slug); ?>"; console.log(zone);</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/zones/indexClient.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/admin/zones/indexClient.blade.php ENDPATH**/ ?>