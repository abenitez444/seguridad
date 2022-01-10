<?php $__env->startSection('content'); ?>

<div id="contentArticle">
	<!-- Start Bradcaump area -->
	<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(<?php echo e(asset('images/bg/2.jpg')); ?>) no-repeat scroll center center / cover ;">
		<div class="ht__bradcaump__wrap">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="bradcaump__inner text-center">
							<h2 class="bradcaump-title">{{ article.name }}</h2>
							<nav class="bradcaump-inner">
								<a class="breadcrumb-item" href="<?php echo e(route('website.index')); ?>">Home</a>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">{{ article.name }}</span>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Bradcaump area -->
	<!-- Start Product Details -->
	<section class="htc__product__details pt--120 pb--100 bg__white" v-if="article != ''">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
					<div class="product__details__container">
						<!-- Start Small images -->
						<ul class="product__small__images" role="tablist">
							<li role="presentation" class="pot-small-img active">
								<a :href="'#img-tab-' + article.slug" role="tab" data-toggle="tab">
									<img v-if="article.main_image != '' && article.main_image != null" :src="'<?php echo e(asset('storage')); ?>/' + article.main_image" :alt="article.name">
								</a>
							</li>

							<li role="presentation" class="pot-small-img" v-for="image in article.gallery">
								<a :href="'#img-tab-' + image.id" role="tab" data-toggle="tab">
									<img v-if="image.url_path != '' && image.url_path != null" :src="'<?php echo e(asset('storage')); ?>/' + image.url_path" :alt="article.name">
								</a>
							</li>
						</ul>
						<!-- End Small images -->
						<div class="product__big__images">
							<div class="portfolio-full-image tab-content">
								<div role="tabpanel" class="tab-pane fade in product-video-position active" :id="'img-tab-' + article.slug">
									<img v-if="article.main_image != '' && article.main_image != null" :src="'<?php echo e(asset('storage')); ?>/' + article.main_image" :alt="article.name">
								</div>
								<div role="tabpanel" class="tab-pane fade in product-video-position" v-for="image in article.gallery" :class="image.firstItem == true ? 'active' : '' " :id="'img-tab-' + image.id">
									<img v-if="image.url_path != '' && image.url_path != null" :src="'<?php echo e(asset('storage')); ?>/' + image.url_path" :alt="article.name">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
					<div class="htc__product__details__inner">
						<div class="pro__detl__title">
							<h2>{{ article.name }}</h2>
						</div>
						<div class="pro__dtl__rating">
							<ul class="pro__rating">
								<li><span class="ti-star"></span></li>
								<li><span class="ti-star"></span></li>
								<li><span class="ti-star"></span></li>
								<li><span class="ti-star"></span></li>
								<li><span class="ti-star"></span></li>
							</ul>
							<span class="rat__qun">(Based on 0 Ratings)</span>
						</div>
						<div class="pro__details">
							<p>{{ article.description }} </p>
						</div>
						<ul class="pro__dtl__prize">
							<li class="old__prize">
								{{ currency.symbol }} {{ article.previous_price }}
								<money type="hidden" v-model="article.previous_price"  v-bind="money">{{ article.previous_price }}</money>
							</li>
							<li>
								{{ currency.symbol }} {{ article.price }}
								<money type="hidden" v-model="article.price"  v-bind="money">{{ article.price }}</money>
							</li>
						</ul>
						<!--<div class="pro__dtl__color">
							<h2 class="title__5">Choose Colour</h2>
							<ul class="pro__choose__color">
								<li class="red"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
								<li class="blue"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
								<li class="perpal"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
								<li class="yellow"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
							</ul>
						</div>
						<div class="pro__dtl__size">
							<h2 class="title__5">Size</h2>
							<ul class="pro__choose__size">
								<li><a href="#">xl</a></li>
								<li><a href="#">m</a></li>
								<li><a href="#">ml</a></li>
								<li><a href="#">lm</a></li>
								<li><a href="#">xxl</a></li>
							</ul>
						</div>-->
						<div class="product-action-wrap">
							<div class="prodict-statas"><span>Cantidad :</span></div>
							<div class="product-quantity">
								<div class="product-quantity">
									<div class="cart-plus-minus">
										<money type="text" class="cart-plus-minus-box" v-model="cantArticle"  v-bind="numberInt"></money>
									</div>
								</div>
							</div>
						</div>
						<ul class="pro__dtl__btn">
							<li class="buy__now__btn"><a href="javascript:void(0)" v-on:click="addCart(article)">Comprar ahora</a></li>
							<li><a href="#"><span class="ti-heart"></span></a></li>
							<li><a href="#"><span class="ti-email"></span></a></li>
						</ul>
						<div class="pro__social__share">
							<h2>Compartir :</h2>
							<ul class="pro__soaial__link">
								<li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
								<li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
								<li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
								<li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Product Details -->
	<!-- Start Product tab -->
	<section class="htc__product__details__tab bg__white pb--120">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<ul class="product__deatils__tab mb--60" role="tablist">
						<li role="presentation" class="active">
							<a href="#description" role="tab" data-toggle="tab">Descripción</a>
						</li>
						<li role="presentation">
							<a href="#specifications" role="tab" data-toggle="tab">Especificaciones</a>
						</li>
						<!--<li role="presentation">
							<a href="#reviews" role="tab" data-toggle="tab">Reviews</a>
						</li>-->
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="product__details__tab__content">
						<!-- Start Single Content -->
						<div role="tabpanel" id="description" class="product__tab__content fade in active">
							<div class="product__description__wrap">
								<div class="product__desc">
									<h2 class="title__6">Descripción</h2>
									<p>{{ article.description }}</p>
								</div>
							</div>
						</div>
						<!-- End Single Content -->
						<!-- Start Single Content -->
						<div role="tabpanel" id="specifications" class="product__tab__content fade">
							<div class="pro__feature">
								<h2 class="title__6">Especificaciones</h2>
								<p>
									{{ article.specifications }}
								</p>
							</div>
						</div>
						<!-- End Single Content -->
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">const article_slug = "<?php echo e($slug_product); ?>";</script>
<script type="text/javascript" src="<?php echo e(asset('js/app/showProduct.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/website/shop/showProduct.blade.php ENDPATH**/ ?>