<?php $__env->startSection('title'); ?>Manuales <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="page-title-box">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<h4 class="page-title">
					Manuales
				</h4>

			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>/">Estadísticas</a></li>
					<li class="breadcrumb-item active">Manuales</li>
				</ol>
			</div>
		</div> <!-- end row -->
	</div>


	<div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                	<?php if(is_null($manuales)): ?>
                		<h2>No tiene manuales asignados.</h2>
                	<?php else: ?>
                		<div class="row">
	                		<?php $__currentLoopData = $manuales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                			<div class="col-12 col-sm-4 col-md-3 col-lg-3">
	                				<a href="<?php echo e(route('showManual', $manual->id)); ?>">
	                					<div class="row">
		                					<div class="col-12 col-md-12 text-center img-manual">
		                						<img src="<?php echo e(asset('storage')); ?>/<?php echo e($manual->image); ?>">
		                					</div>
		                					<div class="col-12 col-md-12 text-center">
		                						<h5><?php echo e($manual->title); ?></h5>
		                					</div>
		                				</div>
		                			</a>
	                				
	                			</div>
	                		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                		</div>
                	<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/chart.js/dist/Chart.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/listManuales.blade.php ENDPATH**/ ?>