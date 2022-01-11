<?php $__env->startSection('title'); ?>Empresa <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Empresa</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
					<li class="breadcrumb-item active">Empresa</li>
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
			<h3 class="card-title">Listados de empresas</h3>

			<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('create_agency')): ?>
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
	                            <td class="text-center"></td>
	                            <td class="text-center"></td>
	                            <td class="text-center"></td>
	                            <td class="text-center"></td>
	                            <td class="text-center">
	                                <is-active :is_active="row.is_active"></is-active>
	                            </td>
	                            <td class="text-right" style="width: 10%; white-space: nowrap;">
	                            	<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('edit_shifts')): ?>
	                                <button type="button" class="btn btn-icon btn-outline-warning mr-1 mb-1 waves-effect waves-light" v-on:click="view(row)" data-toggle="modal" data-target="#modal-form"><i class="fa fa-edit"></i></button>
	                                <?php endif; ?>
	                                <?php if(Auth::user()->is_superadmin || Auth::user()->has_role('delete_shifts')): ?>
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
	<!--Modal register and edit agency-->
	<?php if(Auth::user()->is_superadmin || Auth::user()->has_role('create_shifts') || Auth::user()->has_role('edit_shifts')): ?>
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
							<template>
							<form enctype="multipart/form-data" id="formImg">
								<v-row>
									<v-col cols="12" md="12" lg="12" class="text-center">
										<v-avatar
										size="130"
										color="grey"
										>
											<v-img :src="previewAvatar"></v-img>
										</v-avatar>
									</v-col>
								</v-row>
								<v-row>
									<v-col cols="12" md="4" lg="4" class="text-center offset-4">
										<v-file-input
											placeholder="Cargar imagen"
											label="Avatar"
											type="file"
											v-on:change="setAvatar"
										></v-file-input>
									</v-col>
								</v-row>
						    </form>	
							</template>
							<div class="row">
								<div class="col-12 col-sm-12 col-md-6 col-lg-6">
									<div class="form-group">
										<label>Nombre empresa *</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" placeholder="Ingrese el nombre de la empresa" name="name_agency" v-model="agency.name_agency">
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fas fa-file-signature"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>RUT</label>
	                                    <div class="input-group mb-3">
	                                        <input type="text"  class="form-control" placeholder="Ingrese el rut de la empresa" name="rut" v-model="agency.rut">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-credit-card"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Email empresa</label>
	                                    <div class="input-group mb-3">
	                                        <input type="email" min="0" class="form-control" placeholder="Ingrese el correo electrónico de la empresa" name="email" v-model="agency.email">
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
	                                    <label>Teléfono empresa</label>
	                                    <div class="input-group mb-3">
	                                        <input type="number" min="11" class="form-control" placeholder="Ingrese teléfono de la empresa" name="local_agency" v-model="agency.local_agency">
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
	                                    <label>Teléfono movil/WhatsApp</label>
	                                    <div class="input-group mb-3">
	                                        <input type="number" min="11" class="form-control" placeholder="Ingrese el movil de la empresa" name="tlf_agency" v-model="agency.tlf_agency">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="fas fa-mobile-alt"></i></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Razón social</label>
	                                    <div class="input-group mb-3">
	                                        <input type="text" class="form-control" placeholder="Ingrese la razón social" name="desc_sociality" v-model="agency.desc_sociality">
	                                        <div class="input-group-append">
	                                            <div class="input-group-text">
	                                                <span class="far fa-file-alt"></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
	                                    <label>Páis</label>
										<div class="input-group mb-3">
										<select class="form-control" name="type" name="country" v-model="agency.country">
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
												<span class="fas fa-globe-europe"></span>
											</div>
										</div>
										</div>
									</div>
	                            </div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-6">
	                                <div class="form-group">
									<label>Estado</label>
									<div class="input-group mb-3">
										<select class="form-control" name="state" v-model="agency.state">
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
												<span class="fas fa-city"></span>
											</div>
										</div>
	                                </div>
	                            </div>
                            </div>
                        </div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12">
							<div class="alert alert-primary" role="alert">
								<h4 class="alert-heading">IMPORTANTE: </h4>
								<p class="mb-0">
									Todos los campos con (*) deben ser completados
								</p>
							</div>
						</div>
					</div>
					<div class="modal-footer modal-footer-uniform">			
						<div class="row">
							<div class="col-12 col-md-12 text-center">
								<button type="button" id="form-close-modal" class="btn btn-danger text-white mr-1 mb-2 waves-effect waves-light" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
								<button type="submit" class="btn btn-primary mr-1 mb-2 waves-effect waves-light" :disabled="loading == true">
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
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/agency.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abenitez444/localhost/app/AppCore/resources/views/admin/agency.blade.php ENDPATH**/ ?>