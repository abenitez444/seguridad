<?php $__env->startSection('title'); ?>Usuarios <?php $__env->stopSection(); ?>


<?php $__env->startPush('css'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
	<style type="text/css">
		.dropify-wrapper {
			height: 300px !important;
		}
		.dropify-wrapper.touch-fallback{
			height: 300px !important;
		}
		.dropify-wrapper .dropify-message{
			top: 34% !important;
		}

		.dropify-wrapper.touch-fallback .dropify-message{
			padding: 0px !important;
		}
	</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Usuarios</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
					<li class="breadcrumb-item active">Usuarios</li>
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
			<h3 class="card-title">Listados de Usuarios</h3>

			<div class="card-tools">
				<button class="btn btn-primary mr-1 mb-1" @click="addNew()" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus-square"></i> Agregar</button>
			</div>
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
	                        	<td class="text-center">
	                        		<img :src="'<?php echo e(asset('storage/')); ?>/' + row.image" width="100">
	                        	</td>
	                            <td class="text-center">{{ row.dni }}</td>
	                            <td class="text-center">{{ row.name }} {{ row.last_name }}</td>
	                            <td class="text-center">{{ row.email }}</td>
	                            <td class="text-center">{{ row.type }}</td>
	                            <td class="text-center">{{ row.phone }}</td>
	                            <td class="text-center">
	                                <is-active :is_active="row.is_active"></is-active>
	                            </td>
	                            <td class="text-right" style="width: 10%; white-space: nowrap;">
	                                <button type="button" class="btn btn-icon btn-outline-warning mr-1 mb-1 waves-effect waves-light" v-on:click="view(row)" data-toggle="modal" data-target="#modal-form"><i class="fa fa-edit"></i></button>
	                                <button type="button" class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light" v-on:click="removeItem(row)"><i class="fa fa-trash"></i></button>
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
                            	<div class="col-12 col-md-12">
                            		<div class="row">
                            			<div class="col-12-col-sm-12 col-md-6 col-lg-6">
	                        				<div class="form-group">
		                                        <label>Imagén de perfil</label>
		                                        <div class="position-relative has-icon-left" id="image">
		                                            <input type="file" class="dropify" ref="image" name="image" v-on:change="readFile()" data-allowed-file-extensions="jpg png jpeg">
		                                        </div>
		                                    </div>
                            			</div>
                            			<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            				<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				                                <div class="form-group">
				                                    <label>Cédula *</label>
				                                    <div class="input-group mb-3">
				                                        <input type="text" class="form-control" placeholder="Cédula del usuario" name="dni" v-model="user.dni">
				                                        <div class="input-group-append">
				                                            <div class="input-group-text">
				                                                <span class="fas fa-user"></span>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
                            				<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				                                <div class="form-group">
				                                    <label>Nombre *</label>
				                                    <div class="input-group mb-3">
				                                        <input type="text" class="form-control" placeholder="Ingrese nombre del usuario" name="name" v-model="user.name">
				                                        <div class="input-group-append">
				                                            <div class="input-group-text">
				                                                <span class="fas fa-user"></span>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
				                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
				                                <div class="form-group">
				                                    <label>Apellido *</label>
				                                    <div class="input-group mb-3">
				                                        <input type="text" class="form-control" placeholder="Ingrese apellido del usuario" name="last_name" v-model="user.last_name">
				                                        <div class="input-group-append">
				                                            <div class="input-group-text">
				                                                <span class="fas fa-user"></span>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
				                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
				                                <div class="form-group">
				                                    <label>Email *</label>
				                                    <div class="input-group mb-3">
				                                        <input type="email" class="form-control" placeholder="Ingrese email del usuario" name="email" v-model="user.email">
				                                        <div class="input-group-append">
				                                            <div class="input-group-text">
				                                                <span class="fas fa-envelope"></span>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
                            			</div>
                            		</div>
                            	</div>

	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Tipo de usuario *</label>
	                                    <div class="input-group mb-3">
	                                        <select class="form-control" name="type" v-model="user.type">
	                                        	<option value="">-- Seleccionar --</option>
	                                        	<option value="Vigilante">Vigilante</option>
	                                        	<option value="Coordinador">Coordinador</option>
	                                        	<option value="Supervisor">Supervisor</option>
	                                        	<option value="Administrador">Administrador</option>
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
	                                    <label>Teléfono *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="text" class="form-control" placeholder="Ingrese el número de Teléfono del usuario" name="phone" v-model="user.phone">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-phone"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                                <div class="form-group">
	                                    <label>Dirección</label>
	                                    <div class="input-group mb-3">
	                                        <textarea class="form-control" name="address" v-model="user.address" rows="4"></textarea>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                            	<div class="form-group">
	                            		<div class="form-check">
						                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" v-model="user.is_active">
						                    <label class="form-check-label" for="is_active"> Activo</label>
						                </div>
	                            	</div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            	<h5>Contraseña de acceso al sistema</h5>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                            	<div class="form-group">
	                                    <label>Password *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="password" class="form-control" placeholder="Ingrese la contraseña de acceso" id="password" name="password" v-model="user.password" minlength="6" maxlength="10">
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
	                                    <label>Confirmar Password *</label>
	                                    <div class="input-group mb-3">
	                                        <input type="password" class="form-control" placeholder="Confirmar la contraseña de acceso" name="password2" v-model="user.password2" minlength="6" maxlength="10">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-user-secret"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                            <!-- ASIGNAR Y CREAR LOS ROLES -->
	                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            	<h5>Roles permitidos al sistema</h5>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
	                            	<div class="row">
	                            		<div class="col-12 col-sm-6 col-md-3 col-lg-3" v-for="rol in roles">
	                            			<div class="form-group">
			                            		<div class="form-check">
								                    <input type="checkbox" class="form-check-input" name="roles[]" :value="rol.id" :checked="hasRole(rol.id)">
								                    <label class="form-check-label"> {{ rol.description }}</label>
								                </div>
			                            	</div>
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
	<!-- /.modal -->
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/users.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/programacionlogr/public_html/AppCore/resources/views/admin/users.blade.php ENDPATH**/ ?>