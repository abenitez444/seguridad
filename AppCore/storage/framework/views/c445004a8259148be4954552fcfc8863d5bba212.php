<?php $__env->startSection('content'); ?>

<div class="container" id="contentArticle">

	<div class="row mt-5">

		<div class="col-md-8">
			<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
			    <div class="carousel-item active">
			      <img class="d-block w-100" v-if="typeof article.main_image != 'undefined'" :src="'<?php echo e(asset('storage/')); ?>/' + article.main_image" alt="First slide">
			    </div>
			    <div class="carousel-item" v-for="image in article.gallery">
			      <img class="d-block w-100" :src="'<?php echo e(asset('storage/')); ?>/' + image.url_path" alt="Second slide">
			    </div>
			  </div>
			</div>

			<div class="row mt-5 mmb-5">
				<div class="col-md-4 col-4 text-center">
					<img v-if="typeof article.main_image != 'undefined'" :src="'<?php echo e(asset('storage/')); ?>/' + article.main_image" class="img-fluid">
				</div>		
				<div class="col-md-4 col-4 text-center" v-for="image in article.gallery">
					<img :src="'<?php echo e(asset('storage/')); ?>/' + image.url_path" class="img-fluid">
				</div>	
			</div>

		<div class="medios" align="center">
			<br><br><h4 class="text-center tc-verde mb-2">Medios de pago</h4>
			<img src="<?php echo e(asset('img/medios/1.png')); ?>">
			<img src="<?php echo e(asset('img/medios/2.png')); ?>">
			<img src="<?php echo e(asset('img/medios/3.png')); ?>">
			<img src="<?php echo e(asset('img/medios/4.png')); ?>">
			<img src="<?php echo e(asset('img/medios/5.png')); ?>">
			<img src="<?php echo e(asset('img/medios/6.png')); ?>">
			<img src="<?php echo e(asset('img/medios/7.png')); ?>">
			<img src="<?php echo e(asset('img/medios/8.png')); ?>">
			<img src="<?php echo e(asset('img/medios/9.png')); ?>">
			<img src="<?php echo e(asset('img/medios/10.png')); ?>">
			<img src="<?php echo e(asset('img/medios/11.png')); ?>">
			<img src="<?php echo e(asset('img/medios/12.png')); ?>">
		</div>
		</div>

		

		<div class="col-md-4">
			<h4 class="text-center tc-verde mb-2">{{ article.name }}</h4>
			<h6 class="text-center mb-4 bg-rosado" style="width: 31%;margin-left: 34%;">Ref. {{ article.reference }}</h6>
			<p class="size-9"><span class="bg-rosado">{{ article.description }}</span></p>
			<h4 class="text-center mb-4 mt-5">Características del Producto</h4>
			
			<p>{{ article.specifications }}</p>

			<p class="size-9"><span class="bg-rosado">Cantidad</span></p>
			<p class="">
				<button class="btn btn-default" v-on:click="resArticle()"><span class="fas fa-minus cantidad-producto"></span></button>
				<span class="cantidad-producto "><span class="bg-rosado()">{{ cantArticle }}</span></span>
				<button class="btn btn-default" v-on:click="sumArticle"><span class="fas fa-plus cantidad-producto"></span></button>
			</p>
			<ul style="padding-left: inherit;">
				<li class="size-9"><span class="bg-rosado">Producto sujeto a días de fabricación.</span></li>
				<li class="size-9"><span class="bg-rosado">Las imágenes de referencias ambientadas no incluyen elementos decorativos.</span></li>
				<li class="size-9"><span class="bg-rosado">Nuestras entregas tienen un maximo de 30 días (Sujeto a dísponibilidad - Se puede entregar antes).</span></li>
			</ul>
			
			<div class="col-md-12">
				<div class="row bg-griss2" style="padding: 5% 0; ">
					<div class="col-md-3 col-3 bg-griss2">
						<p class="size-8"><span class="bg-rosado">$960.990,00</span></p>
					</div>
					<div class="col-md-6 col-6 bg-griss2 text-center">
						<h5 class="tc-rojo"><span class="bg-rosado">$560.990,00</span></h5>
					</div>
					<div class="col-md-3 col-3 bg-griss2">
						<p class="size-8">incl. IVA</p>
					</div>			
				</div>
			</div>
					
				<div class="col-md-12 mb-5">
					<div class="row">
						<button type="submit" class="btn w-100 text-white bg-rojo" v-on:click="addCart()" :disabled="sending == true">
							<template v-if="!sending">
								<span class="fas fa-shopping-cart mr-2"></span>COMPRAR
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

<div class="container-fluid" id="recommended-products">

	<div class="row pb-5 pt-2 bg-griss2">
		<div class="col-md-12 text-center mt-3">
			<h2 class="tc-verde mb-0"><span class="bg-rosado">PRODUCTOS</span></h2>
			<h2 class="tc-verde"><span class="bg-rosado">RECOMENDADOS</span></h2>
			<img src="<?php echo e(asset('img/cuadro.png')); ?>" alt="" class="position-absolute cuadro-producto">
		</div>
	</div>

	<div class="row pb-5 bg-griss2">

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
								<h6 class="size-8"><span class="bg-rosado">$ 960.990,00</span></h6>
							</div>
							<div class="col-md-4 pr-0 pl-0 mt-1 centrar-mobile">
								<h2 class="size-1"><span class="bg-rosado">{{ currency.symbol }} {{ product.price }}</span></h2>
							</div>
							<div class="col-md-4 mt-1 centrar-mobile">
								<h6 class="size-8"><span class="bg-rosado">incl. IVA</span></h6>
							</div>
						</div>
					</div>

					<button class="btn btn-default w-100">AGREGAR</button>

				</div>

			</div>
		</div>	
		
	</div>
			

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">const article_slug = "<?php echo e($slug_product); ?>";</script>
<script type="text/javascript" src="<?php echo e(asset('js/showProduct.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/website/shop/showProduct.blade.php ENDPATH**/ ?>