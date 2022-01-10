<?php $__env->startSection('title'); ?>Aisgnación de Vigilantes <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Asignación de vigilantes</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.index')); ?>">Dashboard</a></li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content" id="app-main">

	<!-- Default box -->
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Asignación de vigilantes a puestos</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label>Tipo de asignación *</label>
                        <div class="input-group mb-3">
                            <select class="form-control" v-on:change="changeType()" v-model="assignment.type">
                            	<option value="">-- Seleccionar --</option>
                            	<option value="nuevo">Nuevo</option>
                            	<option value="reemplazo">Reemplazo</option>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-clock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4" v-if="clients.length > 0">
                    <div class="form-group">
                        <label>Puestos *</label>
                        <div class="input-group mb-3">
                            <select class="form-control" v-model="assignment.clients_id" v-on:change="setClienteSelected()">
                            	<option value="">-- Seleccionar --</option>
                            	<option v-for="c in clients" :value="c.id">{{ c.name }}</option>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-clock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-2 col-lg-2" v-if="clients.length > 0">
                    <div class="form-group">
                        <label>Programación *</label>
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" v-model="client_selected.shift.name" disabled="disabled">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-clock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-1 mb-1" v-if="clients.length > 0">
                    <div class="form-group">
                        <label></label>
                        <div class="input-group mb-3 mt-2">
                            <button type="button" class="btn btn-info mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true" v-on:click="startassignment()">
                            	INICIAR
                            </button>
                        </div>
                    </div>
                </div>
                <template v-if="start && assignment.type=='nuevo'">
                	<div class="col-12 col-sm-3 col-md-2 col-lg-2"></div>
                	<div class="col-12 col-sm-6 col-md-8 col-lg-8">
                		<div class="row">
                			<div class="col-12 col-sm-12 col-md-7 col-lg-7">
				                <div class="form-group">
				                    <label>Selecciona el Vigilante *</label>
				                    <div class="input-group mb-3">
				                        <select class="form-control" v-model="vigilant_selected" :disabled="clienteCompleted">
				                        	<option value="">-- Seleccionar --</option>
				                        	<option v-for="w in watchmen" :value="w.id" v-if="!inListSelected(w)">{{ w.name }}</option>
				                        </select>
				                        <div class="input-group-append">
				                            <div class="input-group-text">
				                                <span class="fas fa-users-cog"></span>
				                            </div>
				                        </div>
				                    </div>
				                </div>
				            </div>
				            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
				                <div class="form-group">
				                    <label>Selecciona el inicio *</label>
				                    <div class="input-group mb-3">
				                        <select class="form-control" v-model="start_vigilant" :disabled="clienteCompleted">
				                        	<option value="D" v-if="client_selected.shift.name != '5X2'">Día</option>
				                        	<option value="N">Noche</option>
				                        	<option value="X">Descanso</option>
				                        </select>
				                        <div class="input-group-append">
				                            <div class="input-group-text">
				                                <span class="fas fa-users-cog"></span>
				                            </div>
				                        </div>
				                    </div>
				                </div>
				            </div>
				            <div class="col-12 col-sm-12 col-md-2 col-lg-2">
			                    <div class="form-group">
			                        <label></label>
			                        <div class="input-group mb-3">
			                            <button type="button" class="btn btn-secondary mr-1 mb-1 mt-2 waves-effect waves-light float-right" :disabled="loading == true || clienteCompleted || vigilant_selected == ''" v-on:click="addVigilant()">
			                            	<i class="fa fa-plus-square"></i>
			                            </button>
			                        </div>
			                    </div>
			                </div>
                		</div>
                	</div>
                	<div class="col-12 col-sm-3 col-md-2 col-lg-2"></div>
                </template>

                <template v-if="assignment.list_watchmen.length > 0">
                	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                		<h5>Listado de Vigilantes asignados</h5>
                	</div>
                	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                		<div class="form-group row">
                    		<label for="inputEmail3" class="col-12 col-sm-12 col-md-7 col-lg-7 col-form-label">Fecha de inicio para la programación:</label>
		                    <div class="col-12 col-sm-12 col-md-5 col-lg-5">
		                      	<input type="date" name="date_ini" class="form-control" required="required" placeholder="Fecha de inicio para la Programación" title="Fecha de inicio para la Programación" v-model="assignment.date_ini" :min="date_min">
		                    </div>
                  		</div>
                	</div>
                	<table class="table table-hover table-hover-animation mb-0">
                		<thead>
                			<th>Nº de Cédula</th>
                			<th>Nombre</th>
                			<th>Teléfono</th>
                			<th>Inicia de</th>
                			<th></th>
                		</thead>
                		<tbody>
                			<tr v-for="(vi, index) in assignment.list_watchmen">
                				<td>{{ vi.dni }}</td>
                				<td>{{ vi.name }}</td>
                				<td>{{ vi.phone }}</td>
                				<td>
                					<template v-if="vi.start == 'D'">Día</template>
                					<template v-if="vi.start == 'N'">Noche</template>
                					<template v-if="vi.start == 'X'">Descanso</template>
                				</td>
                				<td><button type="button" class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light" v-on:click="assignment.list_watchmen.splice(index,1)"><i class="fa fa-trash"></i></button></td>
                			</tr>
                		</tbody>
                	</table>
                </template>
			</div>
		</div>
		<!-- /.card-body -->
		<div class="card-footer">
			<div class="row" v-if="assignment.list_watchmen.length > 0">
				<div class="col-12 col-sm-8 col-md-10 col-lg-10">
					<button type="button" class="btn btn-info mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true" data-toggle="modal" data-target="#modal-preview">
						Vista previa de programación
					</button>
				</div>
				<div class="col-12 col-sm-4 col-md-2 col-lg-2">
					<button type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true" v-on:click="save()">
                        <template v-if="!loading">
                            <i class="fa fa-sign-in"></i> Guardar cambios
                        </template>
                        <template v-if="loading">
                            <i class="fa fa-spinner fa-spin"></i>
                        </template>
                    </button>
				</div>
			</div>
		</div>
		<!-- /.card-footer-->
	</div>
	<!-- /.card -->
	<!-- Modal -->
	<div class="modal modal-right fade" id="modal-preview" tabindex="-1" >
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Vista previa de la programación</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body table-responsive">
					<table class="table table-hover table-hover-animation mb-0">
                		<thead>
                			<th>Días</th>
                			<th v-for="d in days_preview">{{ d }}</th>
                		</thead>
                		<tbody>
                			<tr v-for="(vi, index) in assignment.list_watchmen">
                				<th>{{ vi.name }}</th>
                				<td v-for="pv in programationVigilant(vi)">{{ pv }}</td>
                			</tr>
                		</tbody>
                	</table>
				</div>
				<div class="modal-footer modal-footer-uniform">			
					<div class="row">
						<div class="col-12 col-md-12">
							<button type="button" id="form-close-modal" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal -->
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/assignment.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/SeguridadLogro/AppCore/resources/views/admin/assignment-create.blade.php ENDPATH**/ ?>