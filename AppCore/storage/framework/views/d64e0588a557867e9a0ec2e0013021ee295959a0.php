<?php $__env->startSection('content'); ?>
<my-nav :subcategories="subCategories"></my-nav>

<div id="componentHome">
	<div class="best_sellers" style="background-image: url(<?php echo e(asset('images/bannerbg.png')); ?>);">
		<div class="container">
			<slider-products-recommend :currency="currency" :money="money"></slider-products-recommend>
		</div>
	</div>

	<div class="deals_featured">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
					<div class="col-md-5 bye"></div>
					<div class="featured">
						<div class="tabbed_container">
							<div class="clearfix">
								<h2 class="active">Productos</h2>
								<div class="t-p">
									<h3 class="active">Lo más reciente</h3>
									<a href="<?php echo e(route('shopList')); ?>"><button class="btn">Ver mas</button></a>
								</div>
							</div>
							<div class="tabs_line"><span></span></div>

							<slider-products-recent :currency="currency" :money="money"></slider-products-recent>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section id="compras" style="background-image: url(<?php echo e(asset('images/comprasbg.png')); ?>);">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<img class="compras" src="<?php echo e(asset('images/EZcompras.png')); ?>">
				</div>

				<div class="col-lg-6">
					<div class="rt">
						<img src="<?php echo e(asset('images/EZsuper.png')); ?>">
					</div>
				</div>
			</div>
		</div>
	</section>


	<div class="entrega">
		<div class="circulo">
			<img src="images/c1.png">
			<h4>COMPRA<br> segura</h4>
		</div>
		<div class="signo"><i class="fas fa-plus"></i></div>
		<div class="circulo">
			<img src="images/c2.png">
			<h4>ENTREGA<br> Mañana</h4>
		</div>
		<div class="signo"><i class="fas fa-plus"></i></div>
		<div class="circulo">
			<img src="images/c3.png">
			<h4>Sin Salir<br> de Casa</h4>
		</div>
	</div>

	<!-- Brands -->
	<div class="brands" style="background-color: var(--gris);">
		<div class="row">
			<div class="col">
				<div class="brands_slider_container">
					<div class="owl-carousel owl-theme brands_slider">
						<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo e(asset('images/logo-s1.jpg')); ?>" alt=""></div></div>
						<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo e(asset('images/logo-s2.jpg')); ?>" alt=""></div></div>
						<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo e(asset('images/logo-s3.jpg')); ?>" alt=""></div></div>
						<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo e(asset('images/logo-s4.jpg')); ?>" alt=""></div></div>
						<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo e(asset('images/logo-s5.jpg')); ?>" alt=""></div></div>
						<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo e(asset('images/logo-s6.jpg')); ?>" alt=""></div></div>
					</div>

					<!-- Brands Slider Navigation -->
					<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
					<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>
				</div>
			</div>
		</div>

	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/app/index.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/ez/AppGestorContenido/resources/views/website/index.blade.php ENDPATH**/ ?>