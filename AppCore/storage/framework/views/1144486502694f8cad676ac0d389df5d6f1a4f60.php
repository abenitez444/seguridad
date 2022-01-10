<?php $__env->startSection('title'); ?>Reportes de Concentracón <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Reportes de Concentración </h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Geocalización</a></li>
					<li class="breadcrumb-item active">Reportes de Concentración</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				<h3 class="card-title mb-3">Seleccione el Parametro de busqueda</h3>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				<form id="form_searh" onsubmit="return false;">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-4 col-lg-4">
							<strong>(*)</strong> <label for="title">Estación: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-street-view"></i></span>
									</div>
									<select name="station_id" id="station" class="form-control" style="width: 88%;">
										<option value="">-- Seleccionar --</option>
										<option v-for="station in stations" :value="station.id">{{ station.name }}</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-2 col-lg-2">
							<strong>(*)</strong> <label for="pollutant">Contaminante: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-bookmark"></i></span>
									</div>
									<input type="text" disabled="disabled" class="form-control" id="pollutant" name="pollutant" placeholder="Contaminante" v-model="station.pollutant">
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-3 col-lg-3">
							<strong>(*)</strong> <label for="date_ini">Desde: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
									</div>
									<input type="date" class="form-control" id="date_ini" name="date_ini" placeholder="Seleccionar la fecha" v-model="form_searh.date_ini">
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-3 col-lg-3">
							<strong>(*)</strong> <label for="date_end">Hasta: </label>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
									</div>
									<input type="date" class="form-control" id="date_end" name="date_end" placeholder="Seleccionar la fecha" v-model="form_searh.date_end">
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6">
							<label for=""></label>
							<div class="form-group">
								<div class="input-group">
									<button type="button" v-on:click="showReport()" class="btn btn-primary float-right" :disabled="loading == true">
										<template v-if="!loading">
											<i class="fa fa-searh"></i> Mostrar Reporte
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
	</div><!-- /.container-fluid -->
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 cl-md-12 col-lg-12">
				<div class="card" v-if="rows.length > 0">
					<div class="overlay dark" v-if="loading">
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-4 col-lg-4">
								<a href="javascript:void(0)" v-on:click="viewSection != 1 ? viewSection = 1 : false"><img src="<?php echo e(asset('img/btn_reportes.png')); ?>" /></a>
							</div>
							<div class="col-12 col-sm-12 col-md-4 col-lg-4">
								<a href="javascript:void(0)" v-on:click="seeGraphics()"><img src="<?php echo e(asset('img/btn_graficos.png')); ?>" /></a>
							</div>
							<div class="col-12 col-sm-12 col-md-4 col-lg-4">
								<a href="javascript:void(0)" v-on:click="downloadReport()"><img src="<?php echo e(asset('img/btn_descargas.png')); ?>" /></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 cl-md-12 col-lg-12">
				<div class="card" v-if="rows.length > 0 && viewSection == 1">
					<div class="overlay dark" v-if="loading">
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					<div class="card-header">
						<h3 class="card-title mb-3">Resultados</h3>
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
									<td>{{ row.sample_number }}</td>
									<td>{{ row.filter_numbers }}</td>
									<td>{{ row.sample_date }}</td>
									<td>{{ row.concentrations }}</td>
									<td>{{ row.temperatures }}</td>
									<td>{{ row.rainfall }}</td>
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
				<div class="card" v-if="rows.length > 0 && (viewSection == 2 || viewSection == 4)">
					<div class="overlay dark" v-if="loading">
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					<div class="card-tools col-md-6 col-12">
							<div class="row">
								<div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3 mt-3 float-right">
									<div class="input-group input-group-sm">
										<label class="mr-3">Tipo de Gráficos: </label>
										<select class="form-control float-right" v-model="typeGraphics" v-on:change="changeGraphics()">
											<option value="1">Individual</option>
											<option value="2">Todos</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					<div class="card-body" v-if="typeGraphics == 1">
						<div class="chart">
							<canvas id="barChart" style="height:300px; min-height:200px"></canvas>
						</div>
					</div>
					<div class="card-body" v-if="typeGraphics == 2">
						<div class="chart">
							<canvas id="barChartAll" style="height:300px; min-height:200px"></canvas>
						</div>
					</div>
				</div>
				<div class="card" v-if="rows.length > 0 && viewSection == 3">
					<div class="overlay dark" v-if="loading">
						<i class="fas fa-2x fa-sync-alt fa-spin"></i>
					</div>
					<div class="card-header">
						<h3 class="card-title mb-3">Reporte PDF</h3>
					</div>
					<div class="card-body table-responsive p-0">
						<iframe id="descFrame" embedded="true" scrolling="auto" name="descFrame" :src="'<?php echo e(asset('/storage/docs/reports/')); ?>/' + urlReport" width="100%" height="600" frameborder="0"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/chart.js/dist/Chart.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/select2/dist/js/select2.full.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vuejs-datatable/dist/vuejs-datatable.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/componentsVue/is-active.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/reports/concentration.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/icg/AppCore/resources/views/admin/reports/concentration.blade.php ENDPATH**/ ?>