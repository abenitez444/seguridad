<?php $__env->startSection('content'); ?>

<div id="cartSection">
	<!-- cart-main-area start -->
	<div class="cart-main-area ptb--120 bg__white">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<form action="#">               
						<div class="table-content table-responsive" style="border-radius: 30px 30px 0 0; border:1px solid white;">
							<table >
								<thead style="background: #e04456; border:white;" >
									<tr>
										<th style="color: white;" class="product-thumbnail">Foto</th>
										<th style="color: white;" class="product-name">Producto</th>
										<th style="color: white;" class="product-price">Precio</th>
										<th style="color: white;" class="product-quantity">Cantidad</th>
										<th style="color: white;" class="product-subtotal">Total</th>
										<th style="color: white;" class="product-remove">Quitar</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="item in items">
										<td class="product-thumbnail"><a :href="'<?php echo e(url('shop/product')); ?>/' + item.article.slug"><img v-if="item.article.main_image != '' && item.article.main_image != null" :src="'<?php echo e(asset('storage')); ?>/' + item.article.main_image" alt="item.article.name" /></a></td>
										<td class="product-name"><a :href="'<?php echo e(url('shop/product')); ?>/' + item.article.slug">{{ item.article.name }}</a></td>
										<td class="product-price">
											<span class="amount">
												{{ currency.symbol }} {{ item.article.costs_price.net_price }}
												<money type="hidden" v-model="item.article.costs_price.net_price"  v-bind="money">{{ item.article.costs_price.net_price }}</money>
											</span>
										</td>
										<td class="product-quantity">
											<!-- <money type="hidden" v-model="item.count"  v-bind="money">{{ item.count }}</money> -->
											<input type="number" v-model="item.count" v-on:change="updateCart(item)"/>
										</td>
										<td class="product-subtotal">
											{{ currency.symbol }} {{ item.total }}
											<money type="hidden" v-model="item.total"  v-bind="money">{{ item.total }}</money>
										</td>
										<td class="product-remove"><a href="javascript:void(0)" v-on:click="remove(item)">X</a></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-md-8 col-sm-7 col-xs-12">
								<div class="buttons-cart">
									<a style=" background:#103868;  border-radius: 20px;" href="javascript:void(0)" v-on:click="updateCart()" :disable="sending == true">Actualizar Carrito</a>
									<a style="background-color: #e04456; border-radius: 20px; " href="javascript:void(0)" v-on:click="goShop()">Continuar Comprando</a>
								</div>
							</div>
							<div class="col-md-4 col-sm-5 col-xs-12" style="border:2px solid #e04456; padding: 40px; border-radius: 20px;">
								<div class="cart_totals">
									<h2>Total</h2>
									<table>
										<tbody>
											<tr class="cart-subtotal">
												<th>Subtotal</th>
												<td>
													<span class="amount">
														{{ currency.symbol }} {{ inovice.subTotal }}
														<money type="hidden" v-model="inovice.subTotal" v-bind="money">{{ inovice.subTotal }}</money>	
													</span>
												</td>
											</tr>
											<tr class="cart-subtotal">
												<th>IVA</th>
												<td>
													<span class="amount">
														{{ currency.symbol }} {{ inovice.iva }}
														<money type="hidden" v-model="inovice.iva" v-bind="money">{{ inovice.iva }}</money>
													</span>
												</td>
											</tr>
											<!-- <tr class="shipping">
												<th>Envío</th>
												<td>
													<ul id="shipping_method">
														<li>
															<input type="radio" /> 
															<label>
																Flete: <span class="amount">$7.00</span>
															</label>
														</li>
														<li>
															<input type="radio" /> 
															<label>
																Envío Gratis
															</label>
														</li>
														<li></li>
													</ul>
													<p><a class="shipping-calculator-button" href="#">Calcular Envío</a></p>
												</td>
											</tr>-->
											<tr class="order-total">
												<th>Total</th>
												<td>
													<strong>
														<span class="amount">
															{{ currency.symbol }} {{ inovice.total }}
															<money type="hidden" v-model="inovice.total" v-bind="money">{{ inovice.total }}</money>
														</span>
													</strong>
												</td>
											</tr>                                           
										</tbody>
									</table>
									<div class="wc-proceed-to-checkout">
										<a style="background-color: #e04456; border-radius: 20px;" href="javascript:void(0)" :disable="sending == true" v-on:click="checkout()">Ir a Pagar</a>
									</div>
								</div>
							</div>
						</div>
					</form> 
				</div>
			</div>
		</div>
	</div>
	<!-- cart-main-area end -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/app/viewCart.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/website/shop/viewCart.blade.php ENDPATH**/ ?>