<?php $__env->startSection('title'); ?>Geocalización <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Estaciones</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item active">Geocalización</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 cl-md-12 col-lg-12">
				<div class="card">
					<div id="mapCanvas" style="position: initial !important;"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMjG5iwTKSm3RYevJtihqumQg5rWd8X3k"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFexqrPrudnF0bo5mzmQ1TmDCnVf6U83E"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/icg/AppCore/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>