<?php $__env->startSection('title'); ?>Opciones de la tienda <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Opciones generales de la tienda
	</h1>
	<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="#"><i class="fa fa-shopping-cart"></i> Shop</a></li>
			<li class="active">Opciones</li>
		</ol>
</section>

<!-- Main content -->
<section class="content container-fluid" id="component">

	<form id="form_" enctype="multipart/form-data" onsubmit="return false;">
		<div class="box box-info">
			<div class="overlay" v-if="searching == true">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			<div class="box-header">
				<h3 class="box-title">Editar opciones</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 form-group">
						<strong>(*)</strong> <label for="currency">Moneda: </label>
						<div class="form-group">
							<select class="form-control" name="currency" v-model="options.currency">
								<option v-for="currency in currencys" :value="currency.id">{{ currency.name }} ({{ currency.abbreviation }}) {{ currency.symbol }}</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 form-group">
						<strong>(*)</strong> <label for="currency_position">Posición de la moneda: </label>
						<div class="form-group">
							<select class="form-control" name="currency_position" v-model="options.currency_position">
								<option value="left">Izquierda</option>
								<option value="right">Derecha</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4 form-group">
						<strong>(*)</strong> <label for="thousand_separator">Separador de miles: </label>
						<div class="form-group">
							<input type="text" class="form-control" name="thousand_separator" value="." v-model="options.thousand_separator">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 form-group">
						<strong>(*)</strong> <label for="decimal_separator">Separador de decimales: </label>
						<div class="form-group">
							<input type="text" class="form-control" name="decimal_separator" value="," v-model="options.decimal_separator">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 form-group">
						<strong>(*)</strong> <label for="number_of_decimals">Cantidad de decimales: </label>
						<div class="form-group">
							<input type="number" class="form-control" name="number_of_decimals" value="0" min="0" max="5" v-model="options.number_of_decimals">
						</div>
					</div>
				</div>

				<div class="box-footer clearfix">
					<button type="submit" class="btn btn-primary" id="btn-save" :disabled="sending == true">
						<template id="sending" v-if="!sending">
							<i class="fa fa-save"></i> Guardar cambios
						</template>
						<template id="notSending" v-if="sending">
							<i class="fa fa-spinner fa-spin"></i>
						</template>
					</button>
				</div>
			</div>
		</form>

	</section>

	<?php $__env->stopSection(); ?>

	<?php $__env->startPush('js'); ?>
	<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/shop/options.js')); ?>"></script>
	<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/admin/shop/options.blade.php ENDPATH**/ ?>