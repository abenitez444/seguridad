<?php $__env->startSection('content'); ?>

<div id="componentHome">
	<!-- Start Feature Product -->
	<section class="categories-slider-area bg__white">
		<div class="container"  style="width: 100%; padding: 0; margin: 0;">
			<div class="row">
				<!-- Start Left Feature -->
				<div class="col-md-12 col-lg-12 col-sm-8 col-xs-12 float-left-style">
					<!-- Start Slider Area -->
					<div class="slider__container slider--one" id="mainSlider">
						<div class="slider__activation__wrap owl-carousel owl-theme" v-if="sliders.length  > 0">
							<!-- Start Single Slide -->
							<div v-for="mainSlide in sliders" class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: rgba(0, 0, 0, 0) url(images/slider/bg/1.jpg) no-repeat scroll center center / cover ;">
								<div class="container">
									<div class="row">
										<div class="col-md-10 col-lg-8 col-md-offset-2 col-lg-offset-4 col-sm-12 col-xs-12">
											<div class="slider__inner">
												<h1 style="color: white;">{{ mainSlide.content }}</h1>
												<div  class="slider__btn">
													<a style="color: white; border:2px solid white; padding: 10px;" class="htc__btn" href="<?php echo e(route('viewCart')); ?>">Comprar Ahora</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Single Slide -->
						</div>
					</div>
					<!-- Start Slider Area -->
				</div>
			</div>
		</div>
	</section>

	<div class="only-banner ptb--100 bg__white">
		<div class="container">
			<div class="only-banner-img">

			</div>
		</div>
	</div>
	<!-- Start Our Product Area -->
	<section class="htc__product__area bg__white">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="product-categories-all" style="text-align: center; background-color: #EFEFEF;">
						<div class="product-categories-title">
							<h3 style="background-color: #E04456; color: white; border:0; border-radius: 10px 10px 0 0;">Categorías</h3>
						</div>
						<div class="product-categories-menu">
							<ul>
								<li v-for="category in categories"><a href="#">{{ category.name }}</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="product-style-tab" style="border:0; text-align: center;">
						<div class="product-tab-list" style="border:0;">
							<!-- Nav tabs -->
							<ul class="tab-style" role="tablist">
								<li class="active">
									<a href="#home1" data-toggle="tab" >
										<div class="tab-menu-text">
											<h4 style="text-align: center; color: #E04456; font-weight: bold; font-size: 25px;"><span style="color:#E04456; ">▼</span> Ofertas exclusivas para ti <span style="color:#E04456; ">▼</span> </h4>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="tab-content another-product-style jump">
							<div class="tab-pane active" id="home1">
								<div class="row">
									<div class="product-slider-active owl-carousel">
										<div v-for="article in mainArticles" class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
											<div class="product">
												<div class="product__inner">
													<div class="pro__thumb">
														<a :href="'<?php echo e(url('shop/product')); ?>/' + article.slug">
															<img v-if="article.main_image != '' && article.main_image != null" :src="'<?php echo e(asset('storage')); ?>/' + article.main_image" alt="article.name">
														</a>
													</div>
													<div class="product__hover__info">
														<ul class="product__action">
															<li><a data-toggle="modal" data-target="#productModal" title="Quick View" class="quick-view modal-view detail-link" href="#" v-on:click="view(article)"><span class="ti-plus"></span></a></li>
															<li><a title="Add TO Cart" href="javascript:void(0)" v-on:click="addCart(article)"><span class="ti-shopping-cart"></span></a></li>
															<li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
														</ul>
													</div>
												</div>
												<div class="product__details">
													<h2><a :href="'<?php echo e(url('shop/product')); ?>/' + article.slug">{{ article.name }}</a></h2>
													<ul class="product__price">
														<li class="old__price">
															{{ currency.symbol }} {{ article.previous_price }}
															<money type="hidden" v-model="article.previous_price"  v-bind="money">{{ article.previous_price }}</money>
														</li>
														<li class="new__price">
															{{ currency.symbol }} {{ article.price }}
															<money type="hidden" v-model="article.price"  v-bind="money">{{ article.price }}</money>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Our Product Area -->
	<div class="only-banner ptb--100 bg__white">
		<div class="container" width="100%" style="background-color: black; padding: 0; margin:0; width: 100%;">
			<div class="only-banner-img">
				<a href="#"><img src="<?php echo e(asset('images/new-product/6.jpg')); ?>"></a>
			</div>
		</div>
	</div>
	<!-- Start Our Product Area -->
	<section class="htc__product__area pb--100 bg__white">
		<div class="container">
			<div class="row">

				<div class="col-md-12">
					<div class="product-style-tab">
						<div class="product-tab-list" style="text-align: center; border: 0; ">
							<!-- Nav tabs -->
							<ul class="tab-style" role="tablist" style="border:0px;">
								<li class="active">
									<div class="tab-menu-text">
										<h4 style="color: #E04456; font-weight: bold; font-size: 25px;">RECOMENDADOS </h4>
									</div>
								</li>
								<li>
									<div class="tab-menu-text">
										<h4 style="color: #E04456; font-weight: bold; font-size: 25px;">NOVEDADES </h4>
									</div>
								</li>
								<li>
									<div class="tab-menu-text">
										<h4 style="color: #E04456; font-weight: bold; font-size: 25px;">IMPERDIBLES</h4>
									</div>
								</li>
							</ul>
							<hr style="background-color: #E6E6E6; height: 1px; border:0;">
						</div>

						<div class="tab-content another-product-style jump">
							<div class="tab-pane active">
								<div class="row">
									<div class="">
										<div v-for="article in recommendedProducts" class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
											<div class="product">
												<div class="product__inner">
													<div class="pro__thumb">
														<a :href="'<?php echo e(url('shop/product')); ?>/' + article.slug">
															<img v-if="article.main_image != '' && article.main_image != null" :src="'<?php echo e(asset('storage')); ?>/' + article.main_image" alt="article.name">
														</a>
													</div>
													<div class="product__hover__info">
														<ul class="product__action">
															<li><a data-toggle="modal" data-target="#productModal" title="Vista previa" class="quick-view modal-view detail-link" href="#" v-on:click="view(article)"><span class="ti-plus"></span></a></li>
															<li><a title="Add TO Cart" href="javascript:void(0)" v-on:click="addCart(article)"><span class="ti-shopping-cart"></span></a></li>
															<li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
														</ul>
													</div>
												</div>
												<div class="product__details">
													<h2><a :href="'<?php echo e(url('shop/product')); ?>/' + article.slug">{{ article.name }}</a></h2>
													<ul class="product__price">
														<li class="old__price">
															{{ currency.symbol }} {{ article.previous_price }}
															<money type="hidden" v-model="article.previous_price"  v-bind="money">{{ article.previous_price }}</money>
														</li>
														<li class="new__price">
															{{ currency.symbol }} {{ article.price }}
															<money type="hidden" v-model="article.price"  v-bind="money">{{ article.price }}</money>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>
	</section>
	<!-- End Our Product Area -->
	<div class="only-banner bg__white">
		<div class="container">
			<div class="only-banner-img">
				<a href="shop-sidebar.html"><img src="images/bg/dis.png" alt="new product"></a>
			</div>
		</div>
	</div>

	<br><br>

	<div class="only-banner bg__white" width="100%">
		<div class="container" width="100%">
			<div class="only-banner-img">
				<a href="shop-sidebar.html"><img src="images/bg/precios.jpg" alt="new product"></a>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="productModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal__container" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="modal-product">
						<!-- Start product images -->
						<div class="product-images">
							<div class="main-image images">
								<img v-if="article.main_image != '' && article.main_image != null" :src="'<?php echo e(asset('storage')); ?>/' + article.main_image" alt="article.name">
							</div>
						</div>
						<!-- end product images -->
						<div class="product-info">
							<h1>{{ article.name }}</h1>
							<div class="rating__and__review">
								<ul class="rating">
									<li><span class="ti-star"></span></li>
									<li><span class="ti-star"></span></li>
									<li><span class="ti-star"></span></li>
									<li><span class="ti-star"></span></li>
									<li><span class="ti-star"></span></li>
								</ul>
								<div class="review">
									<a href="#">4 customer reviews</a>
								</div>
							</div>
							<div class="price-box-3">
								<div class="s-price-box">
									<span class="new-price">
										{{ currency.symbol }} {{ article.price }}
										<money type="hidden" v-model="article.price"  v-bind="money">{{ article.price }}</money>
									</span>
									<span class="old-price">
										{{ currency.symbol }} {{ article.previous_price }}
										<money type="hidden" v-model="article.previous_price"  v-bind="money">{{ article.previous_price }}</money>
									</span>
								</div>
							</div>
							<div class="quick-desc">
								{{ article.description }}
							</div>
							<!--<div class="select__color">
								<h2>Select color</h2>
								<ul class="color__list">
									<li class="red"><a title="Red" href="#">Red</a></li>
									<li class="gold"><a title="Gold" href="#">Gold</a></li>
									<li class="orange"><a title="Orange" href="#">Orange</a></li>
									<li class="orange"><a title="Orange" href="#">Orange</a></li>
								</ul>
							</div>
							<div class="select__size">
								<h2>Select size</h2>
								<ul class="color__list">
									<li class="l__size"><a title="L" href="#">L</a></li>
									<li class="m__size"><a title="M" href="#">M</a></li>
									<li class="s__size"><a title="S" href="#">S</a></li>
									<li class="xl__size"><a title="XL" href="#">XL</a></li>
									<li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
								</ul>
							</div>-->
							<div class="social-sharing">
								<div class="widget widget_socialsharing_widget">
									<h3 class="widget-title-modal">Share this product</h3>
									<ul class="social-icons">
										<li><a target="_blank" title="rss" href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
										<li><a target="_blank" title="Linkedin" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
										<li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
										<li><a target="_blank" title="Tumblr" href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
										<li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="addtocart-btn">
								<a href="javascript:void(0)" v-on:click="addCart(article)">Add to cart</a>
							</div>
						</div><!-- .product-info -->
					</div><!-- .modal-product -->
				</div><!-- .modal-body -->
			</div><!-- .modal-content -->
		</div><!-- .modal-dialog -->
	</div>
	<!-- END Modal -->
</div>

<br><br>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/app/index.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/website/index.blade.php ENDPATH**/ ?>