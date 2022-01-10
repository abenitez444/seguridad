<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div id="invoice">
	<!-- cart-main-area start -->
	<div class="cart-main-area ptb--120 bg__white">
		<div class="container">
			<div class="row">
				<div class="container-fluid" >
					<div class="content-wrapper">
						<!-- Main content -->
						<section class="invoice">
							<!-- title row -->
							<div class="row">
								<div class="col-xs-12">
									<h2 class="page-header">
										<a class="ml-5" href="<?php echo e(route('website.index')); ?>"><img src="<?php echo e(asset('images/logo/logo.png')); ?>" alt="logo" width="100"></a> Womans Colors.
										<a :href="'<?php echo e(url('shop/generateInvoicePDF')); ?>/' + invoice.code"><button class="btn btn-outline-primary btn-sm" style="float: right;">Imprimir <i style="padding: 5px;" class="zmdi zmdi-print"></i></button></a>
									</h2>
								</div>
								<!-- /.col -->
							</div>
							<!-- info row -->
							<div class="row invoice-info">
								<div class="col-sm-4 invoice-col">
									Datos del cliente
									<address>
										<strong><?php echo e(Auth::user()->name); ?>.</strong><br>
										Teléfono: <?php echo e(Auth::user()->phone); ?><br>
										Email: <?php echo e(Auth::user()->email); ?>

										<?php echo e(Auth::user()->address); ?><br>
										<?php echo e(Auth::user()->state); ?><br>							
									</address>
								</div>
								<!-- /.col -->
								<div class="col-sm-4 invoice-col">
									Datos ingresados para el envió
									<address>
										<b>País:</b> {{ invoice.purchaseDetails.shippingCountry }}<br>
										<b>Estado:</b> {{ invoice.purchaseDetails.shippingState }}<br>
										<b>Código postal:</b> {{ invoice.purchaseDetails.shippingCodePostal }}<br>
										<b>Dirección:</b> {{ invoice.purchaseDetails.shippingAddress }}<br>
									</address>
								</div>
								<!-- /.col -->
								<div class="col-sm-4 invoice-col">
									<b>Invoice <?php echo e($code); ?></b><br>
									<b>Payment Due:</b> <?php echo e($invoice->created_at); ?><br>
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
												<th>Ref.</th>
												<th>Precio U.</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="article in invoice.articles">
												<td>{{ article.pivot.count }}</td>
												<td>{{ article.name }}</td>
												<td>{{ article.reference }}</td>
												<td>{{ currency.symbol }} {{ article.costs_price.general_price }}<money type="hidden" v-model="article.costs_price.general_price" v-bind="money"></money></td>
												<td>{{ currency.symbol }} {{ article.subTotal }}<money type="hidden" v-model="article.subTotal" v-bind="money"></money> </td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->

							<div class="row">
								<!-- accepted payments column -->
								<div class="col-md-12">
									<p class="lead">Metodo de pago utilizado: <b style="font-weight: 700;">{{ invoice.payment.name }}</b> <img v-if="invoice.payment.image != '' && invoice.payment.image != null" :src="'<?php echo e(asset('storage')); ?>/' + invoice.payment.image"></p>
								</div>
								<!-- /.col -->
								<div class="col-md-6"></div>
								<div class="col-md-6">
									<div class="table-responsive">
										<table class="table">
											<tr>
												<th style="width:50%">Subtotal:</th>
												<td>{{ currency.symbol }} {{ invoice.subtotal }}<money type="hidden" v-model="invoice.subtotal" v-bind="money"></money></td>
											</tr>
											<tr>
												<th>IVA</th>
												<td>{{ currency.symbol }} {{ invoice.tax }}<money type="hidden" v-model="invoice.tax" v-bind="money"></money></td>
											</tr>
											<tr>
												<th>Total:</th>
												<td>{{ currency.symbol }} {{ invoice.total }}<money type="hidden" v-model="invoice.total" v-bind="money"></money></td>
											</tr>
										</table>
									</div>
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->

							<!-- this row will not appear when printing -->
							<div class="row no-print">
								<div class="col-md-12">
									<div class="pad margin no-print mb-5">
										<div class="callout callout-info" style="margin-bottom: 0!important;">
											<h4><i class="fa fa-info"></i> Gracias por su compra:</h4>
											Su pedido fue tomado con exito, nos pondremos en contacto con usted en la brevedad posible.
										</div>
									</div>
									<div class="row mb-5">
										<div class="col-md-12">
											<button class="btn btn-outline-primary btn-sm btn-block" v-on:click="goShop()">Continuar Comprando</button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
										</div>
										<div class="col-md-8 mb-3 mb-md-0">
										</div>
										<div class="col-md-4">
										</div>
									</div>
								</div>
							</div>
						</section>
						<!-- /.content -->
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- cart-main-area end -->
	
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
	const IDUSER = "<?php echo e(auth()->user()->id); ?>";
	const CODE = "<?php echo e($code); ?>";
</script>
<script type="text/javascript" src="<?php echo e(asset('js/app/thanks.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/website/shop/thanks.blade.php ENDPATH**/ ?>