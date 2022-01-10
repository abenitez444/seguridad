<?php $__env->startPush('css'); ?>
<style type="text/css">
	.single-checkout-box {
		border-radius: 20px;
	}
	th {
	    text-align: center;
	    font-size: 11px;
	    line-height: 2;
	}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<my-nav :subcategories="null"></my-nav>
<!--INICIO CHECKOUT -->
<my-checkout :currency="currency" :money="money"></my-checkout>
<!-- End Checkout Area -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
	const IDUSER = "<?php echo e(auth()->user()->id); ?>";
</script>
<script type="text/javascript" src="<?php echo e(asset('js/app/checkout.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/ez/AppGestorContenido/resources/views/website/shop/checkout.blade.php ENDPATH**/ ?>