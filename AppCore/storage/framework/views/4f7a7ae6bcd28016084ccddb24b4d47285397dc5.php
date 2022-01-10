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
			<div class="post-details-cover">
                <!-- Post Thumbnail -->
                <div class="post-thumb-cover">
                    <div class="post-thumb">
                        <img src="<?php echo e($post->getUrlImage()); ?>" alt="" class="img-fluid">
                    </div>
                    <!-- Post Meta Info -->
                    <div class="post-meta-info">
                        <!-- Category -->
                        <p class="cats">
                        	<?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            	<a href="<?php echo e(route('website.blogByCategory', $category->slug)); ?>"><?php echo e($category->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </p>

                        <!-- Title -->
                        <div class="title">
                            <h2><?php echo e($post->title); ?></h2>
                        </div>

                        <!-- Meta -->
                        <ul class="nav meta align-items-center">
                            <li class="meta-author">
                                <a href="#"><?php echo e($post->author->name); ?></a>
                            </li>
                            <li class="meta-date"><a href="#"><?php echo e($post->updated_at); ?></a></li>
                            <li> 2 min read </li>
                            <li class="meta-comments"><a href="#"><i class="fa fa-comment"></i> <?php echo e($post->comments_count); ?></a></li>
                        </ul>
                    </div>
                    <!-- End of Post Meta Info -->
                </div>
                <!-- End oF Post Thumbnail -->

                <!-- Post Content -->
                <div class="post-content-cover my-drop-cap">
                	<?php
					    $doc = new DOMDocument();
					    $doc->loadHTML('<?xml encoding="UTF-8">'.$post->content );
					    $doc->encoding = 'UTF-8';
					    echo $doc->saveHTML();
					?>
                </div>

                <!-- Tags -->
                <div class="post-all-tags">
                    <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    	<a href="<?php echo e(route('website.blogByCategory', $category->slug)); ?>"><?php echo e($category->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!-- End of Tags -->

                <!-- Author Box -->
                <div class="post-about-author-box">
                    <div class="author-avatar">
                        <img src="<?php echo e($post->author->getUrlImage()); ?>" alt="" class="img-fluid">
                    </div>
                    <div class="author-desc">
                        <h5> <a href="#"> <?php echo e($post->author->name); ?> </a> </h5>
                        <div class="description">
                        </div>
                        <div class="social-icons">
                        	<?php $__currentLoopData = $post->author->socialsNetworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            <a href="<?php echo e($social->url.'/'.$social->pivot->name_user); ?>"><i class="<?php echo e($social->ico); ?>"></i></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <!-- End of Author Box -->
                
                <?php if($post->comments_count > 0): ?>
                	<div id="comments">
                		<!-- Comments -->
		                <button class="btn btn-comment" type="button" data-toggle="collapse" data-target="#commentToggle" aria-expanded="false" aria-controls="commentToggle" @click.prevent="changeViewComments()">
		                    Ocultar comentarios (<?php echo e($post->comments_count); ?>) <i class="fa fa-arrow-down" v-if="viewComments"></i>
		                    <i class="fa fa-arrow-right" v-if="!viewComments"></i>
		                </button>

		                <div class="collapse show" id="commentToggle" v-if="viewComments">
		                    <ul class="post-all-comments">
		                    	<?php $__currentLoopData = $post->comments()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                    	<?php if($comment->is_active == 1 && $comment->status == 'approved'): ?>
			                    		<li class="single-comment-wrapper">
				                            <!-- Single Comment -->
				                            <div class="single-post-comment">
				                                <!-- Author Image -->
				                                <div class="comment-author-image">
				                                    <img src="<?php echo e($comment->user->getUrlImage()); ?>" alt="" class="img-fluid">
				                                </div>
				                                <!-- Comment Content -->
				                                <div class="comment-content">
				                                    <div class="comment-author-name">
				                                        <h6><?php echo e($comment->user->name); ?></h6> <span> <?php echo e($comment->created_at); ?></span>
				                                    </div>
				                                    <p><?php echo e($comment->text); ?></p>
				                                    <!--<a href="#" class="reply-btn">Reply</a>-->
				                                </div>
				                            </div>
				                            <!-- End of Single Comment -->
				                            <!--<ul class="children">
				                                <li class="single-comment-wrapper">
				                                    <div class="single-post-comment">
				                                        <div class="comment-author-image">
				                                            <img src="assets/images/blog/post/author-1-1.jpg" alt="" class="img-fluid">
				                                        </div>
				                                        <div class="comment-content">
				                                            <div class="comment-author-name">
				                                                <h6>Helen Sharp</h6> <span> 5 Jan 2019 at 6:58 pm </span>
				                                            </div>
				                                            <p>On recommend tolerably my belonging or am. Mutual has cannot back beauty indeed now back sussex merely you. </p>
				                                            <a href="#" class="reply-btn">Reply</a>
				                                        </div>
				                                    </div>
				                                </li>
				                            </ul>-->
				                        </li>
			                        <?php endif; ?>
		                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                    </ul>
		                </div>
		                <!-- End of Comments -->
                	</div>
                	
                <?php endif; ?>
	
				<?php if($post->allow_comments): ?>
	                <!-- Comment Form -->
	                <div class="post-comment-form-cover" id="componentComment">  
	                    <h3>Escriba su comentario</h3>
	                    <form class="comment-form" id="form_comment" onsubmit="return false" @submit.prevent="sendComment()">
	                        <div class="row">
	                            <div class="col-md-6">
	                                <input type="text" required="required" name="name" v-model="name" class="form-control" placeholder="Nombre completo">
	                                <input type="hidden" name="publication_id" value="<?php echo e($post->id); ?>">
	                            </div>
	                            <div class="col-md-6">
	                                <input type="email" required="required" name="email" v-model="email" class="form-control" placeholder="Email">
	                            </div>
	                            <div class="col-md-12">
	                                <textarea class="form-control" placeholder="Escriba su comentario" name="text" required="required" v-model="text"></textarea>
	                            </div>
	                            <div class="col-md-12" id="msgFormComment">
	                                
	                            </div>
	                            <div class="col-md-12">
	                                <button type="submit" class="btn btn-primary" id="btn-save" :disabled="sending == true">
										<template v-if="!sending">
											<i class="fa fa-send"></i> Enviar
										</template>
										<template v-if="sending">
											<i class="fa fa-spinner fa-spin"></i>
										</template>
									</button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	                <!-- End of Comment Form -->
                <?php endif; ?>
            </div>
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

    <script type="text/javascript" src="<?php echo e(asset('js/blogView.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/paginasOdontologas/AppGestorContenido/resources/views/website/blog/view.blade.php ENDPATH**/ ?>