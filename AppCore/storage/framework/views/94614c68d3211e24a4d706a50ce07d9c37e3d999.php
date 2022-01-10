<?php $__env->startSection('title'); ?>Ventas <?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Ventas
			<small>detalle</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="<?php echo e(route('sales.sales.index')); ?>"><i class="fa fa-shopping-cart"></i> Ventas</a></li>
			<li class="active">Detalle de la venta</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Editar estado de la venta con  
					<small>Num. de factura: {{ invoice.code }}</small>
				</h3>
			</div>
			<div class="box-body">
			</div>
			<div class="overlay" v-if="searching == true">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			<div class="row" v-if="invoice != '' ">
				<div class="col-md-12 col-12">
					<div>
						<!-- Main content -->
						<section class="invoice">
							<!-- info row -->
							<div class="row invoice-info">
								<div class="col-sm-4 invoice-col">
									Cliente:
									<address>
										<strong>{{ invoice.client.name }}</strong><br>
										Teléfono: {{ invoice.client.phone }}<br>
										Email: {{ invoice.client.email }} <br/>
										{{ invoice.client.address }}<br>
										{{ invoice.client.state }}<br>												
									</address>
								</div>

								<div class="col-sm-4 invoice-col">
								</div>
								<!-- /.col -->

								<!-- /.col -->
								<div class="col-sm-4 invoice-col">
									<b>Invoice {{ invoice.code }}</b><br>
									<b>Fecha:</b> {{ invoice.created_at }}<br>
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->

							<!-- Table row -->
							<div class="row">
								<div class="col-xs-12 table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Cant.</th>
												<th>Producto</th>
												<th>Referencia</th>
												<th>Precio U.</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="article in invoice.articles">
												<td>{{ article.pivot.count }}</td>
												<td>{{ article.name }}</td>
												<td>{{ article.reference }}</td>
												<th>
													{{ currency.symbol }} {{ article.costs_price.general_price }}
													<money type="hidden" v-model="article.costs_price.general_price" v-bind="money" ></money>
												</th>
												<td>
													{{ currency.symbol }} {{ article.total }}
													<money type="hidden" v-model="article.total" v-bind="money"></money>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->

							<div class="row">
								<!-- accepted payments column -->
								<div class="col-xs-12 col-12 col-md-12">
									<p class="lead">Método de pago utilizado:</p>
									<p>
										<strong>{{ invoice.payment.name }}</strong>
										<img v-if="invoice.payment.image != '' && invoice.payment.image != null" :src="'<?php echo e(asset('storage')); ?>/' + invoice.payment.image" width="100">
									</p>
								</div>
								<!-- /.col -->
								<div class="col-xs-12 col-12 col-md-12">
									<div class="table-responsive pull-right">
										<table class="table">
											<tr>
												<th style="width:50%">Subtotal:</th>
												<td>
													{{ currency.symbol }} {{ invoice.subtotal }}
													<money type="hidden" v-model="invoice.subtotal" v-bind="money" ></money>
												</td>
											</tr>
											<tr>
												<th>IVA</th>
												<td>
													{{ currency.symbol }} {{ invoice.tax }}
													<money type="hidden" v-model="invoice.tax" v-bind="money"></money>
												</td>
											</tr>
											<tr>
												<th>Total:</th>
												<td>
													{{ currency.symbol }} {{ invoice.total }}
													<money type="hidden" v-model="invoice.total" v-bind="money" ></money>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
							<div class="row">
								<div class="col-xs-12">
									<h2 class="page-header">
										Detalle de la venta
									</h2>
								</div>
								<!-- /.col -->
							</div>
							<!-- info row -->
							<form id="form_" onsubmit="return false;" v-on:submit="updateInvoice()">
								<div class="row invoice-info">
									<div class="col-sm-12 invoice-col">
										<div class="col-12 col-sm-4 col-md-4 col-lg-4">
											<label for="title">Estado: </label>
											<div class="form-group">
												<select class="form-control" name="status" v-model="invoice.status">
													<option value="En proceso">En proceso</option>
													<option value="Cancelada">Cancelada</option>
													<option value="Completada">Completada</option>
												</select>
											</div>
										</div>
										<div class="col-12 col-sm-4 col-md-4 col-lg-4">
											<label for="title">Pagado: </label>
											<div class="form-group">
												<select class="form-control" name="paid" v-model="invoice.paid">
													<option value="SI">SI</option>
													<option value="NO">NO</option>
												</select>
											</div>
										</div>
										<div class="col-12 col-sm-4 col-md-4 col-lg-4">
											<label for="title">Despachado: </label>
											<div class="form-group">
												<select class="form-control" name="dispatched" v-model="invoice.dispatched" v-on:change="changeDispatch()">
													<option value="SI">SI</option>
													<option value="NO">NO</option>
												</select>
											</div>
										</div>
									</div>

									<div class="row" v-if="invoice.dispatched == 'SI' ">
										<div class="col-xs-12">
											<h2 class="page-header">
												Detalle de envió
											</h2>
										</div>
										<div class="col-12 col-sm-12 col-md-6 col-lg-6">
											<label for="title">Número de guía: </label>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-barcode"></i></span>
													<input type="text" class="form-control" placeholder="Ingrese el número de guía" v-model="invoice.shipmentDetails.guideNumber" name="guideNumber">
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-12 col-md-6 col-lg-6">
											<label for="title">Operador logístico: </label>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-header"></i></span>
													<input type="text" class="form-control" placeholder="Ingrese el nombre o descripción del Operador logístico" name="logisticOperator" v-model="invoice.shipmentDetails.logisticOperator">
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-12 col-md-6 col-lg-6">
											<label for="title">Fecha de despacho: </label>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													<vuejs-datepicker v-model="date" name="dispatchDate" format="yyyy-MM-dd" input-class="form-control"></vuejs-datepicker>
													<!-- <input type="text" class="form-control datepicker" placeholder="Fecha del despacho" name="dispatchDate" v-model="invoice.shipmentDetails.dispatchDate"> -->
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-12 col-md-6 col-lg-6">
											<label for="title">Costo: </label>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-money"></i></span>
													<money type="text" name="cost" class="form-control" placeholder="Costo del envió" v-model="invoice.shipmentDetails.cost" v-bind="moneyInput"></money>
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-12 col-md-6 col-lg-6">
											<label for="title">Estado o Provincia de envió: </label>
											<div class="form-group">
												<select class="form-control" name="state" v-model="invoice.shipmentDetails.shop_cities_state_id" v-on:change="getVillagesByState(invoice.shipmentDetails.shop_cities_state_id)">
													<option v-for="state in states" :value="state.id">{{ state.name }}</option>
												</select>
											</div>
										</div>
										<div class="col-12 col-sm-12 col-md-6 col-lg-6">
											<label for="title">Municipio o Pueblo de envió: </label>
											<div class="form-group">
												<select class="form-control" name="village" v-model="invoice.shipmentDetails.shop_cities_villages_id">
													<option v-for="village in villages" :value="village.id">{{ village.name }}</option>
												</select>
											</div>
										</div>
										<div class="col-12 col-sm-12 col-md-12 col-lg-12">
											<label>Dirección de envió detallada: </label>
											<div class="form-group">		
												<textarea class="form-control" name="address" placeholder="Dirección detallada del envió" rows="10" v-model="invoice.shipmentDetails.address"></textarea>
											</div>
										</div>
										<!-- /.col -->
									</div>
									<div class="row">
										<div class="col-2 pull-right">
											<button type="submit" class="btn btn-primary" :disabled="sending == true">
												<template v-if="!sending">
													<i class="fa fa-save"></i> Guardar cambios
												</template>
												<template v-if="sending">
													<i class="fa fa-spinner fa-spin"></i>
												</template>
											</button>
										</div>
									</div>
								</div>
							</form>
						</section>
						<!-- /.content -->
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/v-money-master/dist/v-money.js')); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('AppResources/plugins/vuejs-datepicker/js/vuejs-datepicker.min.js')); ?>"></script>
<script type="text/javascript">const IDINVOICE = "<?php echo e($id); ?>";</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/sales/show.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/admin/sales/show.blade.php ENDPATH**/ ?>