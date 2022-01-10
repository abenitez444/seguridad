<?php $__env->startSection('title'); ?> <?php echo e($zone->element_name); ?> <?php $__env->stopSection(); ?>

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
					Campos para la <?php echo e($zone->element_name); ?>

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
                                        <th>{{ row.position }}</th>
                                        <th>{{ row.label }}</th>
                                        <th>{{ row.type }}</th>
                                        <th>
                                            <template>
                                                <b>Requerido: </b> <label v-if="row.is_required == 1">SI</label><label v-if="row.is_required == 0">NO</label>
                                                <br/>
                                            </template>
                                            <template v-if="element.type != 'textarea' && element.type != 'checkbox' && element.type != 'select' && element.type != 'number'">
                                                <b>Longitud mínima de carácteres: </b> <label>{{ row.minlength }}</label>
                                                <br/>
                                                <b>Longitud máxima de carácteres: </b> <label>{{ row.maxlength }}</label>
                                                <br/>
                                            </template>
                                            <template v-if="element.type == 'number'">
                                                <b>Número mínimo: </b> <label>{{ row.min }}</label>
                                                <br/>
                                                <b>Número máximo: </b> <label>{{ row.max }}</label>
                                                <br/>
                                            </template>
                                        </th>
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
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Agregar / Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" id="form_" onsubmit="return false;">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6" style="border-right: 1px solid #dee2e6;">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <strong>(*)</strong> <label for="label">Descripción: </label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="label" name="label" placeholder="Escribir label del campo a registrar" v-model="element.label">
                                            <div class="input-group-append bg-custom b-0" data-toggle="tooltip" data-placement="top" title="Nombre que tendrá el campo"><span class="input-group-text"><i class="fa fa-info"></i></span></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <strong>(*)</strong> <label for="label">Placeholder: </label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="placeholder" name="placeholder" placeholder="Escribir placeholder del campo a registrar" v-model="element.placeholder">
                                            <div class="input-group-append bg-custom b-0" data-toggle="tooltip" data-placement="top" title="Texto que estará dentro del campo de forma de ayuda para el usuario"><span class="input-group-text"><i class="fa fa-info"></i></span></div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <strong>(*)</strong> <label for="type">Tipo: </label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select class="form-control" name="type" placeholder="Nombre del campo" v-model="element.type">
                                                <option value="text">Texto (text)</option>
                                                <option value="email">Verificar si es un Email (email)</option>
                                                <option value="number">Númerico (number)</option>
                                                <option value="select">Opciones (select)</option>
                                                <option value="textarea">Texto extendido (textarea)</option>
                                                <option value="checkbox">Check (checkbox)</option>
                                            </select>
                                            <div class="input-group-append bg-custom b-0" data-toggle="tooltip" data-placement="top" title="Seleccionar el tipo de campo (TEXTO, OPCIONES, CHECK, TEXTO EXTENDIDO)"><span class="input-group-text"><i class="fa fa-info"></i></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" v-if="element.type == 'text' || element.type == 'email'">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <strong>(*)</strong> <label for="minlength">Mínimo de carácteres: </label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control" name="minlength" placeholder="Mínimo de carácteres permitidos" v-model="element.minlength">
                                            <div class="input-group-append bg-custom b-0" data-toggle="tooltip" data-placement="top" title="Si son campos de tipo texto acá indicará la longitud mínima de carácteres que debe tener lo que ingrese el usuario"><span class="input-group-text"><i class="fa fa-info"></i></span></div>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <strong>(*)</strong> <label for="maxlength">Máximo de carácteres: </label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control" name="maxlength" placeholder="Mínimo de carácteres permitidos" v-model="element.maxlength">
                                            <div class="input-group-append bg-custom b-0" data-toggle="tooltip" data-placement="top" title="Si son campos de tipo texto acá indicará la longitud máximo de carácteres que debe tener lo que ingrese el usuario"><span class="input-group-text"><i class="fa fa-info"></i></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" v-if="element.type == 'number'">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <strong>(*)</strong> <label for="min">Número mínimo: </label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control" name="min" placeholder="El número menor que se puede ingresar" v-model="element.min">
                                            <div class="input-group-append bg-custom b-0" data-toggle="tooltip" data-placement="top" title="Si son campos de tipo númerico acá indicará el número menor que puede ingresar el usuario"><span class="input-group-text"><i class="fa fa-info"></i></span></div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <strong>(*)</strong> <label for="max">Número máximo: </label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control" name="max" placeholder="Mínimo El número máximo que se puede ingresar" v-model="element.max">
                                            <div class="input-group-append bg-custom b-0" data-toggle="tooltip" data-placement="top" title="Si son campos de tipo númerico acá indicará el número mayor que puede ingresar el usuario"><span class="input-group-text"><i class="fa fa-info"></i></span></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row" v-if="element.type == 'select' ">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <h4 class="page-title">
                                        Opciones para la lista 
                                        <button class="btn btn-secondary" type="button" v-on:click="addNewOption()">
                                            <i class="fa fa-plus"></i> Agregar
                                        </button>
                                    </h4>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12" v-for="(option, index) in element.options">
                                    <div class="row">
                                        <div class="col-10 col-sm-10 col-md-10 col-lg 10">
                                            <strong>(*)</strong> <label>Descripción: </label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Descripción de la opción" v-model="option.label">
                                            </div>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                            <div class="mt-27">
                                                <button class="btn btn-danger" v-on:click="removeOption(index)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <h4 class="page-title">Condiciones para el campo</h4>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                    <label for="is_active">Status: </label>
                                    <div class="form-group">
                                        <div class="checkbox icheck pl-20" >
                                            <label>
                                                <input type="checkbox" name="is_active" v-model="element.is_active" > Activar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                    <label for="is_required">Requerido: </label>
                                    <div class="form-group">
                                        <div class="checkbox icheck pl-20" >
                                            <label>
                                                <input type="checkbox" data-toggle="tooltip" data-placement="top" title="Si marca esta opcion el campo debe ser completado de forma obligatoria por el usuario, y se antepondrá a la descripción lo siguente (*) que lo indica como obligatorio."  name="is_required" value="1" v-model="element.is_required" > Activar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <strong>(*)</strong> <label for="position">Posición en el Formulario: </label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="position" placeholder="Posición a donde debe mostrarse en el formulario" v-model="element.position">
                                            <div class="input-group-append bg-custom b-0" data-toggle="tooltip" data-placement="top" title="se indica con un número la posición en el orden de salida en el formulario, el orden es de menor a mayo, si es campo es (CERO) saldra de primero al momento de cargar el formulario correspondiente."><span class="input-group-text"><i class="fa fa-info"></i></span></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <h4 class="page-title">Algunas configuraciones de diseño</h4>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <strong>(*)</strong> <label for="phone_size">Tamaño en teléfonos: </label>
                                    <div class="form-group">
                                        <select class="form-control" name="phone_size" placeholder="Distribución de pantalla den moviles" v-model="element.phone_size">
                                            <option value="col-12" selected="selected">Largo (Recomendado)</option>
                                            <option value="col-6">Mediano</option>
                                            <option value="col-4">Pequeño</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <strong>(*)</strong> <label for="tablet_size">Tamaño en tablet: </label>
                                    <div class="form-group">
                                        <select class="form-control" name="tablet_size" placeholder="Distribución de pantalla den moviles" v-model="element.tablet_size">
                                            <option value="col-sm-12">Largo</option>
                                            <option value="col-sm-6">Mediano (Recomendado)</option>
                                            <option value="col-sm-4">Pequeño</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <strong>(*)</strong> <label for="pc_size">Tamaño en pc: </label>
                                    <div class="form-group">
                                        <select class="form-control" name="pc_size" placeholder="Distribución de pantalla den moviles" v-model="element.pc_size">
                                            <option value="col-md-12">Largo</option>
                                            <option value="col-md-6" selected="selected">Mediano (Recomendado)</option>
                                            <option value="col-md-4">Pequeño</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="row alert alert-secondary" style="border-bottom: 1px solid #dee2e6;">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <h4 class="page-title">Vista previa</h4>
                                </div>
                                <div :class="element.phone_size + ' ' + element.tablet_size + ' ' + element.pc_size" v-if="element.type=='text' || element.type == 'email' ">
                                    <strong v-if="element.is_required == true">(*)</strong> <label :for="element.name"> {{ element.label }}</label>
                                    <div class="form-group">
                                        <input :type="element.type" :minlength="element.minlength" :maxlength="element.maxlength" class="form-control" :name="element.name" :placeholder="element.placeholder">
                                    </div>
                                </div>
                                <div :class="element.phone_size + ' ' + element.tablet_size + ' ' + element.pc_size" v-if="element.type == 'number' ">
                                    <strong v-if="element.is_required == true">(*)</strong> <label :for="element.name"> {{ element.label }}</label>
                                    <div class="form-group">
                                        <input :type="element.type" :min="element.min" :max="element.max" class="form-control" :name="element.name" :placeholder="element.placeholder">
                                    </div>
                                </div>
                                <div :class="element.phone_size + ' ' + element.tablet_size + ' ' + element.pc_size" v-if="element.type == 'select' ">
                                    <strong v-if="element.is_required == true">(*)</strong> <label :for="element.name"> {{ element.label }}</label>
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option v-for="op in element.options" :value="op.value"> {{ op.label }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div :class="element.phone_size + ' ' + element.tablet_size + ' ' + element.pc_size" v-if="element.type == 'textarea' ">
                                    <strong v-if="element.is_required == true">(*)</strong> <label :for="element.name"> {{ element.label }}</label>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="8" :placeholder="element.placeholder"></textarea>
                                    </div>
                                </div>
                                <div :class="element.phone_size + ' ' + element.tablet_size + ' ' + element.pc_size" v-if="element.type == 'checkbox' ">
                                    <strong v-if="element.is_required == true">(*)</strong> <label :for="element.name"> {{ element.placeholder }}</label>
                                    <div class="form-group">
                                        <div class="checkbox icheck pl-20" >
                                            <label>
                                                <input type="checkbox" :name="element.name"> {{ element.label }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-30">
                                    <p><b>ATRIBUTOS INDICADOS PARA EL CAMPO </b></p>
                                    <b>Tipo: {{ element.type }}<br/></b>
                                    <b v-if="element.type != 'textarea' && element.type != 'checkbox' && element.type != 'select' && element.type != 'number'">Longitud mínima: {{ element.minlength }}<br/></b>
                                    <b v-if="element.type != 'textarea' && element.type != 'checkbox' && element.type != 'select' && element.type != 'number'">Longitud máxima: {{ element.maxlength }}<br/></b>
                                    <b v-if="element.type == 'number'">Número mínimo: {{ element.min }}<br/></b>
                                    <b v-if="element.type == 'number'">Número máximo: {{ element.mx }}<br/></b>
                                    <b>Requerido: <label v-if="element.is_required == true">SI</label><label v-if="element.is_required == false">NO</label><br/></b>
                                </div>
                            </div>
                            <div class="row alert alert-info alert-dismissible fade show" style="border-bottom: 1px solid #dee2e6;" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <h4 class="page-title">Indicaciones</h4>
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <strong>(*)</strong> <label for="label">Descripción del campo </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="placeholder" placeholder="Placeholder del campo">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-30">
                                    <!-- <b>Atributos indicados: </b><br/> -->
                                    <b>Leyenda:<br/></b>
                                    <p><span>Descrición: </span> Nombre que tendrá el campo</p>
                                    <p><span>Placeholder: </span> Texto que estará dentro del campo de forma de ayuda para el usuario</p>
                                    <p><span>Tipo: </span> Seleccionar el tipo de campo (TEXTO, OPCIONES, CHECK, TEXTO EXTENDIDO)</p>
                                    <p>Mínimo de carácteres: <span>Si son campos de tipo texto acá indicará la longitud mínima de carácteres que debe tener lo que ingrese el usuario</span></p>
                                    <p>Máximo de carácteres: <span>Si son campos de tipo texto acá indicará la longitud máxima de carácteres que debe tener lo que ingrese el usuario</span></p>
                                    <p>Número mínimo: <span>Si son campos de tipo númerico acá indicará el número menor que puede ingresar el usuario</span></p>
                                    <p>Número máximo: <span>Si son campos de tipo númerico acá indicará el número mayor que puede ingresar el usuario</span></p>
                                    <p>Requerido: <span>Si marca esta opcion el campo debe ser completado de forma obligatoria por el usuario, y se antepondrá a la descripción lo siguente <b>(*)</b> que lo indica como obligatorio.</span></p>
                                    <p>Posición en formulario: <span>se indica con un número la posición en el orden de salida en el formulario, el orden es de menor a mayo, si es campo es (cero) saldra de primero al momento de cargar el formulario correspondiente.</span></p>
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
<script type="text/javascript">const zone = "<?php echo e($zone->element_slug); ?>"; console.log(zone);</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/zones/index.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/admin/zones/index.blade.php ENDPATH**/ ?>