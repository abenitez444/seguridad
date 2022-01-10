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
			<?php $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="wrp-cover">
				<!-- Post Thumbnail -->
				<div class="post-thumb">
					<a href="<?php echo e(route('website.blogView', $post->slug)); ?>">
						<img src="<?php echo e($post->getUrlImage()); ?>" alt="" class="img-fluid">
					</a>
				</div>
				<!-- Post Title -->
				<div class="post-title">
					<a href="<?php echo e(route('website.blogView', $post->slug)); ?>"><?php echo e($post->title); ?></a>  
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
			Mas comentados
		</h4>
		<!-- End of Widget Title -->

		<!-- Widget Content -->
		<div class="widget-content" >
			<!-- Post Carousel -->
			<div class="wmcp-cover owl-carousel" data-owl-mouse-drag="true" data-owl-dots="true" data-owl-margin="20">
				<!-- Carousel Item -->
				<?php if(isset($mostCommented[0]) || isset($mostCommented[1])): ?>
				<div class="wmcp-item">
					<!-- Single Post -->
					<?php if(isset($mostCommented[0])): ?>
					<div class="wmc-post" >
						<a href="<?php echo e(route('website.blogView', $mostCommented[0]->slug)); ?>">
							<?php if($mostCommented[0]->image != ''): ?>
							<img src="<?php echo e($mostCommented[0]->getUrlImage()); ?>" alt="" class="img-fluid">
							<?php endif; ?>
						</a>
						<div class="wmc-post-title">
							<h6> <a href="<?php echo e(route('website.blogView', $mostCommented[0]->slug)); ?>"> <?php echo e($mostCommented[0]->title); ?></a></h6>
						</div>
					</div>
					<?php endif; ?>
					<!-- End of Single Post -->
					<!-- Single Post -->
					<?php if(isset($mostCommented[1])): ?>
					<div class="wmc-post" >
						<a href="<?php echo e(route('website.blogView', $mostCommented[1]->slug)); ?>">
							<?php if($mostCommented[1]->image != ''): ?>
							<img src="<?php echo e($mostCommented[1]->getUrlImage()); ?>" alt="" class="img-fluid">
							<?php endif; ?>
						</a>
						<div class="wmc-post-title">
							<h6> <a href="<?php echo e(route('website.blogView', $mostCommented[1]->slug)); ?>"> <?php echo e($mostCommented[1]->title); ?></a></h6>
						</div>
					</div>
					<?php endif; ?>
					<!-- End of Single Post -->
				</div>
				<?php endif; ?>							
				<!-- End of Carousel Item -->

				<!-- Carousel Item -->
				<?php if(isset($mostCommented[3]) || isset($mostCommented[2])): ?>
				<div class="wmcp-item">
					<!-- Single Post -->
					<?php if(isset($mostCommented[2])): ?>
					<div class="wmc-post" >
						<a href="<?php echo e(route('website.blogView', $mostCommented[2]->slug)); ?>">
							<?php if($mostCommented[2]->image != ''): ?>
							<img src="<?php echo e($mostCommented[2]->getUrlImage()); ?>" alt="" class="img-fluid">
							<?php endif; ?>
						</a>
						<div class="wmc-post-title">
							<h6> <a href="<?php echo e(route('website.blogView', $mostCommented[2]->slug)); ?>"> <?php echo e($mostCommented[2]->title); ?></a></h6>
						</div>
					</div>
					<?php endif; ?>
					<!-- End of Single Post -->
					<!-- Single Post -->
					<?php if(isset($mostCommented[3])): ?>
					<div class="wmc-post" >
						<a href="<?php echo e(route('website.blogView', $mostCommented[3]->slug)); ?>">
							<?php if($mostCommented[3]->image != ''): ?>
							<img src="<?php echo e($mostCommented[3]->getUrlImage()); ?>" alt="" class="img-fluid">
							<?php endif; ?>
						</a>
						<div class="wmc-post-title">
							<h6> <a href="<?php echo e(route('website.blogView', $mostCommented[3]->slug)); ?>"> <?php echo e($mostCommented[3]->title); ?></a></h6>
						</div>
					</div>
					<?php endif; ?>
					<!-- End of Single Post -->
				</div>
				<?php endif; ?>							
				<!-- End of Carousel Item -->

				<!-- Carousel Item -->
				<?php if(isset($mostCommented[4]) || isset($mostCommented[5])): ?>
				<div class="wmcp-item">
					<!-- Single Post -->
					<?php if(isset($mostCommented[4])): ?>
					<div class="wmc-post" >
						<a href="<?php echo e(route('website.blogView', $mostCommented[4]->slug)); ?>">
							<?php if($mostCommented[4]->image != ''): ?>
							<img src="<?php echo e($mostCommented[4]->getUrlImage()); ?>" alt="" class="img-fluid">
							<?php endif; ?>
						</a>
						<div class="wmc-post-title">
							<h6> <a href="<?php echo e(route('website.blogView', $mostCommented[4]->slug)); ?>"> <?php echo e($mostCommented[4]->title); ?></a></h6>
						</div>
					</div>
					<?php endif; ?>
					<!-- End of Single Post -->
					<!-- Single Post -->
					<?php if(isset($mostCommented[5])): ?>
					<div class="wmc-post" >
						<a href="<?php echo e(route('website.blogView', $mostCommented[5]->slug)); ?>">
							<?php if($mostCommented[5]->image != ''): ?>
							<img src="<?php echo e($mostCommented[5]->getUrlImage()); ?>" alt="" class="img-fluid">
							<?php endif; ?>
						</a>
						<div class="wmc-post-title">
							<h6> <a href="<?php echo e(route('website.blogView', $mostCommented[5]->slug)); ?>"> <?php echo e($mostCommented[5]->title); ?></a></h6>
						</div>
					</div>
					<?php endif; ?>
					<!-- End of Single Post -->
				</div>	
				<?php endif; ?>

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
			<a href="<?php echo e(route('website.blogByCategory', $category->slug)); ?>" ><?php echo e($category->name); ?></a>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<!-- End of Widget Content -->
	</div>
	<!-- End of Tags Cloud Widget -->
</div><?php /**PATH /opt/lampp/htdocs/paginasOdontologas/AppGestorContenido/resources/views/website/blog/sidebar.blade.php ENDPATH**/ ?>