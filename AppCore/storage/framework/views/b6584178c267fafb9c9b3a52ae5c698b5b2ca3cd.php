<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/carrito.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="site-section" id="cartSection">
	<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                    
	<div class="container">
		<div class="row mb-5">
			<form class="col-md-12" method="post">
				<div class="site-blocks-table">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="product-thumbnail">Imagen</th>
								<th class="product-name">Producto</th>
								<th class="product-price">Precio</th>
								<th class="product-quantity">Cantidad</th>
								<th class="product-total">Total</th>
								<th class="product-remove">Remover</th>
							</tr>
						</thead>
						<tbody>
							<tr v-if="items.length > 0" v-for="item in items">
								<td class="product-thumbnail">
									<img v-if="item.article.main_image != null && item.article.main_image != '' " :src="'<?php echo e(asset('storage/')); ?>/' + item.article.main_image" alt="item.article.name" class="img-fluid">
								</td>
								<td class="product-name">
									<h2 class="h5 text-black">{{ item.article.name }}</h2>
								</td>
								<td>
									{{ currency.symbol }} {{ item.priceMask }}
									<money type="hidden" v-model="item.priceMask" v-bind="money">{{ item.priceMask }}</money>
								</td>
								<td>
									<div class="input-group mb-3" style="max-width: 120px;">
										<div class="input-group-prepend">
											<button class="btn btn-outline-primary js-btn-minus" type="button" v-on:click="resArticle(item)">&minus;</button>
										</div>
										<input type="text" class="form-control text-center" :value="item.count" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
										<div class="input-group-append">
											<button class="btn btn-outline-primary js-btn-plus" type="button" v-on:click="sumArticle(item)">&plus;</button>
										</div>
									</div>
								</td>
								<td>
									{{ currency.symbol }} {{ item.total }}
									<money type="hidden" :id="'article-' + item.article.id" v-model="item.total" v-bind="money">{{ item.total }}</money>
								</td>
								<td><a href="javascript:void(0)" class="remove btn btn-primary height-auto btn-sm" v-on:click="remove(item)">X</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="row mb-5">
					<div class="col-md-6 mb-3 mb-md-0">
						<button class="btn btn-primary btn-sm btn-green btn-block" v-on:click="updateCart()">Actualizar Carrito</button>
					</div>
					<div class="col-md-6">
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
			<div class="col-md-6 pl-5">
				<div class="row justify-content-end">
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12 text-right border-bottom mb-5">
								<h3 class="text-black h4 text-uppercase">Total en el Carrito</h3>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<span class="text-black">Subtotal</span>
							</div>
							<div class="col-md-6 text-right">
								<strong class="text-black">{{ currency.symbol }} {{ inovice.subTotal }}
									<money type="hidden" v-model="inovice.subTotal" v-bind="money">{{ inovice.subTotal }}</money>
								</strong>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<span class="text-black">IVA</span>
							</div>
							<div class="col-md-6 text-right">
								<strong class="text-black">{{ currency.symbol }} {{ inovice.iva }}
									<money type="hidden" v-model="inovice.iva" v-bind="money">{{ inovice.iva }}</money></strong>
							</div>
						</div>
						<div class="row mb-5">
							<div class="col-md-6">
								<span class="text-black">Total</span>
							</div>
							<div class="col-md-6 text-right">
								<strong class="text-black">{{ currency.symbol }} {{ inovice.total }}
									<money type="hidden" v-model="inovice.total" v-bind="money">{{ inovice.total }}</money></strong>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-primary btn-lg btn-block" v-on:click="checkout()">Proceder a Pagar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/viewCart.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/website/shop/viewCart.blade.php ENDPATH**/ ?>