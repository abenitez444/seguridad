<?php $__env->startSection('content'); ?>

<style type="text/css">
	.single-checkout-box {
		border-radius: 20px;
	}
</style>

<section id="userPorfile" class="our-checkout-area ptb--120 bg__white">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-8">
				<form id="form_" method="post" onsubmit="return false;" v-on:submit="updateProfile()">
					<div class="ckeckout-left-sidebar">
						<!-- Start Checkbox Area -->
						<div class="checkout-form">
							<h2 style="color: #e04456;" class="section-title-3">Datos de Usuario</h2>
							<div class="checkout-form-inner">
								<div class="single-checkout-box">
									<input type="text" placeholder="Nombre" name="name" v-model="user.name" required="required">
									<input type="email" placeholder="Correo" name="email" v-model="user.email" required="required">
									<input type="text" placeholder="Teléfono" name="phone" v-model="user.phone" required="required">
									<select name="country" v-model="user.country">
										<option value="">País*</option>
										<option value="Colombia">Colombia</option>
										<option value="Venezuela">Venezuela</option>
										<option value="Argentina">Argentina</option>
										<option value="Estados Unidos">Estados Unidos</option>
									</select>
									<input type="text" placeholder="Estado" name="state" v-model="user.state">
									<input type="text" placeholder="Código Postal" name="codePostal" v-model="user.codePostal">
									<textarea name="address" placeholder="Dirección completa" v-model="user.address"></textarea>
								</div>

								<div class="single-checkout-box select-option mt--40">
									<h2 style="color: #e04456;" class="section-title-3">Clve de acceso</h2>
									<p>Solo rellene e campo si desea modificar su contraseña.</p>				
									<input type="password" placeholder="Contraseña" name="password" v-model="password">
									<input type="password" placeholder="Confirmar contraseña" name="password2" v-model="password2">
									<input type="submit" style="display: none;">
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
								<!-- <a style="border: 2px solid #e04456; border-radius: 20px; color: #e04456; padding: 12px;" class="ts-btn btn-light btn-large hover-theme" href="#">Editar Datos Personales</a> -->
							</div>
						</div>
						<!-- End Checkbox Area -->
						<!-- Start Payment Box -->
						<!-- 
							<div class="payment-form">
								<h2 class="section-title-3">Metodos de Pago</h2>
								<div class="payment-form-inner">
									<div class="single-checkout-box">
										<input type="text" placeholder="Tarjeta">
										<input type="text" placeholder="Número de Tarjeta">
									</div>
									<div class="single-checkout-box select-option">
										<select>
											<option>Fecha</option>
											<option>Date</option>
											<option>Date</option>
											<option>Date</option>
											<option>Date</option>
										</select>
										<input type="text" placeholder="Código de Seguridad">
									</div>
									<a style="border: 2px solid #e04456; border-radius: 20px; color: #e04456; padding: 12px;" class="ts-btn btn-light btn-large hover-theme" href="#">Editar Metodos de Pago</a>
								</div>
							</div> 
						-->
						<hr style="background-color: #C1C1C1; height: 1px; width: 100%; margin-top: 50px;">
						<!-- End Payment Box -->
						<!-- Start Payment Way -->
						<div class="our-payment-sestem" style="margin-top: 70px;">
							<div class="checkout-btn">
								<template v-if="!sending">
									<input type="submit"  style="background-color: #e04456; border-radius: 20px; color: white; padding: 15px;" class="ts-btn btn-light btn-large hover-theme" value="GUARDAR DATOS">
								</template>
								<template v-if="sending">
									<input type="submit"  style="background-color: #e04456; border-radius: 20px; color: white; padding: 15px;" class="ts-btn btn-light btn-large hover-theme" value="Enviando..." disabled="disabled">
								</template>								
							</div>    
						</div>
						<!-- End Payment Way -->
					</div>
				</form>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="checkout-right-sidebar" style="border:2px solid #e04456; padding: 40px; border-radius: 15px;">
					<div class="our-important-note">
						<h2 class="section-title-3">Compras</h2>
						<p class="note-desc">Ver listado de compras:</p>
						<div class="single-checkout-box">
							<label>Desde:</label>
							<input type="date" v-model="dateIni" placeholder="Nombre" style="border-radius: 20px; border:1px solid; padding: 5px;"><br><br>
							<label>Hasta:</label>
							<input type="date" v-model="dateEnd" placeholder="Apellido" style="border-radius: 20px; border:1px solid; padding: 5px;">
						</div>
						<div class="single-checkout-box">
							<ul class="important-note">
                                <li v-for="purchase in listPurchases">
                                	<hr style="background-color: #C1C1C1; height: 1px; width: 100%; margin-top: 50px;">
                                	<b>Fecha: </b>{{ purchase.created_at }}<br/>
                                	<b>Num: </b>{{ purchase.code }} <a :href="'<?php echo e(url('shop/viewInvoice')); ?>/'+purchase.code"><i class="zmdi zmdi-eye"></i> Ver datalles</a><br/>
                                	<b>Monto: </b>{{ currency.symbol }} {{ purchase.total }}<money type="hidden" v-model="purchase.total" v-bind="money"></money><br/>
                                	<hr style="background-color: #C1C1C1; height: 1px; width: 100%; margin-top: 50px;">
                                </li>
                            </ul>
						</div>
					</div>

				</div>

				<div class="puick-contact-area mt--60" style="background: #e04456; color: white; border-radius: 15px;" >
					<h2 class="section-title-3"  style="color: white;" v-on:click="getPurchaseClient()">Buscar facturas</h2>
					<!-- <a href="#" style="color: white;">Imprimir <i style="padding: 5px;" class="zmdi zmdi-eye"></i> </a>-->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Checkout Area -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">const USER = {id: "<?php echo e(Auth::user()->id); ?>", name: "<?php echo e(Auth::user()->name); ?>", email: "<?php echo e(Auth::user()->email); ?>"}; console.log(USER);</script>
<script type="text/javascript" src="<?php echo e(asset('js/app/porfile.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/website/auth/showProfile.blade.php ENDPATH**/ ?>