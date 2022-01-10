<?php $__env->startSection('title'); ?>Puestos <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Puestos</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
					<li class="breadcrumb-item active">Puestos</li>
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
			<h3 class="card-title">Listados de puestos</h3>

			<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('create_client')): ?>
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
	                            <td class="text-center">{{ row.name }}</td>
	                            <td class="text-center">{{ row.email }}</td>
	                            <td class="text-center">{{ row.phone }}</td>
	                            <td class="text-center">{{ row.name_person }}</td>
	                            <td class="text-center">{{ row.salary }}</td>
	                            <!-- <td class="text-center">{{ row.num_watchmen }}</td> -->
	                            <template v-if="row.type_of_programming == 1">
	                            	<td class="text-center">{{ row.shift.name }}</td>
	                            </template>
	                            <template v-if="row.type_of_programming == 2">
	                            	<td class="text-center">
	                            		<span class="badge badge-info badge-pill mr-1 mt-1" v-for="(s, index) in row.shifts_selected">{{ s.name }} </span>
	                            	</td>
	                            </template>
	                            <td class="text-center">
	                                <is-active :is_active="row.is_active"></is-active>
	                            </td>
	                            <td class="text-right" style="width: 10%; white-space: nowrap;">
	                            	<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('edit_client')): ?>
	                                <button type="button" class="btn btn-icon btn-outline-warning mr-1 mb-1 waves-effect waves-light" v-on:click="view(row)" data-toggle="modal" data-target="#modal-form"><i class="fa fa-edit"></i></button>
	                                <?php endif; ?>
	                                <?php if(Auth::user()->is_superadmin || Auth::user()->has_role('delete_client')): ?>
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
	<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('create_client') || Auth::user()->has_role('edit_client')): ?>
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
	                                    <label>Razón Social *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="text" class="form-control" placeholder="Ingrese la razón del social del puesto" name="name" v-model="client.name">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-user"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Email *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="email" class="form-control" placeholder="Ingrese email del puesto" name="email" v-model="client.email">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-envelope"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Teléfono *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="text" class="form-control" placeholder="Ingrese el número de Teléfono del puesto" name="phone" v-model="client.phone">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-phone"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Persona de Contacto *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="text" class="form-control" placeholder="Ingrese el nombre completo de la persona encargada del puesto" name="name_person" v-model="client.name_person">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-user"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Salario *</label>
	                                    <div class="input-group mb-3">
	                                        <money type="text" class="form-control" name="salary" v-model="client.salary" v-bind="money"></money>
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-money-check-alt"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Cantidad de Vigilantes *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="number" min="1" class="form-control" name="num_watchmen" v-model="client.num_watchmen"></input>
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-id-card-alt"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Tipo de programación *</label>
	                                    <div class="input-group mb-3">
	                                        <select class="form-control" name="type_of_programming" v-model="client.type_of_programming">
	                                        	<option value="">-- Seleccionar --</option>
	                                        	<option value="1">Unica</option>
	                                        	<option value="2">Multiple</option>
	                                        </select>
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-user-clock"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6" v-if="client.type_of_programming == '' || client.type_of_programming == 1">
	                                <div class="form-group">
	                                    <label>Programación *</label>
	                                    <div class="input-group mb-3">
	                                        <select class="form-control" name="shifts_id" v-model="client.shifts_id" :disable="client.type_of_programming == ''">
	                                        	<option value="">-- Seleccionar --</option>
	                                        	<option v-for="s in shifts" :value="s.id">{{ s.name }}</option>
	                                        </select>
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-user-clock"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6" v-if="client.type_of_programming == 2">
	                                <div class="form-group">
	                                    <label>Seleccione los turnos para el puesto *</label>
	                                    <div class="input-group mb-3">
	                                        <select class="form-control" name="shifts_selected" v-model="shift_selected" :disable="client.type_of_programming == ''" v-on:change="addShifts()">
	                                        	<option value="">-- Seleccionar --</option>
	                                        	<option v-for="s in shifts" :value="s.id" v-if="inListShiftsSelected(s) == false">{{ s.name }}</option>
	                                        </select>
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-user-clock"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="input-group mb-3">
	                                    	<span class="badge badge-info badge-pill mr-1 mt-1" v-for="(s, index) in client.shifts_selected">{{ s.name }} <a href="javascript:void(0)" v-on:click="client.shifts_selected.splice(index,1)">&times;</a> </span>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                                <div class="form-group">
	                                    <label>Dirección *</label>
	                                    <div class="input-group mb-3">
	                                        <textarea class="form-control" name="address" v-model="client.address"></textarea>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                            	<div class="form-group">
	                            		<div class="form-check">
						                    <input type="checkbox" class="form-check-input" id="is_active" v-model="client.is_active">
						                    <label class="form-check-label" for="is_active"> Activo</label>
						                </div>
	                            	</div>
	                            </div>
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
								<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true">
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
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/v-money-master/dist/v-money.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/clients.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/programacionlogr/public_html/AppCore/resources/views/admin/clients.blade.php ENDPATH**/ ?>