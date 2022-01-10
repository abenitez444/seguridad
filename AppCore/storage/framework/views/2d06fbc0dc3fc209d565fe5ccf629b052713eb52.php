<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="container site-section" id="checkout">
	<div class="container-fluid" >
		<form id="form_" onsubmit="return false;" v-on:submit="save()">
			<div class="row fondo-contacto2" style="height: 100vh; margin-bottom: 50px !important;">
				<div class="col-md-6 registrar">
					<h5 class="text-center tc-verde vmt-15">Registrate ¡Es Gratis!</h5>
					<h6 class="text-center">KeyWood, detalle de facturación.</h6>
					<br>

					<div class="row vpz-5">
						<div class="col-md-12 mt-5">
							<input disabled  type="text" name="name" class="form-control mb-3" placeholder="Nombre Completo(*)" required="required" v-model="user.name">
							<input disabled  type="email" name="email" class="form-control mb-3" placeholder="Email(*)" required="required" v-model="user.email">
							<input  disabled type="text" name="phone" class="form-control mb-3" placeholder="Teléfono celular(*)" required="required" v-model="user.phone">
							<input disabled  type="text" name="address" class="form-control mb-3" placeholder="¿De donde eres?" v-model="user.address">
							<input  disabled type="text" name="state" class="form-control mb-3" placeholder="Estado" v-model="user.state">
						</div>
					</div>
				</div>

				<div class="col-md-6 registrar" style="background-color: rgba(0, 0, 0, 0.06);">
					<h5 class="text-center tc-verde vmt-15">Su pedido</h5>
					<br>

					<div class="row vpz-5">
						<div class="col-md-12 mt-5">
							<div class="site-blocks-table">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th class="product-name">Producto</th>
											<th class="product-total">Total</th>
										</tr>
									</thead>
									<tbody>
										<tr v-if="items.length > 0" v-for="item in items">
											<td class="product-name">
												<h2 class="h5 text-black">{{ item.article.name }} <b>X {{ item.count }}</b></h2>
											</td>
											<td>
												{{ currency.symbol }} {{ item.subTotal }}
												<money type="hidden" :id="'article-' + item.article.id" v-model="item.subTotal" v-bind="money">{{ item.subTotal }}</money>
											</td>
										</tr>
									</tbody>
									<thead>
										<tr>
											<th class="product-name">Sub total</th>
											<th class="product-total">
												{{ currency.symbol }} {{ invoice.subTotal }}
												<money type="hidden" v-model="invoice.subTotal" v-bind="money">{{ invoice.subTotal }}</money>
											</th>
										</tr>
										<tr>
											<th class="product-name">IVA</th>
											<th class="product-total">
												{{ currency.symbol }} {{ invoice.iva }}
												<money type="hidden" v-model="invoice.iva" v-bind="money">{{ invoice.iva }}</money>
											</th>
										</tr>
										<tr>
											<th class="product-name">Total</th>
											<th class="product-total">
												{{ currency.symbol }} {{ invoice.total }}
												<money type="hidden" v-model="invoice.total" v-bind="money">{{ invoice.total }}</money>
											</th>
										</tr>
									</thead>
								</table>
								<div class="row" style="margin-bottom: 30px;">
									<div class="col-12 col-md-12" v-for="pay in paymentGateways">
										<input type="radio" name="payment" v-model="invoice.payment" :value="pay.id"> {{ pay.name }} 
										<img v-if="pay.image != '' && pay.image != null " :src="'<?php echo e(asset('storage')); ?>/' + pay.image" width="65">
									</div>
								</div>
								<div class="row" v-if="errors  != ''">
									<div class="col-12 col-md-12">
										<div class="alert alert-danger" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											{{ errorMessage }}									  				
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<!--<button class="btn btn-primary btn-lg btn-block" style="background-color: green;">Procesar</button>-->
										<button class="btn btn-primary btn-lg btn-block" style="background-color: green;" :disabled="sending == true">
											<template v-if="!sending">
												Procesar
											</template>
											<template v-if="sending">
												<i class="fa fa-spinner fa-spin"></i>
											</template>									
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
	const IDUSER = "<?php echo e(auth()->user()->id); ?>";
</script>
<script type="text/javascript" src="<?php echo e(asset('js/checkout.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/website/shop/checkout.blade.php ENDPATH**/ ?>