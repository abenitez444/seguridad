<?php $__env->startSection('title'); ?>Estaciones <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Estaciones <button class="btn btn-sm btn-info" v-on:click="addNew()"><i class="fa fa-plus"></i> Nuevo</button></h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Geocalización</a></li>
					<li class="breadcrumb-item active">Estaciones</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 cl-md-12 col-lg-12">
				<div class="card">
					<div class="overlay dark" v-if="loading">
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					<div class="card-header">
						<h3 class="card-title mb-3">Listado de Estaciones</h3>
						<div class="card-tools col-md-6 col-12">
							<div class="row">
								<div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
									<div class="input-group input-group-sm">
										<input type="text" name="table_search" class="form-control float-right" placeholder="Filtrar resultados" v-model="filter">
									</div>
								</div>
								<div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
									<div class="input-group input-group-sm">
										<label class="mr-3">Mostrar: </label>
										<select class="form-control float-right" v-model="per_page" v-on:change="changePerPage()">
											<option value="10">10</option>
											<option value="15">15</option>
											<option value="20">20</option>
											<option value="30">30</option>
											<option value="50">50</option>
											<option value="100">100</option>
											<option value="500">500</option>
											<option value="1000">1000</option>
											<option value="all">Todos</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body table-responsive p-0">
						<datatable :columns="columns" :data="rows" :filter-by="filter" class="table table-bordered table-striped">
							<template scope="{ row }" v-if="rows.length > 0">
								<tr>
									<td>
										<img v-if="row.image != null" :src="'<?php echo e(asset('storage')); ?>/' + row.image" style="max-width: 200px;">
									</td>
									<td>
										{{ row.user.name }}<br/>
										{{ row.user.email }}<br/>
									</td>
									<td>{{ row.code }}</td>
									<td>{{ row.name }}</td>
									<td>{{ row.pollutant }}</td>
									<td>{{ row.classification }}</td>
									<td><is-active :is_active="row.is_active"></is-active></td>
									<th class="text-right" style="width: 12%;">
										<button type="button" class="btn btn-warning btn-sm" v-on:click="view(row)"><i class="fa fa-edit"></i></button>
										<button type="button" class="btn btn-danger btn-sm " v-on:click="remove(row)"><i class="fa fa-trash"></i></button>
									</th>
								</tr>
							</template>
						</datatable>
					</div>
					<div class="card-footer clearfix">
						<ul class="pagination pagination-sm m-0 float-right" v-if="rows.length > 0">
							<li class="page-item">
								<a class="page-link" href="javascript:void(0)" v-if="pagination.current_page > 1" v-on:click="changePage(pagination.current_page - 1)">&laquo;</a>
							</li>
							<li class="page-item" v-for="page in pagesNumber" :class="page == isActived ? 'active' : '' ">
								<a class="page-link" href="javascript:void(0)" v-on:click="changePage(page)">{{ page }}</a>
							</li>
							<li class="page-item"><a class="page-link" href="javascript:void(0)" v-if="pagination.current_page < pagination.last_page" v-on:click="changePage(pagination.current_page + 1)">&raquo;</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>
<!-- /.content -->

<!-- NUEVA ELEMENTO -->
<div class="modal fade" id="modal-form">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form role="form" id="form_" onsubmit="return false;"  enctype="multipart/form-data">
				<div class="modal-header">
					<h4 class="modal-title">Agregar & Editar</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>					
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12">
							<strong>(*)</strong> <label for="title">Cliente: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-users"></i></span>
									</div>
									<select name="users_id" id="select2" class="form-control" style="width: 94%;">
										<option value="">-- Seleccionar --</option>
										<option v-for="user in clients" :value="user.id">{{ user.name }}</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="code">Código: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-barcode"></i></span>
									</div>
									<input type="text" class="form-control" id="code" name="code" placeholder="Código de la estación" v-model="station.code" :disabled="action=='update'">
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="title">Nombre: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-header"></i></span>
									</div>
									<input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la estación" v-model="station.name">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="title">Clasificación: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-tags"></i></span>
									</div>
									<select name="classification" class="form-control" v-model="station.classification">
										<option value="">-- Seleccionar --</option>
										<option value="Concentración">Concentración</option>
										<option value="Calidad de Aire">Calidad de Aire</option>
										<option value="Meteorología">Meteorología</option>
									</select>
								</div>
							</div>
						</div>

						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="pollutant">Contaminante: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-bookmark"></i></span>
									</div>
									<select name="pollutant" class="form-control" v-model="station.pollutant">
										<option value="">-- Seleccionar --</option>
										<option value="PST">PST</option>
										<option value="PM10">PM10</option>
										<option value="PM2.5">PM2.5</option>
										<option value="S02">S02</option>
										<option value="N02">N02</option>
									</select>
								</div>
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="sgva">SGVA: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-header"></i></span>
									</div>
									<input type="text" class="form-control" id="sgva" name="sgva" placeholder="SGVA de la estación" v-model="station.sgva">
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="location">Ubicación: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
									</div>
									<input type="text" class="form-control" id="location" name="location" placeholder="Ubicación de la estación" v-model="station.location">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="latitude">Latitud: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-compass"></i></span>
									</div>
									<input type="text" class="form-control" id="latitude" name="latitude" placeholder="Escriba la Latitud de la estación, este dato es para la muestra del mapa." v-model="station.latitude">
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="longitude">Longitud: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-compass"></i></span>
									</div>
									<input type="text" class="form-control" id="longitude" name="longitude" placeholder="Escriba la Longitud de la estación, este dato es para la muestra del mapa." v-model="station.longitude">
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12">
							<strong>(*)</strong> <label for="address">Dirección detallada: </label>
							<div class="form-group">		
								<textarea class="form-control" id="address" name="address" placeholder="Dirección de la estación" rows="6" v-model="station.address"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-12" id="image">
							<strong>(*)</strong> <label for="image">Imagen principal: </label>
							<input type="file" class="dropify" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg"/>
						</div>
						<div class="col-6 col-sm-4 col-md-4 col-lg-4">
							<label for="title">Estado: </label>
							<div class="form-group">
								<div class="checkbox icheck pl-20" >
									<label>
										<input type="checkbox" name="is_active" value="1" checked="checked" v-model="station.is_active" > Activar
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<div class="row" style="width: 100%;">
						<div class="callout callout-info text-left col-12 col-sm-12 col-md-12">
							<label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label>
						</div>
						<div class="col-12 col-md-12 col-sm-12 col-lg-12">
							<button type="button" class="btn btn-default float-left" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary float-right" :disabled="loading == true">
								<template v-if="!loading">
									<i class="fa fa-save"></i> Guardar cambios
								</template>
								<template v-if="loading">
									<i class="fa fa-spinner fa-spin"></i>
								</template>
							</button>
						</div>
					</div>					
				</div>
			</form>
		</div>
	</div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/select2/dist/js/select2.full.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/stations.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/icg/AppCore/resources/views/admin/stations.blade.php ENDPATH**/ ?>