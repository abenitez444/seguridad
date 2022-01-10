<?php $__env->startPush('css'); ?>
<style type="text/css">
	.btn-outline-primary {
		color: #8cc63f;
		background-color: transparent;
		background-image: none;
		border-color: #8cc63f;
	}

	.btn-outline-primary:not([disabled]):not(.disabled).active, .btn-outline-primary:not([disabled]):not(.disabled):active, .show>.btn-outline-primary.dropdown-toggle {
		color: #fff;
		background-color: #8cc63f;
		border-color: #8cc63f;
		box-shadow: 0 0 0 0.2rem #8cc63f;
	}

	.btn-outline-primary:hover {
		color: #fff;
		background-color: #8cc63f;
		border-color: #8cc63f;
	}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<my-nav :subcategories="null"></my-nav>
<invoice :currency="currency" :money="money"></invoice>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
	const IDUSER = "<?php echo e(auth()->user()->id); ?>";
	const CODE = "<?php echo e($code); ?>";
</script>
<script type="text/javascript" src="<?php echo e(asset('js/app/thanks.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/ez/AppGestorContenido/resources/views/website/shop/viewInvoice.blade.php ENDPATH**/ ?>