<?php $__env->startSection('title'); ?>Dashboard <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Page Header
		<small>Optional description</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard active"></i> Dashboard</a></li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid">



</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>