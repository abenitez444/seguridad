$(document).ready(function(){
    var component = new Vue({
    el: '#agency',
    created:  function(){
        
    },

    data: {
        email: '',
        password: '',
        sending: false,
        errors: '',
        typeForm : 1,
    },
    methods: {
        login: function(data){
            console.log(data);
            if (this.typeForm == 2) {
                this.recoverPass();
                return false;
            }
            var url = 'business';
            this.sending = true;
            axios.post(url, data).then(response => {
                console.log(response);
                this.sending = false;
                Swal.fire({
                    title: '¡Acceso completado!',
                    text: "Se ha iniciado sesión con éxito.",
                    icon: 'success',
                });
                // swal("Acceso completado!", "Se ha iniciado sesión con éxito.", "success");
                location.href = APP_URL + '/';
            }).catch(error => {
                console.log(error.response.data);
                this.errors = error.response.data;
                this.sending = false;
                Swal.fire({
                    title: '¡Error!',
                    text: error.message,
                    icon: 'error',
                });
                // swal("¡Error!", this.errors.errors, "error");
            });
        },
        recoverPass()
        {
            var url = APP_URL + '/auth/recoverPass';
            this.sending = true;
            axios.post(url, {'email': this.email}).then(response => {
                swal("Enviado con éxito!", "Se ha enviado su nueva contraseña de acceso a su correo.", "success");
                this.typeForm = 1;
                this.sending = false;
            }).catch(error => {
                this.sending = false;
                this.errors = error.response.data;
                swal("¡Error!", this.errors.errors, "error");
            });
        }
    }
});

jQuery('#form_').validate({
    errorClass: 'help-block',
    errorElement: 'div',
    errorPlacement: function(error, e) {
        jQuery(e).parents('.form-group').append(error);
    },
    highlight: function(e) {
        jQuery(e).closest('.form-group').removeClass('success').addClass('error');
        jQuery(e).closest('.form-group')
        .children('.input-group')
        .children('.form-control')
        .removeClass('is-valid')
        .addClass('is-invalid')
    },
    success: function(e) {
        jQuery(e).closest('.form-group').removeClass('error');
        jQuery(e).closest('.form-group').addClass('success');
        jQuery(e).closest('.form-group')
        .children('.input-group')
        .children('.form-control')
        .removeClass('is-invalid')
        .addClass('is-valid')
        jQuery(e).remove();
    },
    submitHandler: function(form) {
        component.login(jQuery("#form_").serialize());
    },
    rules: {
        'email': {
            required: true,
            email: true,
        },
        'password': {
            required: true,
            minlength: 6,
            maxlength: 10
        }
    },
    messages: {
        'email':{
            required: 'Este Campo es obligatorio.',
            email: 'El email ingresado es inválido'
        },
        'password': {
            required: 'Este Campo es obligatorio.',
            minlength: 'El campo debe tener una longitud entre 6 y 10 carácteres.',
            maxlength: 'El campo debe tener una longitud entre 6 y 10 carácteres.'
        }
    }
});
})