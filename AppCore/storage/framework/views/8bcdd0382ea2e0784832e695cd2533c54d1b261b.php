<?php $__env->startSection('title'); ?>Conjuntos Residenciales <?php $__env->stopSection(); ?>

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
					Conjuntos residenciales
					<button class="btn btn-primary" type="button" v-on:click="addNew()">
	                    <i class="fa fa-plus"></i> Nuevo
	                </button>
				</h4>

			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>/">Estadísticas</a></li>
					<li class="breadcrumb-item active">Conjuntos residenciales</li>
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
                                        <!-- <th>{{ row.nit }}</th> -->
                                        <th style="max-width: 120px !important; white-space: normal;">{{ row.name }}</th>
                                        <!-- <th>{{ row.email }}</th>
                                        <th>{{ row.phone }}</th>                                        
                                        <th>{{ row.address }}</th>-->
                                        <th>
                                            <b>Nombre:</b> {{ row.contact_person.name }}<br/>
                                            <b>Email:</b> {{ row.contact_person.email }}<br/>
                                            <b>Teléfono:</b> {{ row.contact_person.phone }}<br/>
                                        </th>
                                        <th><is-active :is_active="row.is_active"></is-active></th>
                                        <th class="text-right" style="width: 14%;">
                                            <button type="button" class="btn btn-info btn-sm" v-on:click="addZones(row)"><i class="fa fa-list"></i> Asignar Zonas</button>
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
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <strong>(*)</strong> <label for="name">NIT: </label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nit" placeholder="NIT del conjunto residencial" v-model="residential.nit">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <strong>(*)</strong> <label for="name">Nombre: </label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" placeholder="Nombre del conjunto residencial" v-model="residential.name">
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
                                                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Teléfono del conjunto residencial" v-model="residential.phone">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
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
                            <strong>(*)</strong> <label for="email">Contraseña de acceso: </label>
                            <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="**********" v-model="residential.password" v-on:change="changePassword = 1">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <strong>(*)</strong> <label for="email">Confirma contraseña de acceso: </label>
                            <div class="form-group">
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="**********" v-model="residential.password2" v-on:change="changePassword2 = 1">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="address">Dirección: </label>
                            <div class="form-group">        
                                <textarea class="form-control" name="address" placeholder="Dirección del conjunto residencial" rows="6" v-model="residential.address"></textarea>
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
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <h4 class="page-title">Datos de la persona de contacto</h4>
                        </div>
                        
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <strong>(*)</strong> <label for="name">Nombre: </label>
                            <div class="form-group">
                                    <input type="text" class="form-control" name="contact_person[name]" placeholder="Nombre de la persona de contacto" v-model="residential.contact_person.name">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <strong>(*)</strong> <label for="email">Email: </label>
                            <div class="form-group">
                                    <input type="email" class="form-control" name="contact_person[email]" placeholder="Email de la persona de contacto" v-model="residential.contact_person.email">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <strong>(*)</strong> <label for="phone">Teléfono: </label>
                            <div class="form-group">
                                    <input type="phone" class="form-control" name="contact_person[phone]" placeholder="Teléfono de la persona de contacto" v-model="residential.contact_person.phone">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="address">Dirección: </label>
                            <div class="form-group">        
                                <textarea class="form-control" name="contact_person[address]" placeholder="Dirección de la persona de contacto" rows="6" v-model="residential.contact_person.address"></textarea>
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


<!--  Modal content for the above example -->
<div id="modal-add-zones" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Agregar/Editar Zonas para el Cojunto Residencial: <b>{{ residential.name }}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="accordion">
                    <div class="card mb-0" v-for="zone in zones">
                        <div class="card-header" :id="'zone-'+zone.element_slug" data-toggle="collapse" data-parent="#accordion" :href="'#collapse'+zone.element_slug" :aria-controls="'#collapse'+zone.element_slug">
                            <h5 class="mb-0 mt-0 font-14">
                                <a class="text-dark">
                                    {{ zone.element_name }}
                                    <template v-if="is_zone_selected(zone.id)">
                                        <div class="float-right">
                                            <label class="text-success mr-3">(ZONA ASIGNADA) </label>
                                            <button class="btn btn-danger btn-sm float-right" v-on:click="removeZoneUser(zone)"><i class="fa fa-trash"></i> Eliminar para Conjunto</button>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="float-right">
                                            <label class="text-secondary mr-3">(ZONA <b>NO</b> ASIGNADA) </label>
                                            <button class="btn btn-info btn-sm float-right" v-on:click="addZoneUser(zone)"><i class="fa fa-plus"></i> Agregar a Conjunto</button>
                                        </div>
                                    </template>
                                </a>
                            </h5>
                        </div>

                        <div :id="'collapse'+zone.element_slug" class="collapse"
                                aria-labelledby="'zone-'+zone.element_slug" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-4" v-for="input in zone.inputs">
                                        <div class="form-group">
                                            <div class="checkbox icheck pl-20" >
                                                <label>
                                                    <input type="checkbox" :name="input.name" :checked="is_input_selected(input)" v-on:click="addInputUser(input)"> {{ input.label }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" :disabled="sending == true" v-on:click="addZonesAndInputs()">
                    <template v-if="!sending">
                        <i class="fa fa-save"></i> Guardar cambios
                    </template>
                    <template v-if="sending">
                        <i class="fa fa-spinner fa-spin"></i>
                    </template>
                </button>
            </div>
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
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/conjuntosResidenciales/index.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/admin/conjuntosResidenciales/index.blade.php ENDPATH**/ ?>