<?php $__env->startSection('content'); ?>

<!-- Contáctanos -->
  <section class="contactanos ">
    <div class="container">
      <div class="row">
        <div class="col-sm">
            <h1>Contáctanos</h1>
            <h5>
                Lorem ipsum adipisicing elit. <br>
                Lorem ipsum
                <br><br>
                +1 334 2313581
                <br>
                +880 167 1043
                <br>
                cappserito@gmail.com

            </h5>
        </div>
        <div class="col-sm">
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Apellido" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <textarea class="textarea form-control" id="validationTextarea" placeholder="Mensaje" required></textarea>
                    <div class="invalid-feedback">
                    </div>
                </di>
                <br>
                <div class="text-right">
                    <button type="submit" class="btn boton-enviar">Enviar</button>
                </di>
            </form>
            
        </div>
      </div>
    </div>
  </section>
  

  <section>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d51603.23385813494!2d-74.09729622836802!3d4.6955518780298835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9bfd2da6cb29%3A0x239d635520a33914!2sBogot%C3%A1%2C%20Colombia!5e0!3m2!1ses!2sve!4v1575559616242!5m2!1ses!2sve" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
  </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/website/contacto.blade.php ENDPATH**/ ?>