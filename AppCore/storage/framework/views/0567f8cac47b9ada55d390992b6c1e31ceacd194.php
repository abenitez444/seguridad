<?php $__env->startSection('title'); ?>Dashboard <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section>
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-12 col-sm-12 col-md-12">
				<h1>Dashboard</h1>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>