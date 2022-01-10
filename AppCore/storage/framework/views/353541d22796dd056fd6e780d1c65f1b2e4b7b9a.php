<?php $__env->startSection('content'); ?>
<!--==========================
Intro Section
============================-->
<section id="intro">
	<div class="intro-container">
		<main-slider :storage="folderStorage"></main-slider>
	</div>
</section><!-- #intro -->

<main id="main">
	<!--==========================
	Featured Services Section
	============================-->
	<section id="dr">
		<div class="container">
			<div align="center" style="padding-bottom: 40px;">
				<h2 style="color: #2C3F81; text-align: center; padding: 0; "><strong> DR. FERNANDO BULLA <br> ALCALÁ</strong> </h2>
				<!-- <img src="img/sep.png" width="40%"> -->
			</div>
			<concerning-banners></concerning-banners> 
		</div>
	</section><!-- #featured-services -->

	<!--==========================
	About Us Section
	============================-->

	<section id="nos">
		<element-we :storage="folderStorage"></element-we>
	</section>

	<section id="about">
		<div class="container">

			<div align="center" style="padding-bottom: 40px;">
				<h2 style="color: #2D4081; text-align: center; padding: 0;"><strong>SERVICIOS</strong></h2>
				<!-- <img src="img/sep.png" width="40%"> -->
			</div>

			<div class="row about-cols">
				<servicie-col v-for="serv in services" :key="serv.id" :service="serv" class="col-md-3 boxa wow fadeInUp"></servicie-col>
			</div>
		</div>
	</section><!-- #about -->

	<modal-servicie v-for="serv in services" :key="'modal-servicie-'+serv.id" :service="serv" :storage="folderStorage"></modal-servicie>

	<!--==========================
	Clients Section
	============================-->
	<section style="background-color: #E6E6E6; border-radius: 150px 150px 0 0;">
		<section id="clients" class="wow fadeInUp" style="background-color: white;">
			<div class="container">
				<div align="center" style="padding-bottom: 40px;">
					<h2 style="color: #2D4081; text-align: center; padding: 0;"><strong>CERTIFICACIONES</strong></h2>
					<!-- 	<img src="img/sepa.png" width="40%"> -->
				</div>

				<certification-slider></certification-slider>

			</div>
		</section><!-- #clients -->

		<!--==========================
		Portfolio Section
		============================-->
		<section id="portfolio"  class="section-bg" >
			<div class="container">

				<div class="boxrev" align="center"> 
					<div class="row">
						<div class="col-md-9">
							<div align="left" style="padding-bottom: 40px;">
								<h2 style="color: #2D4081; text-align: left; padding: 0;"><strong>{{ revista.title }}</strong></h2>
								<!-- <img src="img/sepa.png" width="40%"> -->
								<p>{{ revista.content }}</p>
							</div>
						</div>
						<div class="col-md-3">
							<img v-if="revista.image != null" :src="'<?php echo e(asset('storage')); ?>/' + revista.image" width="100%">
						</div>
					</div>
				</div>

				<div class="row portfolio-container">
					<blog-preview-col v-for="p in posts" :key="p.id" :post="p" class="col-lg-6 col-md-6 portfolio-item filter-app wow fadeInUp"></blog-preview-col>
				</div>

			</div>
		</section><!-- #portfolio -->
	</section>

	<!--==========================
	Contact Section
	============================-->
	<section style="background-color: #1063A5;">
		<section id="contact" class="section-bg wow fadeInUp">
			<div class="container">

				<div align="center" style="padding-bottom: 70px;">
					<h2 style="color: #2D4081; text-align: center; padding: 0;"><strong>CONTÁCTANOS</strong></h2>
					<!-- <img src="img/sepa.png" width="40%"> -->
				</div>

				<div class="row">
					<div class="col-md-6 row contact-info">
						<div class="form">
							<div id="sendmessage">Your message has been sent. Thank you!</div>
							<div id="errormessage"></div>
							<form method="post" role="form" class="contactForm" id="contactForm">
								<div class="form-row">
									<div class="form-group col-md-6">
										<input type="text" name="name" class="form-control" id="name" placeholder="Nombre" data-rule="minlen:4" data-msg="Please enter at least 4 chars"  required="required" />
										<div class="validation"></div>
									</div>
									<div class="form-group col-md-6">
										<input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Please enter a valid email"  required="required" />
										<div class="validation"></div>
									</div>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject"  required="required" />
									<div class="validation"></div>
								</div>
								<div class="form-group">
									<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Mensaje" required="required" ></textarea>
									<div class="validation"></div>
								</div>
								<div class="form-group">
									<input type="checkbox" style="border:1px solid black; background: none;" name="" data-rule="required" data-msg="Debe aceptar los términos y condiciones" required /> 
									<label style="color:white; font-size: 15px;"> He leído y acepto los términos y condiciones<label>
									<div class="validation"></div>
								</div>
									<div class="form-group text-center">
										<div  class="g-recaptcha" data-sitekey="6LdbCq4UAAAAANdIkOZ3ZbNHJwkV5FdaJraZE8hE" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
										<input class="form-control d-none" data-recaptcha="true" id="capa" name="capa">
										<div class="help-block with-errors"></div>
									</div>

									<div class="row" v-if="errorMessageContact  != ''">
										<div class="col-12 col-md-12">
											<div class="alert alert-danger" role="alert">
												{{ errorMessageContact }}	
											</div>
										</div>
									</div>
									<input type="hidden" name="type" value="contact">
									<div class="text-center"><button type="submit">Enviar</button></div>
								</form>
							</div>
						</div>

						<div class="col-md-6" align="center">
							<iframe id="maps-google" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.4251050266075!2d-74.03385898583191!3d4.69596724300758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9aa80cdb74a3%3A0x18c1aa5fba787d2f!2sCentro+M%C3%A9dico+de+la+Sabana!5e0!3m2!1ses!2sve!4v1563414741083!5m2!1ses!2sve" width="600" height="450" frameborder="0" style=" width: 320px; height: 320px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; overflow:hidden; position:relative;border-color: #1063a5;" allowfullscreen></iframe>
							<img src="img/map-bo.png" width="30%" style="padding: 20px 0;">
						</div>
					</div>
				</div>
			</section>
		</section>

	</main>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/drbulla/AppGestorContenido/resources/views/website/index.blade.php ENDPATH**/ ?>