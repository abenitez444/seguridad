<?php $__env->startPush('css'); ?>
<style type="text/css">
	.page-link {
	    color: #8cc63f;
	    text-decoration: none;
	    background-color: #e9ecef;
	    border-color: #ddd;
	}
	.page-link:hover {
	    color: var(--verdozo);
	    text-decoration: none;
	    background-color: #e9ecef;
	    border-color: #ddd;
	}

</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<my-nav :subcategories="subCategories"></my-nav>

<shop-list :currency="currency" :money="money"></shop-list>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/app/shopList.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/ez/AppGestorContenido/resources/views/website/shop/shopList.blade.php ENDPATH**/ ?>