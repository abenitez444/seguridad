<?php $__env->startSection('title'); ?><?php echo e($hiring->title); ?> | <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<header style="background-image: url(<?php echo e($infoPage->getUrlImage()); ?>);" id="header-contratacion">
</header>


<section>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading"><?php echo e($hiring->title); ?></h2>
          <h5><?php echo e($hiring->description); ?></h5>
            <div class="link_documents">
            	<?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a href="<?php echo e($file->getUrlFile()); ?>" target="__blank"><h6><img src="<?php echo e(asset('images/pdf-icon-2.png')); ?>" width="35"><?php echo e($file->name); ?></h6></a>
            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>              
            </div>
          </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/website/showContratacion.blade.php ENDPATH**/ ?>