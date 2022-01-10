<?php $__env->startSection('title'); ?>Medias Mensuales <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Media Mensual <button class="btn btn-sm btn-info" v-on:click="addNew()"><i class="fa fa-plus"></i> Nuevo</button><button class="btn btn-sm btn-secondary ml-3" v-on:click="viewModalImport()"><i class="fa fa-file-import"></i> Importar desde .CSV</button></h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Geocalización</a></li>
					<li class="breadcrumb-item active">Media Mensual</li>
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
						<h3 class="card-title mb-3">Listado de medias mensuales</h3>
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
									<td>{{ row.station.name }}</td>
									<td>{{ row.average }}</td>
									<td>{{ row.date }}</td>
									<td>{{ row.precipitation_sumatory }}</td>
									<td>{{ row.annual_standard }}</td>
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
							<strong>(*)</strong> <label for="title">Estación: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-street-view"></i></span>
									</div>
									<select name="station_id" id="select2" class="form-control" style="width: 96%;">
										<option value="">-- Seleccionar --</option>
										<option v-for="station in stations" :value="station.id">{{ station.name }}</option>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="average">Media: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-percent"></i></span>
									</div>
									<input type="number" min="0" class="form-control" id="average" name="average" placeholder="Introducir media" v-model="element.average">
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="date">Fecha: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
									</div>
									<input type="month" class="form-control" id="date" name="date" placeholder="Seleccionar la fecha" v-model="element.date">
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="precipitation_sumatory">Sumatoría de precipitación: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
									</div>
									<input type="number" min="0" class="form-control" id="precipitation_sumatory" name="precipitation_sumatory" placeholder="Introducir la sumatoría de precipitación" v-model="element.precipitation_sumatory">
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<strong>(*)</strong> <label for="annual_standard">Normas Anual: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
									</div>
									<input type="number" min="0" class="form-control" id="annual_standard" name="annual_standard" placeholder="Introducir la el resultado para las normas auales." v-model="element.annual_standard">
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

<!-- IMPORTAR DATOS -->
<div class="modal fade" id="modal-import">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form role="form" id="form_import" onsubmit="return false;" v-on:submit="importFile()"  enctype="multipart/form-data">
				<div class="modal-header">
					<h4 class="modal-title">Importar datos</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>					
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-12" id="file_import">
							<label for="file_import">Seleccionar Archivo: </label>
							<input type="file" class="dropify" name="file_import" data-max-file-size="2M" data-allowed-file-extensions="csv xls"/>
						</div>
					</div>
				</div>

				<div class="modal-footer justify-content-between">
					<div class="row" style="width: 100%;">
						<div class="callout callout-info text-left col-12 col-sm-12 col-md-12">
							<p><label>Puede descargar el archivo con el formato necesario para la importación desde el siguiente buton <a href="javascript:void(0)" v-on:click="getImportFile('<?php echo e(route('monthly_average.getFileImport')); ?>')">
								<template v-if="!loading">
									<button type="button" class="btn btn-sm btn-secondary ml-3 mr-3"><i class="fa fa-download"></i> DESCARGAR AQUI</button>
								</template>
								<template v-if="loading">
									<button type="button" class="btn btn-sm btn-secondary ml-3 mr-3"><i class="fa fa-spinner fa-spin"></i></button>
								</template>
								</a> si no lo posee</label></p>
							<p><label>Debe rellenar los campos del archivos correctamente para importar los datos sin errores, debe tomar en cuenta el codigo de la estación que tiene registrado en el sistema, ya que debe coincidir con el del ingresado en la columna correspondiente del archivo.</label></p>
							<p class="text-danger"><b>IMPORTANTE: </b>No debe modificar la cabecera del archivo.</p>
						</div>
						<div class="col-12 col-md-12 col-sm-12 col-lg-12">
							<button type="button" class="btn btn-default float-left" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary float-right" :disabled="loading == true">
								<template v-if="!loading">
									<i class="fa fa-file-import"></i> Importar
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
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/monthly_average.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/icg/AppCore/resources/views/admin/monthlyAverage.blade.php ENDPATH**/ ?>