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
        <div class="overlay dark" v-if="loading">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
		<div class="card-header">
			<h3 class="card-title">Asignación de vigilantes a puestos</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-sm-4 col-md-2 col-lg-2">
                    <div class="form-group">
                        <label>Tipo de asignación *</label>
                        <div class="input-group mb-4">
                            <select class="form-control" v-on:change="changeType()" v-model="assignment.type">
                            	<option value="">-- Seleccionar --</option>
                                <?php if(Auth::user()->is_superadmin || Auth::user()->has_role('create_programming')): ?>
                            	<option value="nuevo">Nueva</option>
                                <?php endif; ?>
                                <?php if(Auth::user()->is_superadmin || Auth::user()->has_role('edit_programming')): ?>
                            	<option value="reemplazo">Editar existente</option>
                                <?php endif; ?>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-clock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <template v-if="assignment.type == 'reemplazo'">
                    <div class="col-12 col-sm-4 col-md-3 col-lg-3" v-if="clients.length > 0">
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
                    <div class="col-12 col-sm-4 col-md-3 col-lg-3" v-if="clients.length > 0">
                        <div class="form-group">
                            <label>Programación *</label>
                            <div class="input-group mb-3">
                                <select class="form-control" v-model="assignment_selected" :disabled="assignment.clients_id == ''">
                                    <option value="">-- Seleccionar --</option>
                                    <optgroup v-for="assig in client_selected.assignments" :label="'ID: '+ assig.id">
                                        <option :value="assig.id">{{ assig.date_ini }} - {{ assig.date_end }}</option>
                                    </optgroup>
                                    
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user-clock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-3 col-lg-3" v-if="clients.length > 0">
                        <div class="form-group">
                            <label>Programación *</label>
                            <div class="input-group mb-3">
                                <template v-if="client_selected.type_of_programming == 1">
                                    <input type="text" class="form-control" v-model="client_selected.shift.name" disabled="disabled">
                                </template>
                                <template v-if="client_selected.type_of_programming == 2">
                                    <input type="text" class="form-control" disabled="disabled" value="Multiple Turnos">
                                </template>
                                <template v-if="client_selected.type_of_programming == false">
                                    <input type="text" class="form-control" disabled="disabled" value="">
                                </template>
                               
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user-clock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-12 col-sm-6 col-md-2 col-lg-2" v-if="clients.length > 0">
                        <div class="form-group">
                            <label>Vigilantes *</label>
                            <div class="input-group mb-3">
                               <input type="text" class="form-control" v-model="client_selected.num_watchmen" disabled="disabled">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user-secret"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-12 col-sm-6 col-md-2 col-lg-1 mb-1" v-if="clients.length > 0">
                        <div class="form-group">
                            <label></label>
                            <div class="input-group mb-3 mt-2">
                                <button type="button" class="btn btn-info mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true || assignment.clients_id == '' || assignment_selected == ''" v-on:click="startassignment()">
                                    INICIAR
                                </button>
                            </div>
                        </div>
                    </div>
                </template>

                <template v-if="assignment.type != '' && assignment.type == 'nuevo'">
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>Fecha de inicio: </label>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" v-model="assignment.date_ini">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>Fecha de cierre: </label>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" v-model="assignment.date_end">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 mb-1">
                        <div class="form-group">
                            <label></label>
                            <div class="input-group mb-3 mt-2">
                                <button type="button" class="btn btn-info mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true || assignment.date_ini == '' || assignment.date_end == '' || assignment.type == ''" v-on:click="getAvailableClients()" style="font-size: 12px;">
                                    <i class="fa fa-search"></i> BUSCAR PUESTOS DISPONIBLES
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 col-md-3 col-lg-3" v-if="clients.length > 0">
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
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3" v-if="clients.length > 0">
                        <div class="form-group">
                            <label>Programación *</label>
                            <div class="input-group mb-3">
                                <template v-if="client_selected.type_of_programming == 1">
                                    <input type="text" class="form-control" v-model="client_selected.shift.name" disabled="disabled">
                                </template>
                                <template v-if="client_selected.type_of_programming == 2">
                                    <input type="text" class="form-control" disabled="disabled" v-model="client_selected.type_programming_text">
                                </template>
                                <template v-if="client_selected.type_of_programming != 1 && client_selected.type_of_programming != 2">
                                    <input type="text" class="form-control" disabled="disabled" value="">
                                </template>
                               
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user-clock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3" v-if="clients.length > 0">
                        <div class="form-group">
                            <label>Cantidad de Vigilantes</label>
                            <div class="input-group mb-3">
                                <input type="number" min="1" class="form-control" name="num_watchmen" v-model="client_selected.num_watchmen" disabled="disabled"></input>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card-alt"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3 mb-1" v-if="clients.length > 0">
                        <div class="form-group">
                            <label></label>
                            <div class="input-group mb-3 mt-2">
                                <button type="button" class="btn btn-info mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true || assignment.clients_id == ''" v-on:click="startassignment()">
                                    INICIAR
                                </button>
                            </div>
                        </div>
                    </div>
                </template>

                <template v-if="start && vigilant_selected_replace != null">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 mb-1">
                        <label>Vigilante seleccionado para relevar</label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 mb-1">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Vigilante: </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" disabled="disabled" v-model="vigilant_selected_replace.name">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-users-cog"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Fecha de inicio: </label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" v-model="vigilant_selected_replace.start_date" disabled="disabled">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Turno: </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" v-model="vigilant_selected_replace.shift.name" disabled="disabled">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-clock"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="row">
                                    <div class="col-12 col-sm-7 col-md-7 col-lg-7">
                                        <div class="form-group">
                                            <label>Tipo de Inicio: </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" v-model="vigilant_selected_replace.start" disabled="disabled">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-users-cog"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                                        <div class="form-group">
                                            <label></label>
                                            <div class="input-group mb-3">
                                                <button  type="button" class="btn btn-danger ml-1 mb-1 mt-2 waves-effect waves-light float-right" v-if="vigilant_selected_replace != null" v-on:click="reverseReplace()">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <template v-if="start && this.assignment.list_watchmen.length < client_selected.num_watchmen">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                		<div class="row">
                			<div class="col-12 col-sm-6 col-md-3 col-lg-3">
				                <div class="form-group">
				                    <label>Selecciona el Vigilante *</label>
				                    <div class="input-group mb-3">
				                        <select class="form-control" v-model="vigilant_selected" v-on:change="changeVigilantSelected()">
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

                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Fecha de inicio:</label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" v-model="start_date_vigilant" :disabled="vigilant_selected == ''" :min="assignment.date_ini" :max="assignment.date_end">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md39 col-lg-3">
                                <div class="form-group">
                                    <label>Selecciona el turno *</label>
                                    <div class="input-group mb-3">
                                        <select class="form-control" v-model="shift_selected" :disabled="vigilant_selected == ''" v-if="client_selected.type_of_programming == 2">
                                            <option value=""> -- Seleccionar -- </option>
                                            <option v-for="shift in client_selected.shifts_selected" :value="shift.id">{{ shift.name }}</option>
                                        </select>
                                        <select class="form-control" v-model="shift_selected" v-if="client_selected.type_of_programming == 1">
                                            <option :value="client_selected.shift.id"> {{ client_selected.shift.name }} </option>
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-clock"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="row">
                                    <div class="col-12 col-sm-7 col-md-9 col-lg-9">
                                        <div class="form-group">
                                            <label>Selecciona el inicio *</label>
                                            <div class="input-group mb-3">
                                                <select class="form-control" v-model="start_vigilant" :disabled="vigilant_selected == '' || shift_selected == '' ">
                                                    <option value=""> -- Seleccionar -- </option>
                                                    <option value="D" v-if="shift_selected != 4 && shift_selected != 7 && shift_selected != 9 && shift_selected != 11 && shift_selected != 12">Día</option>
                                                    <option value="N" v-if="shift_selected != 5 && shift_selected != 6 && shift_selected != 8 && shift_selected != 10">Noche</option>
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

                                    <div class="col-12 col-sm-5 col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label></label>
                                            <div class="input-group mb-3">
                                                <button type="button" class="btn btn-secondary mr-1 mb-1 mt-2 waves-effect waves-light float-right" :disabled="loading == true || vigilant_selected == '' || start_vigilant == '' || start_date_vigilant == '' || shift_selected == ''" v-on:click="addVigilant()">
                                                    <i class="fa fa-plus-square"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                		</div>
                	</div>
                </template>

                <!-- LISTADO DE VIGILANTES ACTIVOS EN LA PROGRAMACION -->
                <template v-if="assignment.list_watchmen.length > 0 && start">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 mb-3">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-12 col-sm-6 col-md-12 col-lg-7 col-form-label">Fecha de inicio para la programación:</label>
                                    <div class="col-12 col-sm-6 col-md-12 col-lg-5">
                                        <input type="date" name="date_ini" class="form-control" required="required" placeholder="Fecha de inicio para la Programación" title="Fecha de inicio para la Programación" v-model="assignment.date_ini" :min="date_min" v-if="assignment.type == 'nuevo'">
                                        <input type="date" class="form-control" placeholder="Fecha de inicio para la Programación" title="Fecha de inicio para la Programación" v-model="assignment.date_ini" disabled="disabled" :min="date_min" v-else>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-12 col-sm-6 col-md-12 col-lg-7 col-form-label">Fecha de cierre para la programación:</label>
                                    <div class="col-12 col-sm-6 col-md-12 col-lg-5">
                                        <input type="date" name="date_end" class="form-control" required="required" placeholder="Fecha de cierre para la Programación" title="Fecha de cierre para la Programación" v-model="assignment.date_end" :min="date_min">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <h5>Listado de Vigilantes asignados</h5>
                    </div>
                    
                    <div class="col-12 col-sm-12 col-md-12 table-responsive">
                        <datatable class="table table-hover table-hover-animation mb-0" :columns="columns_actived" :data="assignment.list_watchmen" :filter="filter_activated">
                            <template slot-scope="{ row }">
                                <tr>
                                    <td class="text-center">{{ row.dni }}</td>
                                    <td class="text-center">{{ row.name }}</td>
                                    <td class="text-center">{{ row.phone }}</td>
                                    <td class="text-center">{{ row.shift.name }}</td>
                                    <td class="text-center">
                                        <template v-if="row.start == 'D'">Día</template>
                                        <template v-if="row.start == 'N'">Noche</template>
                                        <template v-if="row.start == 'X'">Descanso</template>
                                    </td>
                                    <td class="text-center">
                                        <input type="date" class="form-control" v-model="row.start_date" :disabled="row.activated == 1" :min="assignment.date_ini" :max="assignment.date_end">
                                    </td>
                                    <td class="text-right" style="width: 5%; white-space: nowrap;">
                                        <template v-if="assignment.type=='nuevo'">
                                            <button type="button" class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light" v-on:click="removeOfList(row.id)" v-if="vigilant_selected_replace == null">ELIMINAR</button>
                                        </template>
                                        <template v-else>
                                            <template v-if="row.activated == 1">
                                                <button type="button" class="btn btn-icon btn-outline-info mr-1 mb-1 waves-effect waves-light" v-on:click="removeOfList(row.id)" v-if="vigilant_selected_replace == null">RELEVAR</button>
                                            </template>
                                            <template v-else>
                                                <button type="button" class="btn btn-icon btn-outline-warning mr-1 mb-1 waves-effect waves-light" v-on:click="cancelChange(row.id)" v-if="vigilant_selected_replace == null && row.replace_watchmen != null">CANCELAR RELEVO</button>
                                                <button type="button" class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light" v-on:click="removeOfList(row.id)" v-else="vigilant_selected_replace == null">ELIMINAR</button>
                                            </template>
                                            
                                            <button type="button" class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light" v-on:click="removeOfListPermanent(row.id)" v-if="vigilant_selected_replace == null && row.activated == 1">ELIMINAR</button>
                                        </template>                                        
                                    </td>
                                </tr>
                            </template>
                        </datatable>
                    </div>                    
                </template>
			</div>
		</div>
		<!-- /.card-body -->
		<div class="card-footer">
			<div class="row" v-if="assignment.list_watchmen.length > 0 && start">
				<div class="col-12 col-sm-8 col-md-10 col-lg-10">
					<button type="button" class="btn btn-info mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true" v-on:click="preview()">
						Vista previa de programación
					</button>
				</div>
				<div class="col-12 col-sm-4 col-md-2 col-lg-2">
					<button type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true || vigilant_selected_replace != null" v-on:click="save()">
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

        <div class="card-body">
            <div class="row">
                <!-- LISTADO DE VIGILANTES INACTIVOS EN LA PROGRAMACION -->
                <template v-if="assignment.list_watchmen_deactivated.length > 0 && start">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <h5>Historial de vigilantes pasados en la programación</h5>
                    </div>
                    
                    <div class="col-12 col-sm-12 col-md-12 table-responsive">
                        <datatable class="table table-hover table-hover-animation mb-0" :columns="columns_deactived" :data="assignment.list_watchmen_deactivated" :filter="filter_activated">
                            <template slot-scope="{ row }">
                                <tr>
                                    <td class="text-center">{{ row.dni }}</td>
                                    <td class="text-center">{{ row.name }}</td>
                                    <td class="text-center">{{ row.phone }}</td>
                                    <td class="text-center">{{ row.shift.name }}</td>
                                    <td class="text-center">
                                        <template v-if="row.start == 'D'">Día</template>
                                        <template v-if="row.start == 'N'">Noche</template>
                                        <template v-if="row.start == 'X'">Descanso</template>
                                    </td>
                                    <td class="text-center">
                                        <input type="date" class="form-control" v-model="row.start_date" :disabled="1 == 1" :min="assignment.date_ini" :max="assignment.date_end">
                                    </td>
                                    <td class="text-center">
                                        <input type="date" class="form-control" v-model="row.pivot.date_end" :disabled="1 == 1" :min="assignment.date_ini" :max="assignment.date_end">
                                    </td>
                                </tr>
                            </template>
                        </datatable>
                    </div>                    
                </template>
            </div>
        </div>

        
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
					<table class="table table-hover table-hover-animation table-bordered mb-0">
                		<thead style="background-color:#03637a;">
                			<th>Días</th>
                			<th v-for="d in days_preview">{{ d }}</th>
                		</thead>
                		<tbody>
                			<tr v-for="(vi, index) in assignment.list_watchmen">
                				<th style="white-space: nowrap;">{{ vi.name }}</th>
                                <template v-for="pv in programationVigilant(vi)">
                                    <th v-if="pv == 'D'" style="background-color: #17a2b8;">{{ pv }}</th>
                                    <th v-if="pv == 'N'" style="background-color: #6c757d;">{{ pv }}</th>
                                    <th v-if="pv == 'X'" style="background-color: #28a745;">{{ pv }}</th>
                                    <th v-if="pv == ' '" style="background-color: #ffffff;">{{ pv }}</th>
                                </template>
                				
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
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/assignment.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/programacionlogr/public_html/AppCore/resources/views/admin/assignment-create.blade.php ENDPATH**/ ?>