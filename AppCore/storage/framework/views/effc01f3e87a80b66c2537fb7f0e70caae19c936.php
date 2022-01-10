<?php $__env->startSection('title'); ?>Crear nuevo artículo <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/dropify/dist/css/dropify.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/bootstrap-fileinput/css/fileinput.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Artículos
			<small>Nuevo</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="#"><i class="fa fa-shopping-cart"></i> Shop</a></li>
			<li><a href="<?php echo e(route('shop.products.index')); ?>"><i class="fa fa-dropbox"></i> Artículos ó productos</a></li>
			<li class="active">Nuevo</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">

		<div class="box box-info">
			<form role="form" enctype="multipart/form-data" id="form_" onsubmit="return false;">
				<div class="box-body">

					<!-- INFORMACION GENERAL DEL PRODUCTO -->
						<div class="row">
							<div class="col-12 col-md-12 pl-30 pr-30">
								<div class="row">
									<div class="col-12 col-md-12">
										<h4 class="box-title text-light-blue">Información general</h4>
									</div>						
								</div>
								<div class="row">
									<div class="col-12 col-sm-12 col-md-6 col-lg-6">
										<strong>(*)</strong> <label for="name">Nombre: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-header"></i></span>
												<input type="text" class="form-control" name="name" placeholder="Nombre del artículo o producto" v-model="article.name">
											</div>
										</div>
									</div>
									<div class="col-12 col-sm-12 col-md-6 col-lg-6">
										<strong>(*)</strong> <label for="reference">Referencia: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-barcode"></i></span>
												<input type="text" class="form-control" name="reference" placeholder="Referencia del artículo o producto" v-model="article.reference">
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-12 col-sm-12 col-md-4 col-lg-4">
										<strong>(*)</strong> <label for="shop_brands_id">Marca: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>
												<select class="form-control" name="shop_brands_id" placeholder="Seleccione una marca" v-model="article.brand.id">
													<option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-12 col-sm-12 col-md-4 col-lg-4">
										<strong>(*)</strong> <label for="shop_categories_id">Categoría: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-tags"></i></span>
												<select class="form-control" name="shop_categories_id" placeholder="Seleccione una categoría" v-model="article.category.id" v-on:change="changeCategory">
													<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-12 col-sm-12 col-md-4 col-lg-4">
										<strong>(*)</strong> <label for="shop_subCategories_id">Sub categoría: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa  fa-cubes"></i></span>
												<select class="form-control" name="shop_subCategories_id" placeholder="Seleccione una sub-categoría" v-model="article.subCategory.id">
													<option v-for="category in subCategories" :value="category.id">{{ category.name }}</option>
													<option v-if="subCategories.length <= 0">Sin sub-categorías disponibles en la categoría seleccionada</option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-12 col-sm-12 col-md-4 col-lg-4">
										<strong>(*)</strong> <label for="stock">Cantidad en stock: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
												<money type="text" class="form-control maskmoney" name="stock" placeholder="Cantidad inicial en stock para el artículo o producto" v-model="article.stock" v-bind="money"></money>
											</div>
										</div>
									</div>
									<div class="col-12 col-sm-12 col-md-4 col-lg-4">
										<strong>(*)</strong> <label for="quantity_min_stock">Cantidad mínima en stock: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
												<money type="text" class="form-control maskmoney" name="quantity_min_stock" placeholder="Cantidad mínima en stock para el artículo o producto" v-model="article.quantity_min_stock" v-bind="money"></money>
											</div>
										</div>
									</div>
									<div class="col-12 col-sm-12 col-md-4 col-lg-4">
										<strong>(*)</strong> <label for="quantity_min_sale">Cantidad mínima de venta: </label>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
												<money type="text" class="form-control maskmoney" name="quantity_min_sale" placeholder="Cantidad mínima de venta para el artículo o producto" v-model="article.quantity_min_sale" v-bind="money"></money>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-12 col-sm-12 col-md-12 col-lg-12">
										<label for="is_active">Estado: </label>
										<div class="form-group">		
											<div class="checkbox icheck pl-20" >
												<label>
													<input type="checkbox" name="is_active" value="1" checked="checked" v-model="article.is_active" > Activar
												</label>
											</div>
										</div>
									</div>
								</div>
	
								<div class="row">
									<div class="col-12 col-sm-12 col-md-12 col-lg-12">
										<label for="description">Descripción: </label>
										<div class="form-group">		
											<textarea class="form-control" name="description" placeholder="Descripción del artículo o producto" rows="10" v-model="article.description"></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-12 col-sm-12 col-md-12 col-lg-12">
										<label for="specifications">Especificaciones: </label>
										<div class="form-group">		
											<textarea class="form-control" name="specifications" placeholder="Especificaciones del artículo o producto" rows="10" v-model="article.specifications"></textarea>
										</div>
									</div>
								</div>
						
							</div>
						</div>
					<!-- INFORMACION GENERAL DEL PRODUCTO -->
					

					<!-- COSTOS Y PRECIOS -->
					<div class="row">
						<div class="col-12 col-md-12 pl-30 pr-30">
							<div class="row">
								<div class="col-12 col-md-12">
									<h4 class="box-title text-light-blue">Costos y precios</h4>
								</div>						
							</div>
							<!-- Impuesto -->
							<div class="row">
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label for="tax_rate">Porcentaje de impuesto (IVA): </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>%</b></span>
											<money type="text" class="form-control calculate" name="tax_rate" placeholder="Valor del porcentaje para el impuesto del artículo o producto" v-model="costs_prices.tax_rate" v-bind="money"></money>
										</div>
									</div>
								</div>
							</div>

							<!-- COSTO -->
							<div class="row">
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label for="gross_cost">Costo bruto (sin IVA): </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>{{ currency.symbol }}</b></span>
											<money type="text" class="form-control calculate" name="gross_cost" placeholder="
											Costo en bruto del artículo o producto" v-bind="money" v-model="costs_prices.gross_cost"></money>
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label>Valor del impuesto (IVA) en compra: </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>{{ currency.symbol }}</b></span>
											<money type="text" class="form-control" name="value_tax" disabled v-model="costs_prices.value_tax" v-bind="money"></money>
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label for="net_cost">Costo Neto (con IVA): </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>{{ currency.symbol }}</b></span>
											<money type="text" class="form-control" name="net_cost" placeholder="
											Costo neto del artículo o producto" v-bind="money" disabled v-model="costs_prices.net_cost" ></money>
										</div>
									</div>
								</div>
							</div>

							<!-- GASTOS FINANCIEROS -->
							<div class="row">
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label for="percentage_financial_costs">Porcentaje de costos financieros: </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>%</b></span>
											<money type="text" class="form-control calculate" name="percentage_financial_costs" placeholder="Porcentaje de los costos financieros del artículo o producto" v-model="costs_prices.percentage_financial_costs" v-bind="money"></money>
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label for="value_financial_costs">Valor de costos financieros: </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>{{ currency.symbol }}</b></span>
											<money type="text" class="form-control calculate" name="value_financial_costs" placeholder="Valor de los costos financieros del artículo o producto" v-model="costs_prices.value_financial_costs" v-bind="money"></money>
										</div>
									</div>
								</div>
							</div>

							<!-- UTILIDAD -->
							<div class="row">
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label for="percentage_utility">Porcentaje de utilidad: </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>%</b></span>
											<money type="text" class="form-control calculate" name="percentage_utility" placeholder="Porcentaje de utilidad (ganancia) para el artículo o producto" v-model="costs_prices.percentage_utility" v-bind="money"></money>
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label for="value_utility">Valor de utilidad: </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>{{ currency.symbol }}</b></span>
											<money type="text" class="form-control" name="value_utility" placeholder="Valor de utilidad (ganancia) para el artículo o producto" v-model="costs_prices.value_utility" v-bind="money" disabled></money>
										</div>
									</div>
								</div>
							</div>

							<!-- PRECIOS -->
							<div class="row">
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label for="gross_price">Precio bruto (sin IVA): </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>{{ currency.symbol }}</b></span>
											<money type="text" class="form-control calculate" name="gross_price" placeholder="
											Precio en bruto del artículo o producto" v-model="costs_prices.gross_price" v-bind="money"></money>
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label for="value_tax">Valor del impuesto (IVA) en venta: </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>{{ currency.symbol }}</b></span>
											<money type="text" class="form-control" placeholder="
											Valor del impuesto en la venta para el artículo o producto" name="value_tax_price" disabled="disabled" v-model="costs_prices.value_tax_price" v-bind="money"></money>
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label for="general_price">Precio Cliente en General: </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>{{ currency.symbol }}</b></span>
											<money type="text" class="form-control calculate" name="general_price" placeholder="
											Precio general del artículo o producto al cliente" v-model="costs_prices.general_price" v-bind="money"></money>
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-12 col-md-4 col-lg-4">
									<strong>(*)</strong> <label for="net_price">Precio Neto (con IVA): </label>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><b>{{ currency.symbol }}</b></span>
											<money type="text" class="form-control calculate" name="net_price" placeholder="
											Precio neto del artículo o producto" v-model="costs_prices.net_price" v-bind="money"></money>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>					
					<!-- COSTOS Y PRECIOS -->

					<!-- IMAGENES -->
					<div class="row">
						<div class="col-12 col-md-12 pl-30 pr-30">
							<div class="row">
								<div class="col-12 col-md-12">
									<h4 class="box-title text-light-blue">Imagen principal y galeria</h4>
								</div>						
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-12 col-12">
									<label for="main_image">Imagen principal del producto </label>
									<input type="file" class="dropify" name="main_image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" />
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 col-md-12 col-12">
									<label for="main_image">Imagenes de la galeria del producto </label>
									<input id="galery_images" type="file" name="galery_images[]"  multiple>
								</div>
							</div>
						</div>
					</div>					
					<!-- IMAGENES -->

				</div>
				<div class="box-footer">
					<div class="callout callout-info text-left">
						<label>Todos los campos marcados con <strong>(*)</strong> deben ser completados</label>
					</div>
					<button type="submit" class="btn btn-primary pull-right" :disabled="sending == true">
						<template v-if="!sending">
							<i class="fa fa-save"></i> Guardar cambios
						</template>
						<template v-if="sending">
							<i class="fa fa-spinner fa-spin"></i>
						</template>
					</button>
				</div>
			</form>
		</div>
	</section>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/dropify/dist/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/v-money-master/dist/v-money.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/shop/articles.create.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/admin/shop/articles/create.blade.php ENDPATH**/ ?>