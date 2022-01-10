<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Start Checkout Area -->
	<style type="text/css">
		.single-checkout-box {
			border-radius: 20px;
		}
	</style>

<div id="checkout">
	

	<section class="our-checkout-area ptb--120 bg__white">
		<div class="container">
			<form id="form_" onsubmit="return false;" v-on:submit="save()">
				<div class="row">
					<div class="col-md-8 col-lg-8">
						<div class="ckeckout-left-sidebar">
							<!-- Start Checkbox Area -->
							<div class="checkout-form">
								<h2 style="color: #e04456;" class="section-title-3">Información personal</h2>
								<div class="checkout-form-inner">
									<div class="single-checkout-box">
										<input type="text" placeholder="Nombre*" name="name" v-model="user.name" disabled>
									</div>
									<div class="single-checkout-box">
										<input type="email" placeholder="Correo*" name="email" v-model="user.email" disabled>
										<input type="text" placeholder="Teléfono*" name="phone" v-model="user.phone" required="required">
									</div>
									<div class="single-checkout-box">
										<textarea name="message" placeholder="Mensaje" v-model="message"></textarea>
									</div>
									
									<h2 style="color: #e04456; margin-top: 30px;" class="section-title-3">Información de envió</h2>
									<div class="single-checkout-box select-option mt--40">
										<select name="shippingCountry" required>
											<option value="">País*</option>
											<option v-for="country in shippingCountry" :value="country">{{ country }}</option>
										</select>
										<input type="text" placeholder="Nombre de la compañía" name="nameCompany" v-model="nameCompany">
									</div>
									<div class="single-checkout-box">
										<input type="text" placeholder="Estado" name="shippingState" v-model="shippingState">
										<input type="text" placeholder="Código Postal" name="shippingCodePostal" v-model="shippingCodePostal">
									</div>
									<div class="single-checkout-box">
										<textarea name="shippingAddress" placeholder="Direccion de envio" v-model="shippingAddress"></textarea>
									</div>
									<!--<div class="single-checkout-box checkbox">
										<input id="remind-me" type="checkbox">
										<label for="remind-me"><span></span>¿Crear una cuenta?</label>
									</div>-->
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
								</div>
							</div>
							<!-- End Checkbox Area -->
							<!-- Start Payment Box -->
							<div class="payment-form">
								<h2 class="section-title-3">Metodos de Pago</h2>
								<p>Seleccione el metodo de pago de su preferencia</p>
								<div class="payment-form-inner">
									<div class="single-radio-box radio" v-for="pay in paymentGateways">
										<input :id="'payment-' + pay.id" type="radio" name="payment" v-model="invoice.payment" :value="pay.id">
										<label :for="'payment-' + pay.id"><span></span>{{ pay.name }}</label>
										<img v-if="pay.image != '' && pay.image != null" :src="'<?php echo e(asset('storage')); ?>/' + pay.image" width="30">
									</div>
								</div>
							</div>
							<!-- End Payment Box -->
							<!-- Start Payment Way -->
							<div class="our-payment-sestem">
								<h2 class="section-title-3">Aceptamos:</h2>
								<ul class="payment-menu">
									<li><img src="<?php echo e(asset('images/payment/1.png')); ?>" alt="payment-img"></li>
									<li><img src="<?php echo e(asset('images/payment/2.png')); ?>" alt="payment-img"></li>
									<li><img src="<?php echo e(asset('images/payment/3.png')); ?>" alt="payment-img"></li>
									<li><img src="<?php echo e(asset('images/payment/4.png')); ?>" alt="payment-img"></li>
									<li><img src="<?php echo e(asset('images/payment/5.png')); ?>" alt="payment-img"></li>
									<li><img src="<?php echo e(asset('images/payment/6.png')); ?>" alt="payment-img"></li>
									<li><img src="<?php echo e(asset('images/payment/7.png')); ?>" alt="payment-img"></li>
									<li><img src="<?php echo e(asset('images/payment/8.png')); ?>" alt="payment-img"></li>
									<li><img src="<?php echo e(asset('images/payment/9.png')); ?>" alt="payment-img"></li>
								</ul>
								<div class="checkout-btn">
									<button type="submit" class="ts-btn btn-light btn-large hover-theme" style="background-color: #e04456; border-radius: 20px; color: white; padding: 15px;" :disabled="sending == true">
										<template v-if="!sending">
											CONFIRMAR COMPRA
										</template>
										<template v-if="sending">
											<i class="fa fa-spinner fa-spin"></i>
										</template>									
									</button>
								</div>    
							</div>
							<!-- End Payment Way -->
						</div>
					</div>
					<div class="col-md-4 col-lg-4">
						<div class="checkout-right-sidebar" style="border:2px solid #e04456; padding: 40px; border-radius: 15px;">
							<div class="our-important-note">
								<h2 class="section-title-3">Detalle de compra:</h2>
								<p class="note-desc">A continuación se mostrará la informacón de su compra a trávez de nuestro sitio web.</p>
								<table width="100%" style="font-size: 12px;">
									<thead style="background: #e04456; border:white;" >
										<tr>
											<th style="color: white;" class="product-name">Producto</th>
											<th style="color: white;" class="product-price">Precio Unit</th>
											<th style="color: white;" class="product-quantity">Cantidad</th>
											<th style="color: white;" class="product-subtotal">Total</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="item in items">
											<th>
												{{ item.article.name }}
											</th>
											<th>
												{{ currency.symbol }} {{ item.article.costs_price.net_price }}
												<money type="hidden" v-model="item.article.costs_price.net_price" v-bind="money"></money>
											</th>
											<th>
												{{ item.count }}
											</th>
											<th>
												{{ currency.symbol }} {{ item.total }}
												<money type="hidden" v-model="item.total" v-bind="money"></money>
											</th>
										</tr>
									</tbody>
									<tfoot style="border:white; color: white;">
										<tr>
											<th></th>
											<th></th>
											<th colspan="2" style="background-color: rgb(224, 68, 86);" class="cart-subtotal text-right">
												Sub total: {{ currency.symbol }} {{ invoice.subTotal }}
												<money type="hidden" v-model="invoice.subTotal" v-bind="money">{{ invoice.subTotal }}</money>
											</th>
										</tr>
										<tr>
											<th></th>
											<th></th>
											<th colspan="2" style="background-color: rgb(224, 68, 86);" class="cart-subtotal text-right">
												IVA: {{ currency.symbol }} {{ invoice.iva }}
												<money type="hidden" v-model="invoice.iva" v-bind="money">{{ invoice.iva }}</money>
											</th>
										</tr>
										<tr>
											<th></th>
											<th></th>
											<th colspan="2" style="background-color: rgb(224, 68, 86);" class="order-total text-right">
												Total: {{ currency.symbol }} {{ invoice.total }}
												<money type="hidden" v-model="invoice.total" v-bind="money">{{ invoice.total }}</money>
											</th>
										</tr>
									</tfoot>
								</table>
							</div>

						</div>

						<div class="puick-contact-area mt--60" style="background: #e04456; color: white; border-radius: 15px;" >
							<h2 class="section-title-3"  style="color: white;">Compra Rápida</h2>
							<a href="phone:+8801722889963" style="color: white;">+57 345 678 102 </a>
						</div>
					</div>
				</div>
			</form>
			
		</div>
	</section>
	<!-- End Checkout Area -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
	const IDUSER = "<?php echo e(auth()->user()->id); ?>";
</script>
<script type="text/javascript" src="<?php echo e(asset('js/app/checkout.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/website/shop/checkout.blade.php ENDPATH**/ ?>