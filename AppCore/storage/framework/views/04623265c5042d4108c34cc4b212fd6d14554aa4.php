<?php $__env->startSection('title'); ?>Ventas <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div id="component">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Ventas
			<small>listado</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Ventas</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">

		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Listado de ventas</h3>
				<ul class="pagination pagination-sm no-margin pull-right" v-if="invoices.length > 0">
					<li>
						<a href="javascript:void(0)" v-on:click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page < 1" v-if="pagination.current_page > 1">&laquo;</a>
					</li>
					<li >
						<a href="javascript:void(0)" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]" v-on:click="changePage(page)">{{ page }}</a>
					</li>
					<li >
						<a href="javascript:void(0)" v-on:click="changePage(pagination.current_page + 1)" v-if="pagination.current_page < pagination.last_page">&raquo;</a>
					</li>
				</ul>
			</div>
			<div class="box-body table-responsive">
				<table id="tableList" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Código</th>
							<th>Fecha</th>
							<th>Cliente</th>
							<th>Monto</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="invoice in invoices">
							<th>
								{{ invoice.code }}
							</th>
							<th>
								{{ invoice.created_at }}
							</th>
							<th>
								{{ invoice.client.name }}<br/>
								{{ invoice.client.email }}<br/>
								{{ invoice.client.phone  }}
							</th>
							<th>
								{{ currency.symbol }} {{ invoice.total }}
								<money type="hidden" v-model="invoice.total" v-bind="money"></money>
							</th>
							<th>
								<template v-if="invoice.status == 'En proceso' ">
									<small class="label pull-left bg-aqua-active">EN PROCESO</small>
								</template>
								<template v-if="invoice.status == 'Cancelada' ">
									<small class="label pull-left bg-red-active">CANCELADA</small>
								</template>
								<template v-if="invoice.status == 'Completada' ">
									<small class="label pull-left bg-green-active">COMPLETADA</small>
								</template>
							</th>
							<th class="text-right" style="width: 24%;">
								<button type="button" class="btn btn-info btn-sm" v-on:click="view(invoice)"><i class="fa fa-eye"></i></button>
								<a :href="'<?php echo e(asset('/')); ?>admin_/sales/sales/' + invoice.id">
									<button type="button" class="btn btn-primary btn-sm "><i class="fa fa-edit"></i></button>
								</a>
							</th>
						</tr>
						<tr v-if="invoices.length == 0">
							<th colspan="6">No se encuentra ningun registro</th>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Código</th>
							<th>Fecha</th>
							<th>Cliente</th>
							<th>Monto</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="box-footer clearfix" v-if="pagination.last_page > 0">
				<ul class="pagination pagination-sm no-margin pull-right" v-if="invoices.length > 0">
					<li>
						<a href="javascript:void(0)" v-on:click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page < 1" v-if="pagination.current_page > 1">&laquo;</a>
					</li>
					<li >
						<a href="javascript:void(0)" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]" v-on:click="changePage(page)">{{ page }}</a>
					</li>
					<li >
						<a href="javascript:void(0)" v-on:click="changePage(pagination.current_page + 1)" v-if="pagination.current_page < pagination.last_page">&raquo;</a>
					</li>
				</ul>
			</div>
			<div class="overlay" v-if="searching == true">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
		</div>
		
		<!-- Detalle de venta -->
		<div class="modal fade" id="modal-details">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="row" v-if="invoice != '' ">
						<div class="col-md-12 col-12">
							<div>
								<!-- Content Header (Page header) -->
								<section class="content-header">
									<h1>
										Factura
										<small>{{ invoice.code }}</small>
									</h1>
								</section>

								<div class="pad margin no-print">
									<div class="callout callout-info" style="margin-bottom: 0!important;">
										<h4><i class="fa fa-info"></i> Nota:</h4>
										Acá se mostrará solo la factura de la venta realizada.
									</div>
								</div>

								<!-- Main content -->
								<section class="invoice">
									<!-- title row -->
									<div class="row">
										<div class="col-xs-12">
											<h2 class="page-header">
												<i class="fa fa-globe"></i> AdminLTE, Inc.
												<small class="pull-right">Fecha y hora: {{ invoice.created_at }}</small>
											</h2>
										</div>
										<!-- /.col -->
									</div>
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
									<div class="row invoice-info">
										<div class="col-sm-6 invoice-col">
											<address>
												<strong>Estado:</strong> {{ invoice.status }}<br>
												<strong>Pagado:</strong> {{ invoice.paid }}<br/>
												<strong>Despachado:</strong> {{ invoice.dispatched }}<br/>
											</address>
										</div>
										
										<!-- /.col -->
										<div class="col-sm-6 invoice-col">
										</div>
										<!-- /.col -->
									</div>
									<!-- /.row -->

									<!-- this row will not appear when printing -->
									<!--<div class="row no-print">
										<div class="col-xs-12">
											<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
											<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
											</button>
											<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
												<i class="fa fa-download"></i> Generate PDF
											</button>
										</div>
									</div>-->
								</section>
								<!-- /.content -->
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
					</div>					
				</div>				
			</div>
		</div>
	</section>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/v-money-master/dist/v-money.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/sales/index.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/admin/sales/index.blade.php ENDPATH**/ ?>