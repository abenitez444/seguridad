<?php $__env->startSection('title'); ?>Estadísticas <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="container-fluid">
			<div class="page-title-box">
				<div class="row align-items-center">
		
					<?php if(Auth::user()->is_admin): ?>
						<div class="col-sm-6 col-xl-3">
							<div class="card">
								<div class="card-heading p-4">
									<div class="mini-stat-icon float-right">
										<i class="mdi mdi-account-multiple-outline bg-primary  text-white"></i>
									</div>
									<div>
										<h5 class="font-16">Conjuntos Residenciales</h5>
									</div>
									<h3 class="mt-4"><?php echo e($residentials); ?></h3>
								</div>
							</div>
						</div>
					<?php else: ?>
						<div class="col-12 col-md-4 col-sm-6 col-lg-4">
							<div class="card">
								<div class="card-heading p-4">
									<div class="mini-stat-icon float-right">
										<i class="mdi mdi-home-group bg-primary  text-naranja"></i>
									</div>
									<div>
										<h5 class="font-16">Apartamentos</h5>
									</div>
									<h3 class="mt-4"><?php echo e($dataResidential['total_departaments']); ?></h3>
								</div>
							</div>
						</div>
						<?php $__currentLoopData = $dataResidential['zones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-12 col-md-4 col-sm-6 col-lg-4">
								<div class="card">
									<div class="card-heading p-4">
										<div class="mini-stat-icon float-right">
											<i class="<?php echo e($zone->class_ico); ?> bg-primary  text-naranja"></i>
										</div>
										<div>
											<h5 class="font-16"><?php echo e($zone->element_name); ?></h5>
										</div>
										<h3 class="mt-4"><?php echo e($zone->count); ?></h3>
									</div>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
			<img src="<?php echo e(asset('AppResources/images/logo3.png')); ?>" style="max-width: 60%;">
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/chart.js/dist/Chart.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>