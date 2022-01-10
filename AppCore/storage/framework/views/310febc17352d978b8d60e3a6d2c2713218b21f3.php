<?php $__env->startSection('content'); ?>

<div class="container" id="main-categories">
	<div class="row mt-5 mb-5">
		<div class="col-md-6 mb-1 vpr-5 col-12 mmb-5" v-for="category in categories">
			<a :href="'<?php echo e(url('shop/category/')); ?>/' + category.slug">
				<img :src="'<?php echo e(asset('storage/')); ?>/' + category.image" :alt="category.name" class="img-fluid w-100">
			</a>
			<p class="tc-blanco position-absolute bg-black tc w-35">{{ category.name }}</p>
		</div>
	</div>
</div>

<div class="container-fluid bg-griss pb-3">
	<div class="row" id="recommended-products">
		<div class="col-md-12 text-center mt-3">
			<h2 class="tc-verde mb-0"><span class="bg-rosado">Productos</span></h2>
			<h2 class="tc-verde "><span class="bg-rosado"> Recomendados</span></h2>
			<img src="<?php echo e(asset('img/cuadro.png')); ?>" alt="" class="position-absolute cuadro">
		</div>
		<div class="col-md-4" v-for="product in recommendedProducts">
			<div class="card mt-3 l-10" style="width: 80%;">
				<img class="card-img-top" :src="'<?php echo e(asset('storage/')); ?>/' + product.main_image" alt="Card image cap">
				<div class="position-absolute bg-verde circulo text-center">
					<h6 class="tc-blanco size-8 vmt-30"><span class="bg-rosado">ENTREGA EN</span></h6>
					<h4 class="tc-blanco size-1"><span class="bg-rosado">8 DÍAS</span></h4>
				</div>
				<div class="card-body pr-1 pl-1 pb-1">
					<div class="bg-griss2 pt-1 pb-1">
						<a :href="'<?php echo e(asset('shop/product')); ?>/' + product.slug"><h6 class="card-title text-center mt-2"><span class="bg-rosado">VISTA RÁPIDA</span></h6></a>
					</div>
					<h6 class="size-8 mt-1 mb-1 centrar-mobile"><span class="bg-rosado">{{ product.name }}</span></h6>	
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4 mt-1 centrar-mobile">
								<!--<h6 class="size-8"><span class="bg-rosado">$ 960.990,00</span></h6>-->
							</div>
							<div class="col-md-4 pr-0 pl-0 mt-1 centrar-mobile">
								<h2 class="size-1">
									{{ currency.symbol }} {{ product.price }}
									<money type="hidden" v-model="product.price"  v-bind="money">{{ product.price }}</money>
								</h2>
							</div>
							<div class="col-md-4 mt-1 centrar-mobile">
								<h6 class="size-8"><span class="bg-rosado">incl. IVA</span></h6>
							</div>
						</div>
					</div>

					<button class="btn btn-default w-100" v-on:click="addCart(product)">AGREGAR</button>

				</div>

			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<img src="<?php echo e(asset('img/img-final.png')); ?>" alt="" class="w-100 h-50 alto-30-mobile">
	</div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/home.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/website/index.blade.php ENDPATH**/ ?>