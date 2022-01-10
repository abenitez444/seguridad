<?php $__env->startSection('content'); ?>

<div id="contentShopList">
	<!-- Start Our Product Area -->
	<section class="htc__product__area shop__page ptb--130 bg__white">
		<div class="container">
			<div class="htc__product__container" id="htc__product__container">

				<!-- Start Product MEnu -->
				<div class="row">
					<div class="col-md-12">
						<div class="filter__menu__container">
							<div class="product__menu">
								<button id="listTodo" style="color: #E04456; font-weight: bold; font-size: 20px;" data-filter="*"  class="is-checked">Todo</button>
								<button style="color: #E04456; font-weight: bold; font-size: 20px;" :data-filter="'.cat--' + category.id" v-for="category in categories">{{ category.name }}</button>
								<!--<button style="color: #E04456; font-weight: bold; font-size: 20px;" data-filter=".cat--2">Rostro</button>
								<button style="color: #E04456; font-weight: bold; font-size: 20px;" data-filter=".cat--3">Belleza</button>
								<button style="color: #E04456; font-weight: bold; font-size: 20px;" data-filter=".cat--4">Piel</button>-->
							</div>
							<div class="filter__box">
								<a style=" font-weight: bold; font-size: 20px;" class="filter__menu" href="#">filtrar</a>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="another-product-style product__list" id="product__list">
						<!-- Start Single Product -->
						<div v-for="article in articles" :class="'cat--' + article.category.id" class="col-md-3 single__pro col-lg-3 col-sm-4 col-xs-12">
							<div class="product foo">
								<div class="product__inner">
									<div class="pro__thumb">
										<a :href="'<?php echo e(url('shop/product')); ?>/' + article.slug">
											<img v-if="article.main_image != '' && article.main_image != null" :src="'<?php echo e(asset('storage')); ?>/' + article.main_image" alt="article.name">
										</a>
									</div>
									<div class="product__hover__info">
										<ul class="product__action">
											<li><a data-toggle="modal" data-target="#productModal" title="Quick View" class="quick-view modal-view detail-link"href="#" v-on:click="view(article)"><span class="ti-plus"></span></a></li>
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
						<!-- End Single Product -->
					</div>
				</div>
				<!-- Start Load More BTn -->
				<div class="row mt--60">
					<div class="col-md-12">
						<div class="htc__loadmore__btn">
							<a style="color: white; background-color: #E04456; border-radius: 15px; font-weight: bold; font-size: 17px;" href="javascript:void(0)" v-on:click="addMoreArticles()">Cargar Más</a>
						</div>
					</div>
				</div>
				<!-- End Load More BTn -->				
			</div>
		</div>
	</section>
	<!-- End Our Product Area -->

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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/Vue.Isotope-master/dist/vue_isotope.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/Vue.Isotope-master/libs/lodash/lodash.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/Vue.Isotope-master/libs/isotope/isotope.pkgd.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/Vue.Isotope-master/libs/isotope/isotope.pkgd.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/Vue.Isotope-master/src/vue_isotope.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/app/shopList.js')); ?>/?v=<?php echo(rand()); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/website/shop/shopList.blade.php ENDPATH**/ ?>