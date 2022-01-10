<?php $__env->startPush('css'); ?>
	<!--==== Animate CSS ====-->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/animate/animate.min.css')); ?>">

    <!--==== Owl Carousel ====-->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/owl-carousel/owl.carousel.min.css')); ?>">

    <!--==== Magnific Popup ====-->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/magnific-popup/magnific-popup.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/blog-style.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container pt-120 pb-90" id="componet">
	<div class="row">

		<div class="col-lg-8 pb-50">
			<div class="row">
				<?php $__currentLoopData = $publications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-sm-6 col-md-6 col-lg-6">
						<!-- Post -->
						<div class="post-default">
							<div class="post-thumb">
								<a href="blog-details.html">
									<?php if($post->image != ''): ?>
										<img src="<?php echo e($post->getUrlImage()); ?>" alt="<?php echo e($post->title); ?>" class="img-fluid">
									<?php endif; ?>									
								</a>
							</div>
							<div class="post-data">
								<!-- Category -->
								<div class="cats">
									<?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<a href="category-result.html" > <?php echo e($category->name); ?></a>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<!-- Title -->
								<div class="title">
									<h2><a href="blog-details.html"><?php echo e($post->title); ?></a></h2>
								</div>
								<!-- Post Desc -->
								<div class="desc">
									<p>
										Duis mauris augue, efficitur eu arcu sit amet, posuere dignissim neque. Aenean enim sem, pharetra et magna....
									</p>
								</div>
							</div>
						</div>
						<!-- End of Post -->
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				
			</div>

			<!-- Post Pagination -->
			<div class="post-pagination d-flex justify-content-center">
				<span class="current">1</span>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#"><i class="fa fa-angle-right"></i></a>
			</div>
			<!-- End of Post Pagination -->
		</div>

		<div class="col-lg-4">
			<div class="my-sidebar">

				<!-- Recent Post Widget -->
				<div class="widget widget-recent-post">
					<!-- Widget Title -->
					<h4 class="widget-title">
						Publicaciónes recientes
					</h4>
					<!-- End of Widget Title -->

					<!-- Widget Content -->
					<div class="widget-content">
						<!-- Single Post -->
						<?php $__currentLoopData = $recentPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="wrp-cover" v-for="post in recentPost">
								<!-- Post Thumbnail -->
								<div class="post-thumb">
									<a href="blog-details.html">
										<?php if($post->image != ''): ?>
											<img src="<?php echo e($post->getUrlImage()); ?>" alt="" class="img-fluid">
										<?php endif; ?>
									</a>
								</div>
								<!-- Post Title -->
								<div class="post-title">
									<a href="blog-details.html"><?php echo e($post->title); ?></a>  
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>						
					</div>
					<!-- End of Widget Content -->
				</div>
				<!-- End of Recent Post Widget -->

				<!-- Most Commented Post Widget -->
				<div class="widget widget-most-commented-post">
					<!-- Widget Title -->
					<h4 class="widget-title">
						Most Commented Post
					</h4>
					<!-- End of Widget Title -->

					<!-- Widget Content -->
					<div class="widget-content">
						<!-- Post Carousel -->
						<div class="wmcp-cover owl-carousel" data-owl-mouse-drag="true" data-owl-dots="true" data-owl-margin="20">
							<!-- Carousel Item -->
							<div class="wmcp-item">
								<!-- Single Post -->
								<div class="wmc-post">
									<a href="blog-details.html">
										<img src="assets/images/sidebar/mcp-1.jpg" alt="" class="img-fluid">
									</a>
									<div class="wmc-post-title">
										<h6> <a href="blog-details.html"> Understanding The Background Of Fashion </a></h6>
									</div>
								</div>
								<!-- End of Single Post -->

								<!-- Single Post -->
								<div class="wmc-post">
									<a href="blog-details.html">
										<img src="assets/images/sidebar/mcp-2.jpg" alt="" class="img-fluid">
									</a>
									<div class="wmc-post-title">
										<h6> <a href="blog-details.html">12-inch MacBook Refurb $830, Apple Watch Series</a> </h6>
									</div>
								</div>
								<!-- End of Single Post -->
							</div>
							<!-- End of Carousel Item -->

							<!-- Carousel Item -->
							<div class="wmcp-item">
								<!-- Single Post -->
								<div class="wmc-post">
									<a href="blog-details.html">
										<img src="assets/images/sidebar/mcp-1.jpg" alt="" class="img-fluid">
									</a>
									<div class="wmc-post-title">
										<h6> <a href="blog-details.html"> Understanding The Background Of Fashion </a></h6>
									</div>
								</div>
								<!-- End of Single Post -->

								<!-- Single Post -->
								<div class="wmc-post">
									<a href="blog-details.html">
										<img src="assets/images/sidebar/mcp-2.jpg" alt="" class="img-fluid">
									</a>
									<div class="wmc-post-title">
										<h6> <a href="blog-details.html">12-inch MacBook Refurb $830, Apple Watch Series</a> </h6>
									</div>
								</div>
								<!-- End of Single Post -->
							</div>
							<!-- End of Carousel Item -->

							<!-- Carousel Item -->
							<div class="wmcp-item">
								<!-- Single Post -->
								<div class="wmc-post">
									<a href="blog-details.html">
										<img src="assets/images/sidebar/mcp-1.jpg" alt="" class="img-fluid">
									</a>
									<div class="wmc-post-title">
										<h6> <a href="blog-details.html"> Understanding The Background Of Fashion </a></h6>
									</div>
								</div>
								<!-- End of Single Post -->

								<!-- Single Post -->
								<div class="wmc-post">
									<a href="blog-details.html">
										<img src="assets/images/sidebar/mcp-2.jpg" alt="" class="img-fluid">
									</a>
									<div class="wmc-post-title">
										<h6> <a href="blog-details.html">12-inch MacBook Refurb $830, Apple Watch Series</a> </h6>
									</div>
								</div>
								<!-- End of Single Post -->
							</div>
							<!-- End of Carousel Item -->
						</div>
						<!-- End of Post Carousel -->

					</div>
					<!-- End of Widget Content -->
				</div>
				<!-- End of Most Commented Post Widget -->

				<!-- Tags Cloud Widget -->
				<div class="widget widget-tag-cloud">
					<!-- Widget Title -->
					<h4 class="widget-title">
						Categorías
					</h4>
					<!-- End of Widget Title -->

					<!-- Widget Content -->
					<div class="widget-content tagcloud">
						<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a href="#"><?php echo e($category->name); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>						
					</div>
					<!-- End of Widget Content -->
				</div>
				<!-- End of Tags Cloud Widget -->
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
	<!-- ==== Bootstrap js file ==== -->
    <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- ==== Owl Carousel ==== -->
    <script src="<?php echo e(asset('plugins/owl-carousel/owl.carousel.min.js')); ?>"></script>

    <!-- ==== Magnific Popup ==== -->
    <script src="<?php echo e(asset('plugins/magnific-popup/jquery.magnific-popup.min.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/paginasOdontologas/AppGestorContenido/resources/views/website/blog/list2.blade.php ENDPATH**/ ?>