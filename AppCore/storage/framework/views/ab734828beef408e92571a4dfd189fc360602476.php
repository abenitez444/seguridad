<?php $__env->startSection('title'); ?>Novedades <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
	<style type="text/css">
		.dropify-wrapper{
			height: 300px;
		}
	</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Novedades</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
					<li class="breadcrumb-item active">Novedades</li>
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
			<h3 class="card-title">Listados de novedades</h3>

			<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('create_novelty')): ?>
			<div class="card-tools">
				<button class="btn btn-primary mr-1 mb-1" @click="addNew()" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus-square"></i> Agregar</button>
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
	                        	<td>
	                        		{{ row.id}}
	                        	</td>
	                        	<td>
	                        		{{ row.type}}
	                        	</td>
	                        	<td>
	                        		<template v-if="row.type != 'Desvinculación' ">
		                        			{{ getClientSelected(row.assignment.clients_id).name }}<br/>
		                        		<label>Programación ID: {{ row.assignment.id }}</label>
	                        		</template>
	                        		<template v-else>
	                        			-----
	                        		</template>
	                        	</td>
	                        	<td>{{ row.vigilant_principal.name }}</td>
	                        	<td>{{ row.date_ini }}</td>
	                        	<td>
	                        		<template v-if="row.type != 'Cambio de Turno' && row.type != 'Desvinculación' ">
	                        			{{ row.date_end }}
	                        		</template>
	                        		<template v-if="row.type == 'Cambio de Turno'">
	                        			{{ row.date_ini }}
	                        		</template>
	                        		<template v-if="row.type == 'Desvinculación'">
	                        			-----
	                        		</template>
	                        	</td>
	                        	<td>
	                        		<template v-if="row.count_watchmen > 1">
	                        			{{ row.vigilant_change.name }}
	                        		</template>
	                        		<template v-else>
	                        			-----
	                        		</template>
	                        	</td>
	                            <td class="text-right" style="width: 10%; white-space: nowrap;">
	                            	<a v-if="row.has_doc" :href="storage_folder+row.url_doc" target="_blank"><button type="button" class="btn btn-icon btn-outline-info mr-1 mb-1 waves-effect waves-light"><i class="fa fa-eye"></i> Ver documento</button></a>
	                            	<button type="button" class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light" v-on:click="view(row, 1)" data-toggle="modal" data-target="#modal-form"><i class="fa fa-eye"></i></button>
	                            	<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('edit_novelty')): ?>
	                                <button v-if="row.type != 'Desvinculación'" type="button" class="btn btn-icon btn-outline-warning mr-1 mb-1 waves-effect waves-light" v-on:click="view(row, null)" data-toggle="modal" data-target="#modal-form"><i class="fa fa-edit"></i></button>
	                                <?php endif; ?>
	                                <?php if(Auth::user()->is_superadmin || Auth::user()->has_role('delete_novelty')): ?>
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
	<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('create_novelty') || Auth::user()->has_role('edit_novelty')): ?>
	<div class="modal modal-right fade" id="modal-form" tabindex="-1" >
		<div class="modal-dialog modal-lg">
			<form onsubmit="return false;" id="form_" class="form form-vertical">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Agregar / Editar</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-body">
                            <div class="row">
                            	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Tipo *</label>
	                                    <div class="input-group mb-3">
	                                        <select class="form-control" name="type" v-model="novelty.type" :disabled="novelty.assignment_id == '' || viewDetailsElement == true" v-on:change="changeType()">
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
	                                        	<option value="Desvinculación">Desvinculación</option>
	                                        </select>
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-file"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                            <template v-if="novelty.type != 'Cambio de Turno' && novelty.type != 'Desvinculación' && novelty.type != ''">
	                            	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Vigilante en puesto *</label>
		                                    <div class="input-group mb-3">
		                                        <select class="form-control" name="vigilant_principal_id" v-model="vigilant_principal_id" v-on:change="changeWatchmen()" :disabled="viewDetailsElement == true">
		                                        	<option value="">-- Seleccionar --</option>
		                                        	<option v-for="w in all_watchmen" :value="w.id" v-if="((w.assignment.length > 0 || w.clients_activated_news.length > 0) && w.is_active == 1 && w.is_delete == 0 && w.i_quit == 0 && w.is_dismissal == 0 && w.is_disconnected == 0) || (action == 'update' && novelty.vigilant_principal.id == w.id)">{{ w.name }}</option>
		                                        </select>
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-user-secret"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Puesto *</label>
		                                    <div class="input-group mb-3">
		                                        <select class="form-control" name="assignment_id" v-model="novelty.assignment_id" :disabled="vigilant_principal_id == '' || viewDetailsElement == true" v-on:change="changeAssignment()">
		                                        	<option value="">-- Seleccionar --</option>
		                                        	<optgroup v-for="c in watchmen_selected.assignment" :label="'Programación ID: ' + c.id">
		                                        		<option  :value="c.id" v-if="(getClientSelected(c.clients_id).is_delete == 0 && clienteInWatchmenSelected(getClientSelected(c.clients_id))) || (action == 'update' && getClientSelected(c.clients_id) != false )"  >{{ getClientSelected(c.clients_id).name }}</option>
		                                        	</optgroup>
		                                        	<option v-if="watchmen_selected.assignment.length == 0" :value="novelty.assignment_id">
	                                        			{{ getClientSelected(novelty.clients_id).name }}
	                                        		</option>                             	
		                                        	<!-- <option v-for="c in clients" :value="c.id" v-if="(c.is_delete == 0 && clienteInWatchmenSelected(c)) || (action.update && novelty.clients_id == c.id)">{{ c.name }}</option>-->
		                                        </select>
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-users"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

	                            	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Desde *</label>
		                                    <div class="input-group mb-3">
		                                        <input type="date" class="form-control" name="date_ini" v-model="novelty.date_ini" :disabled="novelty.assignment_id == '' || viewDetailsElement == true" :min="assignment_selected.date_ini" :max="assignment_selected.date_end">
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-user-clock"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Hasta *</label>
		                                    <div class="input-group mb-3">
		                                        <input type="date" class="form-control" name="date_end" v-model="novelty.date_end" :disabled="novelty.assignment_id == '' || viewDetailsElement == true" :min="assignment_selected.date_ini" :max="assignment_selected.date_end">
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-user-clock"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Vigilante relevo (*)</label>
		                                    <div class="input-group mb-3">
		                                        <select class="form-control" name="vigilant_change_id" required="required" v-model="vigilant_change_id" :disabled="novelty.assignment_id == '' || viewDetailsElement == true ||vigilant_principal_id == ''">
		                                        	<option value="">-- Ninguno --</option>
		                                        	<option v-for="w in all_watchmen" :value="w.id" v-if="(w.is_active == 1 && w.is_delete == 0 && w.i_quit == 0 && w.is_dismissal == 0 && vigilant_principal_id != w.id ) || (action == 'update' && vigilant_principal_id != w.id && vigilant_change_id == w.id)">{{ w.name }}</option>
		                                        </select>
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-user-secret"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

		                            <input type="hidden" name="vigilant_change_id_old" v-model="vigilant_change_id_old">
							        
							        <input type="hidden" class="form-check-input" id="is_active" name="is_active" value="1">

		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                            	<div class="form-group">
		                            		<div class="form-check">
							                    <input type="checkbox" name="has_doc" class="form-check-input" :disabled=" viewDetailsElement == true" v-model="novelty.has_doc" @change="loadDoc()">
							                    <label class="form-check-label" for="has_doc"> Tiene Documento</label>
							                </div>
		                            	</div>
		                            </div>

		                            <template v-if="novelty.has_doc">
		                            	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                        				<div class="form-group">
		                                        <label>Ingrese el documento (Solo archivos con la siguientes extenciones: PNG, JPG, JPEG, PDF, DOCX, CVS, XLSX, XLSM) *</label>
		                                        <div class="position-relative has-icon-left" id="image">
		                                            <input type="file" class="dropify" ref="image" name="image" v-on:change="readFile()" data-allowed-file-extensions="jpg png jpeg pdf docx cvs xlsx xlsm" :disabled="viewDetailsElement == true">
		                                        </div>
		                                    </div>
	                        			</div>
		                            </template>

		                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
		                                <div class="form-group">
		                                    <label>Observación</label>
		                                    <div class="input-group mb-3">
		                                    	<textarea class="form-control" name="details" rows="5" v-model="novelty.details" :disabled="novelty.assignment_id == '' || viewDetailsElement == true"></textarea>
		                                    </div>
		                                </div>
		                            </div>
	                            </template>

	                            <template v-if="novelty.type == 'Cambio de Turno' && novelty.type != 'Desvinculación' && novelty.type != ''">
	                            	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Vigilante *</label>
		                                    <div class="input-group mb-3">
		                                        <select class="form-control" name="vigilant_principal_id" v-model="vigilant_principal_id" v-on:change="changeWatchmen()" :disabled="viewDetailsElement == true">
		                                        	<option value="">-- Seleccionar --</option>
		                                        	<option v-for="w in all_watchmen" :value="w.id" v-if="((w.assignment.length > 0 || w.clients_activated_news.length > 0) && w.is_active == 1 && w.is_delete == 0 && w.i_quit == 0 && w.is_dismissal == 0 && w.is_disconnected == 0) || (action == 'update' && novelty.vigilant_principal.id == w.id)">{{ w.name }}</option>
		                                        </select>
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-user-secret"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Puesto *</label>
		                                    <div class="input-group mb-3">
		                                        <select class="form-control" name="assignment_id" v-model="novelty.assignment_id" :disabled="vigilant_principal_id == '' || viewDetailsElement == true" v-on:change="changeAssignment()">
		                                        	<option value="">-- Seleccionar --</option>
		                                        	<optgroup v-for="c in watchmen_selected.assignment" :label="'Programación ID: ' + c.id">
		                                        		<option  :value="c.id" v-if="(getClientSelected(c.clients_id).is_delete == 0 && clienteInWatchmenSelected(getClientSelected(c.clients_id))) || (action == 'update' && getClientSelected(c.clients_id) != false )"  >{{ getClientSelected(c.clients_id).name }}</option>
		                                        	</optgroup>
		                                        	<template v-if="watchmen_selected.clients_activated_news.length > 0">
		                                        		<optgroup v-for="c in watchmen_selected.clients_activated_news" :value="c.novelty.id" v-if="(c.is_delete == 0 && clienteInWatchmenSelectedNovelty(c)) || (action == 'update' && novelty.news_id == c.novelty.id)" :label="'Novedad ID:' + c.novelty.id" >
			                                        		<option :value="c.novelty.id">{{ c.name }}</option>
			                                        	</optgroup>
		                                        	</template>
		                                        	

		                                        	<!-- <optgroup label="Puestos fijo" v-if="watchmen_selected.clients_activated.length > 0">
		                                        		<option v-for="c in clients" :value="c.id" v-if="(c.is_delete == 0 && clienteInWatchmenSelected(c)) || (action == 'update' && novelty.clients_id == c.id)">{{ c.name }}</option>
		                                        	</optgroup>
		                                        	 -->                            	
		                                        </select>
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-users"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Fecha *</label>
		                                    <div class="input-group mb-3">
		                                        <input type="date" class="form-control" name="date_ini" v-model="novelty.date_ini" :disabled="novelty.assignment_id == '' || viewDetailsElement == true" v-on:change="changeType()" :min="assignment_selected.date_ini" :max="assignment_selected.date_end">
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-user-clock"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Turno del vigilante en el la fecha: {{ novelty.date_ini }}</label>
		                                    <div class="input-group mb-3">
		                                        <input type="text" class="form-control" v-model="shift_vigilant_principal_selected" :disabled="1==1">
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-user-clock"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Doblaje de turno *</label>
		                                    <div class="input-group mb-3">
		                                        <select class="form-control" name="shifts_double" :disabled="viewDetailsElement == true" v-model="novelty.shifts_double">
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

		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Puesto a cubrir*</label>
		                                    <div class="input-group mb-3">
		                                        <select class="form-control" name="clients_id_change" v-model="novelty.clients_id_change" :disabled="viewDetailsElement == true">
		                                        	<option value="">-- Seleccionar --</option>
		                                        	<option v-for="c in clients" :value="c.id" v-if="c.is_delete == 0 && c.is_active == 1">{{ c.name }}</option>
		                                        </select>
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-users"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

			                        <input type="hidden" name="shifts_old" v-model="novelty.shifts_old">
			                        <input type="hidden" name="type" v-model="novelty.type">

		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Turno nuevo *</label>
		                                    <div class="input-group mb-3">
		                                        <select class="form-control" name="shifts_new" v-model="novelty.shifts_new" :disabled="novelty.date_ini == '' || viewDetailsElement == true">
		                                        	<option value="">-- Seleccionar --</option>
		                                        	<option v-if="novelty.shifts_old != 'D' || ( novelty.shifts_double == 'NO' && novelty.clients_id_change != novelty.assignment_clients_id )" value="D">Día</option>
		                                        	<option v-if="novelty.shifts_old != 'N' || ( novelty.shifts_double == 'NO' && novelty.clients_id_change != novelty.assignment_clients_id )" value="N">Noche</option>
		                                        	<option v-if="novelty.shifts_old != 'X' || ( novelty.shifts_double == 'NO' && novelty.clients_id_change != novelty.assignment_clients_id )" value="X">Descanso</option>
		                                        </select>
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-user-clock"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
		                                <div class="form-group">
		                                    <label>Observación</label>
		                                    <div class="input-group mb-3">
		                                    	<textarea class="form-control" name="details" rows="5" v-model="novelty.details" :disabled="novelty.assignment_id == '' || viewDetailsElement == true"></textarea>
		                                    </div>
		                                </div>
		                            </div>
	                            </template>

	                            <template v-if="novelty.type != 'Cambio de Turno' && novelty.type == 'Desvinculación' && novelty.type != ''">
	                            	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Vigilante *</label>
		                                    <div class="input-group mb-3">
		                                        <select class="form-control" name="vigilant_principal_id" v-model="novelty.vigilant_principal.id" @change="changeWatchmen()" :disabled="viewDetailsElement == true">
		                                        	<option value="">-- Seleccionar --</option>
		                                        	<option v-for="w in all_watchmen" :value="w.id" v-if="((w.assignment.length > 0 || w.clients_activated_news.length > 0) && w.is_active == 1 && w.is_delete == 0 && w.i_quit == 0 && w.is_dismissal == 0 && w.is_disconnected == 0) || (action == 'update' && novelty.vigilant_principal.id == w.id)">{{ w.name }}</option>
		                                        </select>
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-users"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Fecha *</label>
		                                    <div class="input-group mb-3">
		                                        <input type="date" class="form-control" name="date_ini" v-model="novelty.date" :disabled="novelty.vigilant_principal.id == '' || viewDetailsElement == true">
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-user-clock"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <input type="hidden" name="type" v-model="novelty.type">
		                            <input type="hidden" name="date_end" v-model="novelty.date_ini">
		                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		                                <div class="form-group">
		                                    <label>Vigilante relevo (*)</label>
		                                    <div class="input-group mb-3">
		                                        <select class="form-control" name="vigilant_change_id" required="required" v-model="vigilant_change_id" :disabled="novelty.assignment_id == '' || viewDetailsElement == true">
		                                        	<option value="">-- Ninguno --</option>
		                                        	<option v-for="w in all_watchmen" :value="w.id" v-if="(w.is_active == 1 && w.is_delete == 0 && w.i_quit == 0 && w.is_dismissal == 0 && vigilant_principal_id != w.id ) || (action == 'update' && vigilant_principal_id != w.id && vigilant_change_id == w.id)">{{ w.name }}</option>
		                                        </select>
		                                        <div class="input-group-append">
		                                            <div class="input-group-text">
		                                                <span class="fas fa-user-secret"></span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
		                            	<div class="form-group">
		                            		<div class="form-check">
							                    <input type="checkbox" name="has_doc" class="form-check-input" v-model="novelty.has_doc" @change="loadDoc()">
							                    <label class="form-check-label" for="has_doc"> Tiene Documento</label>
							                </div>
		                            	</div>
		                            </div>
	                            </template>

	                            

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
					</div>
					<div class="modal-footer modal-footer-uniform">			
						<div class="row">
							<div class="col-12 col-md-12">
								<button type="button" id="form-close-modal" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cerrar</button>
								<button v-if="viewDetailsElement == false" type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true || novelty.assignment_id == ''">
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
	<?php endif; ?>
	<!-- /.modal -->
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/news.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abenitez444/localhost/app/AppCore/resources/views/admin/news.blade.php ENDPATH**/ ?>