<?php $__env->startSection('content'); ?>

<!-- Start Contact Area -->
<section class="htc__contact__area ptb--120 bg__white">
	<div class="container" >
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12" style="border:2px solid #e04456; padding: 40px; border-radius: 15px;">
				<div class="htc__contact__container">
					<div class="htc__contact__address">
						<h2 style="color:#e04456; font-weight: bold;" class="contact__title">Información de Contácto</h2>
						<div class="contact__address__inner">
							<!-- Start Single Adress -->
							<div class="single__contact__address">
								<div class="contact__icon">
									<span class="ti-location-pin"></span>
								</div>
								<div class="contact__details">
									<p>Ubicación: <br> Colombia.</p>
								</div>
							</div>
							<!-- End Single Adress -->
						</div>
						<div class="contact__address__inner">
							<!-- Start Single Adress -->
							<div class="single__contact__address">
								<div class="contact__icon">
									<span class="ti-mobile"></span>
								</div>
								<div class="contact__details">
									<p> Teléfono: <br><a href="#">+57 345 678 102 </a></p>
								</div>
							</div>
							<!-- End Single Adress -->
							<!-- Start Single Adress -->
							<div class="single__contact__address">
								<div class="contact__icon">
									<span class="ti-email"></span>
								</div>
								<div class="contact__details">
									<p> Correo:<br><a href="#">womanc@gmail.com</a></p>
								</div>
							</div>
							<!-- End Single Adress -->
						</div>
					</div>
					<div class="contact-form-wrap">
						<div class="contact-title">
							<h2 class="contact__title">Resolveremos cualquier duda</h2>
						</div>
						<form id="contact-form" action="mail.php" method="post">
							<div class="single-contact-form">
								<div class="contact-box name">
									<input type="text" name="name" placeholder="Nombre*">
									<input type="email" name="email" placeholder="Correo*">
								</div>
							</div>
							<div class="single-contact-form">
								<div class="contact-box subject">
									<input type="text" name="subject" placeholder="Asunto*">
								</div>
							</div>
							<div class="single-contact-form">
								<div class="contact-box message">
									<textarea name="message"  placeholder="Mensaje*"></textarea>
								</div>
							</div>
							<div class="contact-btn">
								<button style="background-color: #e04456; border-radius: 20px; color: white;" type="submit" class="fv-btn">Enviar</button>
							</div>
						</form>
					</div> 
					<div class="form-output">
						<p class="form-messege"></p>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
				<div class="map-contacts">
					<div id="googleMap"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Contact Area -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/website/contact.blade.php ENDPATH**/ ?>