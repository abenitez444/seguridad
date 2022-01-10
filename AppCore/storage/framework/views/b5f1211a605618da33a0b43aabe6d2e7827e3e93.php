<?php $__env->startSection('content'); ?>
<my-nav :subcategories="null"></my-nav>

<content-article :currency="currency" :money="money"></content-article>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">const article_slug = "<?php echo e($slug_product); ?>";</script>
<script type="text/javascript" src="<?php echo e(asset('js/app/showProduct.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/ez/AppGestorContenido/resources/views/website/shop/showProduct.blade.php ENDPATH**/ ?>