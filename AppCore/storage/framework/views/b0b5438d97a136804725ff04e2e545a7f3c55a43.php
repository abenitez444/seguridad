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
								<a href="<?php echo e(route('website.blogView', $post->slug)); ?>">
									<?php if($post->image != ''): ?>
										<img src="<?php echo e($post->getUrlImage()); ?>" alt="" class="img-fluid">
									<?php endif; ?>
								</a>
							</div>
							<div class="post-data">
								<!-- Category -->
								<div class="cats">
									<?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<a href="<?php echo e(route('website.blogByCategory', $category->slug)); ?>"> <?php echo e($category->name); ?></a>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								
								<!-- Title -->
								<div class="title">
									<h2><a href="<?php echo e(route('website.blogView', $post->slug)); ?>"><?php echo e($post->title); ?></a></h2>
								</div>
								<!-- Post Desc -->
								<div class="desc">
									<p>
										<?php
											$content_short = trim(strip_tags(substr( $post->content, 0,100)));
											$content_short .= ' ...';
											echo $content_short;
										?>
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
				<?php if($publications->currentPage() > 1): ?>
					<a href="<?php echo e($publications->previousPageUrl()); ?>">
						<i class="fa fa-angle-left"></i>
					</a>
				<?php endif; ?>
				
				<?php for($i = 1; $i <= $publications->lastPage(); $i++): ?>
					<?php if($i == $publications->currentPage()): ?>
						<span class="current"><?php echo e($i); ?></span>
					<?php else: ?>
						<a href=""><?php echo e($i); ?></a>
					<?php endif; ?>					
				<?php endfor; ?>
				<?php if($publications->currentPage() < $publications->lastPage()): ?>
					<a href="<?php echo e($publications->nextPageUrl()); ?>" >
						<i class="fa fa-angle-right"></i>
					</a>
				<?php endif; ?>
			</div>
			<!-- End of Post Pagination -->
		</div>

		<div class="col-lg-4">
			<?php echo $__env->make('website.blog.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

    <script type="text/javascript" src="<?php echo e(asset('js/blogList.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/paginasOdontologas/AppGestorContenido/resources/views/website/blog/list.blade.php ENDPATH**/ ?>