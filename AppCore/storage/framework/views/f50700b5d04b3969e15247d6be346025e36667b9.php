<?php $__env->startSection('title'); ?>Programaciones <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<!-- fullCalendar -->
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/fullcalendar/main.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/fullcalendar-daygrid/main.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/fullcalendar-timegrid/main.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/fullcalendar-bootstrap/main.min.css')); ?>">

<style type="text/css">
	.fc-time-grid-container {
		display: none !important;
	}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Listados de Programación</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
					<li class="breadcrumb-item active">Programación</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content" id="app-main">

	<!-- Default box -->
	<div class="card">
        <div class="overlay dark" v-if="loading">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
		<div class="card-header">
			<h3 class="card-title">Listados de programación</h3>

            <?php if(Auth::user()->is_superadmin || Auth::user()->has_role('list_programming') || Auth::user()->has_role('edit_programming')): ?>
			<div class="card-tools">
				<a href="<?php echo e(route('admin.assignment.create')); ?>"><button class="btn btn-primary mr-1 mb-1"><i class="fa fa-plus-square"></i> Agregar / Editar</button></a>
			</div>
            <?php endif; ?>
		</div>
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-12 col-sm-12 col-md-6 col-lg-6"></div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12">
                                    Filtrar: 
                                </div>
                            </div>
                            <input type="text" name="filter" v-model="filter" class="form-control" placeholder="Escriba para filtrar los resultados">
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12">
                                    Mostrar: 
                                </div>
                            </div>
                            <select class="form-control" v-model="pagination.per_page" v-on:change="getAllWithPagination()">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="300">300</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                                <option :value="pagination.total+1">Todo</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row table-responsive mt-1">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                	<datatable class="table table-hover table-hover-animation mb-0" :columns="columns" :data="rows" :filter="filter">
	                    <template slot-scope="{ row }">
	                        <tr>
	                            <td class="text-center">{{ row.id }}</td>
	                            <td class="text-center">{{ row.client.name }}</td>
	                            <td class="text-center">{{ row.num_watchmen }}</td>

                                <template v-if="row.client.type_of_programming == 1">
                                    <td class="text-center">{{ row.client.shift.name }}</td>
                                </template>
                                <template v-if="row.client.type_of_programming == 2">
                                    <td class="text-center">
                                        <span class="badge badge-info badge-pill mr-1 mt-1" v-for="(s, index) in row.client.shifts_selected">{{ s.name }} </span>
                                    </td>
                                </template>

                                <td class="text-center">{{ row.date_ini }}</td>
	                            <td class="text-center">{{ row.date_end }}</td>
	                            <td class="text-right" style="width: 20%; white-space: nowrap;">
                                    <button type="button" class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light" data-toggle="modal" data-target="#modal-list-watchmen" v-on:click="viewListWatchmen(row)"><i class="fas fa-user-secret"></i> Ver Vigilantes</button>
	                                <button type="button" class="btn btn-icon btn-outline-info mr-1 mb-1 waves-effect waves-light" data-toggle="modal" data-target="#modal-calendar" v-on:click="viewCalendar(row)"><i class="fa fa-calendar"></i> Ver calendario</button>
                                    <?php if(Auth::user()->is_superadmin || Auth::user()->has_role('delete_programming')): ?>
	                                <button type="button" class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light" v-on:click="removeItem(row)"><i class="fa fa-trash"></i></button>
                                    <?php endif; ?>
	                            </td>
	                        </tr>
	                    </template>
	                </datatable>
	                <nav aria-label="Page navigation example">
	                    <ul class="pagination justify-content-center mt-2">
	                        <li class="page-item prev-item" v-if="pagination.current_page > 1" v-on:click="changePage(pagination.current_page - 1)">
	                            <a class="page-link" href="javascript:void(0)">
	                                <i class="feather icon-chevron-left"></i>
	                            </a>
	                        </li>

	                        <li class="page-item" v-for="page in pagesNumber" :class="page == isActived ? 'active' : '' " aria-current="page"><a class="page-link" href="javascript:void(0)" v-on:click="changePage(page)">{{ page }}</a></li>
	                        
	                        <li class="page-item next-item">
	                            <a class="page-link" href="javascript:void(0)" v-if="pagination.current_page < pagination.last_page" v-on:click="changePage(pagination.current_page + 1)">
	                                <i class="feather icon-chevron-right"></i>
	                            </a>
	                        </li>
	                    </ul>
	                </nav>
                </div>
            </div>
		</div>
		<!-- /.card-body -->
		<!-- <div class="card-footer">
			Footer
		</div>-->
		<!-- /.card-footer-->
	</div>
	<!-- /.card -->
	<!-- Modal -->
	<div class="modal modal-right fade" id="modal-calendar" tabindex="-1" >
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Calendario de Programación</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="card card-primary">
		              	<div class="card-body p-0 table-responsive">
		               		<!-- THE CALENDAR -->
		                	<div id="calendar"></div>
		              	</div>
		              	<!-- /.card-body -->
		            </div>
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

	<!-- Modal -->
	<div class="modal modal-right fade" id="modal-novelty" tabindex="-1" >
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Detalle de novedad <a v-if="novelty.has_doc" :href="storage_folder+novelty.url_doc" target="_blank"><button type="button" class="btn btn-icon btn-outline-info mr-1 mb-1 waves-effect waves-light"><i class="fa fa-eye"></i> Ver documento</button></a></h5>
					<button type="button" class="close" aria-label="Close" v-on:click="reverseCalendar()">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-body">
                        <div class="row">
                        	<div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Puesto</label>
                                    <div class="input-group mb-3">
                                        <input type="text" v-model="client_selected.name" disabled="disabled" class="form-control" />
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-users"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Vigilante en puesto</label>
                                    <div class="input-group mb-3">
                                    	<input type="text" class="form-control" v-model="novelty.vigilant_principal.name" disabled="disabled" />
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-secret"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <div class="input-group mb-3">
                                        <select class="form-control" name="type" v-model="novelty.type" :disabled="1==1">
                                        	<option value="">-- Seleccionar --</option>
                                        	<option value="Incapacidad">Incapacidad</option>
                                        	<option value="Ausencia">Ausencia</option>
                                        	<option value="Permiso remunerado">Permiso remunerado</option>
                                        	<option value="Permiso no remunerado">Permiso no remunerado</option>
                                        	<option value="Licencia de Maternidad">Licencia de Maternidad</option>
                                        	<option value="Licencia de Luto">Licencia de Luto</option>
                                        	<option value="Vacaciones">Vacaciones</option>
                                        	<option value="Sanciones">Sanciones</option>
                                            <option value="Cambio de Turno">Cambio de Turno</option>
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-file"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <template v-if="novelty.type != 'Cambio de Turno'">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Desde</label>
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" v-model="novelty.date_ini" :disabled="1==1">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-clock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Hasta</label>
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" v-model="novelty.date_end" :disabled="1==1">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-clock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Vigilante suplente</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" v-model="novelty.vigilant_change.name" disabled="disabled" />
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-secret"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template v-else>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" name="date_ini" v-model="novelty.date_ini" :disabled="1==1">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-clock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Turno del vigilante en el la fecha: {{ novelty.date_ini }}</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" v-model="novelty.shifts_old" :disabled="1==1">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-clock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Doblaje de turno</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="shifts_double" v-model="novelty.shifts_double" :disabled="1==1">
                                                <option value="">-- Seleccionar --</option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-file"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Puesto a cubrir</label>
                                        <div class="input-group mb-3">
                                            <input type="text" v-model="novelty.clients_change.name" disabled="disabled" class="form-control" />
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-users"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Turno nuevo *</label>
                                        <div class="input-group mb-3">
                                            <input type="text" v-model="novelty.shifts_new" disabled="disabled" class="form-control" />
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user-clock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </template>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Observación</label>
                                    <div class="input-group mb-3">
                                    	<textarea class="form-control" v-model="novelty.details" :disabled="1==1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				<div class="modal-footer modal-footer-uniform">			
					<div class="row">
						<div class="col-12 col-md-12">
							<button type="button" id="form-close-modal" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" v-on:click="reverseCalendar()">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal -->

    <!-- Modal -->
    <div class="modal modal-right fade" id="modal-list-watchmen" tabindex="-1" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Listado de Vigilantes en programación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- <h5>Listado de Vigilantes asignados</h5> -->
                        </div>
                        
                        <div class="col-12 col-sm-12 col-md-12 table-responsive">
                            <datatable class="table table-hover table-hover-animation mb-0" :columns="columns_actived" :data="assignment.watchmen" :filter="filter_activated">
                                <template slot-scope="{ row }">
                                    <tr>
                                        <td class="text-center">{{ row.dni }}</td>
                                        <td class="text-center">{{ row.name }}</td>
                                        <td class="text-center">{{ row.phone }}</td>
                                        <td class="text-center">{{ row.shift.name }}</td>
                                        <td class="text-center">
                                            <template v-if="row.pivot.start == 'D'">Día</template>
                                            <template v-if="row.pivot.start == 'N'">Noche</template>
                                            <template v-if="row.pivot.start == 'X'">Descanso</template>
                                        </td>
                                        <td class="text-center">
                                            <input type="date" class="form-control" v-model="row.pivot.date_ini" :disabled="1 == 1" :min="assignment.date_ini" :max="assignment.date_end">
                                        </td>
                                    </tr>
                                </template>
                            </datatable>
                        </div>  
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-uniform">         
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <button  type="button" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cerrar</button>
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
<script src="<?php echo e(asset('AppResources/plugins/fullcalendar/main.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/fullcalendar/locales/es.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/fullcalendar-daygrid/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/fullcalendar-timegrid/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/fullcalendar-interaction/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/fullcalendar-bootstrap/main.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/assignment-list.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/programacionlogr/public_html/AppCore/resources/views/admin/assignment.blade.php ENDPATH**/ ?>