<?php $__env->startSection('content'); ?>
<?php $__env->startPush('css'); ?>
<style type="text/css">
	.single-checkout-box {
		border-radius: 20px;
	}
</style>
<?php $__env->stopPush(); ?>
<my-nav :subcategories="null"></my-nav>


<profile style="margin-top: 30px" :currency="currency" :money="money"></profile>
<!-- End Checkout Area -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">const USER = {id: "<?php echo e(Auth::user()->id); ?>", name: "<?php echo e(Auth::user()->name); ?>", email: "<?php echo e(Auth::user()->email); ?>"}; console.log(USER);</script>
<script type="text/javascript" src="<?php echo e(asset('js/app/porfile.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/ez/AppGestorContenido/resources/views/website/auth/showProfile.blade.php ENDPATH**/ ?>