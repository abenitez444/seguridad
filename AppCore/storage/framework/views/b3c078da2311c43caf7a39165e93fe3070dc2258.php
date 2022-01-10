<?php $__env->startSection('title'); ?>Dashboard <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard
		<small></small>
		<!-- <button class="btn btn-sm btn-info" v-on:click="addNew()"><i class="fa fa-plus"></i> Nuevo</button> -->
	</h1>
	<ol class="breadcrumb">
		<li class="active">Dashboard</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid" id="component">

	<div class="box box-info">
		<div class="overlay" v-if="searching == true">
			<i class="fa fa-refresh fa-spin"></i>
		</div> 
		<div class="box-header">
			<h3 class="box-title">BLOG</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-aqua">
						<span class="info-box-icon"><i class="fa fa-tags"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Categorías</span>
							<span class="info-box-number">{{ blog.categories }}</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-green">
						<span class="info-box-icon"><i class="fa fa-th-list"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Publicaciones</span>
							<span class="info-box-number">{{ blog.posts }}</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-yellow">
						<span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Comentarios</span>
							<span class="info-box-number">{{ blog.comments }}</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-red">
						<span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Likes</span>
							<span class="info-box-number">{{ blog.likes }}</span>

						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
			</div>

			<!-- INFORMACION DE LA TIENDA -->
			<div class="box-header">
				<h3 class="box-title">TIENDA</h3>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-aqua">
						<span class="info-box-icon"><i class="fa fa-dropbox"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Artículos o productos</span>
							<span class="info-box-number">{{ shop.articles }}</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-green">
						<span class="info-box-icon"><i class="fa fa-tags"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Categorías</span>
							<span class="info-box-number">{{ shop.categories }}</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-yellow">
						<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Marcas</span>
							<span class="info-box-number">{{ shop.brands }}</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-red">
						<span class="info-box-icon"><i class="fa fa-users"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Clientes</span>
							<span class="info-box-number">{{ shop.customers }}</span>

						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
			</div>

			<div class="row">
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>{{ shop.sales.total }}</h3>

							<p>Ventas realizadas</p>
						</div>
						<div class="icon">
							<i class="fa fa-shopping-cart"></i>
						</div>
						<a href="#" class="small-box-footer">
							More info <i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3>{{ shop.sales.success }}</h3>

							<p>Ventas completadas</p>
						</div>
						<div class="icon">
							<i class="fa fa-check"></i>
						</div>
						<a href="#" class="small-box-footer">
							More info <i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3>{{ shop.sales.proccessing }}</h3>

							<p>Ventas en proceso</p>
						</div>
						<div class="icon">
							<i class="fa fa-exclamation-triangle"></i>
						</div>
						<a href="#" class="small-box-footer">
							More info <i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3>{{ shop.sales.canceled }}</h3>

							<p>Ventas canceladas</p>
						</div>
						<div class="icon">
							<i class="fa fa-times"></i>
						</div>
						<a href="#" class="small-box-footer">
							More info <i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<!-- ./col -->
			</div>

			<!-- BAR CHART -->
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Ventas por mes del año 2019</h3>

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
						<!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
					</div>
				</div>
				<div class="box-body">
					<div class="chart">
						<canvas id="barChart" style="height:335px"></canvas>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/chart.js/dist/Chart.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>