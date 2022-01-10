new Vue({
	el: '#app-main',
	data: {
		loading: true,
		sending: false,
		action: 'save',
		user: {
			image: null,
			name: '',
			last_name: '',
			dni: '',
			email: '',
			phone: '',
			last_name: '',
			address: '',
			password: '',
			password2: '',
			postal_code: '',
		},
		changePassword: 0,
		changePassword2: 0,
		changeImage: 0,
	},
	created() {
		// this.defaultData();
		this.loading = true;
	},
	methods: {
		showErrorMessage: function(messages = []){
        	this.errorMessage = '';
        	for (var i = 0; i < messages.length; i++) {
        		this.errorMessage += '<b>' + (i + 1) + '. ' + messages[i] + '</b><br/>';
        	}
        	Swal.fire({
                title: '¡Error!',
                html: this.errorMessage,
                icon: 'error',
            });
        },
        getProfile(){
        	var url = '/admin_/users/getProfile';
        	axios.get(url).then(response => {
        		this.view(response.data);
        		this.loading = false;
        	}).catch(error => {
        		this.loading = false;
        	});
        },
		view(user) {
			this.action = 'update';
			this.user = user;
			$('#image .dropify-clear').trigger('click');
			this.changeImage = 0;
			this.changePassword = 0;
			this.changePassword2 = 0;
			this.user.password = '********';
			this.user.password2 = '********';
			if (this.user.image != '' && (typeof this.user.image === 'string')) {
				var path = this.user.image;
				this.changeImage = 1;
				var image_split = path.split('.');
				var image_type = image_split[image_split.length - 1];
				var image_name = image_split[image_split.length - 2].split('/');
				image_name = image_name[image_name.length-1];
				image_name += '.'+image_type;
				$('input[name=image]').attr('data-default-file', APP_URL+'storage/'+this.user.image);
				// this.changeImage = 1;
				// $("#image input[name=image]").val(APP_URL+'/storage/'+this.residential.image);
				// $("#image input[name=image]").trigger('change');
				$('input[name=image').attr("aria-invalid","false");
				$('input[name=image]').addClass('valid');
				var divImage = $("#image");
				var dropify_wrapper = divImage.children('div.dropify-wrapper');
				var dropify_preview = dropify_wrapper.children('div.dropify-preview');
				var dropify_render = dropify_preview.children('span.dropify-render');
				var dropify_infos = dropify_preview.children('div.dropify-infos');

				dropify_wrapper.addClass('has-preview');
				// dropify_wrapper.children('button.dropify-clear').hide();
				dropify_preview.attr('style', 'display:block;');
				// dropify_render.html('<img src="/stotage/'+this.service.image+'"');
				dropify_render.html('<img src="'+APP_URL+'/storage/'+this.user.image+'" >');
				dropify_infos.children('div.dropify-infos-inner').children('p.dropify-filename').children('span.dropify-filename-inner').html(image_name);
			}			
			// $("#modal-form").modal('show');
		},
		saveForm()
		{	
			this.updateItem();
			
		},
		updateItem() {
			var url = '/admin_/users/updateProfile';
			var formData = new FormData($("#form_")[0]);
			var pass = this.user.password;

			if (this.user.password != '********') {
				if (this.user.password.length < 6 || this.user.password.length > 10) {
					Swal.fire({
	                    title: '¡Error!',
	                    text: 'La contraseña debe ser completada, debe tener un mínimo de 6 carácteres y un máximo de 10 carácteres',
	                    icon: 'error',
	                });
					return false;
				}

				if (this.user.password2 != this.user.password) {
					Swal.fire({
	                    title: '¡Error!',
	                    text: 'Las contraseñas no coinciden',
	                    icon: 'error',
	                });
					return false;
				}

				formData.append('changePassword', '1');
			} else {
				formData.append('changePassword', '0');
			}

			if (this.changeImage == 0) {
				Swal.fire({
                    title: '¡Error!',
                    text: 'Las imagén debe ser completada.',
                    icon: 'error',
                });
				return false;
			}

			formData.append('changeImage', this.changeImage);
			// formData.append('_method', 'PUT');
			this.loading = true;
			axios.post(url, formData).then(response => {
				Swal.fire({
	                  position: 'center',
	                  icon: 'success',
	                  title: 'Se ha guardado con éxito',
	                  showConfirmButton: false,
	                  timer: 1300
	                });
				this.loading = false;
				this.user.password = '********';
				this.user.password2 = '********';
			}).catch(error => {
				this.loading = false;
				if (typeof error.response.data.errors !== 'undefined') {                        
                    this.errors = $.map(error.response.data.errors, function(value, index) {
                        var err = '';
                        $.map(value, function(v, i){
                            err = v;
                        });
                            //this.errors[index].push() = [value];
                            return [err];
                        });
                    this.showErrorMessage(this.errors);
                } else {
                	Swal.fire({
	                    title: '¡Error!',
	                    text: 'Se ha producido un error',
	                    icon: 'error',
	                });
                }
			});
		},
	},
	mounted(){
		/*$('.table-responsive').responsiveTable({
            addDisplayAllBtn: 'btn btn-secondary'
        });*/
        var vm = this;

        $('.dropify').dropify({
			messages: {
				default: 'Click o arraste la imagen',
				replace: 'Click para remplazar la imagen',
				remove: 'Eliminar',
				error: 'Imagen inválida'
			},
		});

		$("#image .dropify-clear").click(function(){
			vm.changeImage = 0;
		});
		$("#image input[name=image]").change(function(){
			vm.changeImage = 1;
		});


		jQuery('#form_').validate({
		    errorClass: 'help-block',
			errorElement: 'div',
			errorPlacement: function(error, e) {
				jQuery(e).parents('.form-group').append(error);
			},
			highlight: function(e) {
				jQuery(e).closest('.form-group').removeClass('success').addClass('error');
				jQuery(e).removeClass('is-valid').addClass('is-invalid');
			},
			success: function(e) {
				var p =  jQuery(e).closest('.form-group')
				.children('.input-group')
				.children('.form-control')
				.removeClass('is-invalid error')
				.addClass('is-valid success');
				jQuery(e).remove();
				jQuery(e).closest('.form-group').removeClass('error');
        		jQuery(e).closest('.form-group').addClass('success');
			},
		    submitHandler: function(form) {
		    	// component.login(jQuery("#form").serialize());
		    	vm.saveForm();
		    },
		    rules: {
		    	'name': {
		    		required: true,
		    	},
		        'email': {
		            required: true,
		            email: true,
		        },
		        'phone': {
		        	required: true,
		        },
		        'dni': {
		        	required: true,
		        },
		        'last_name': {
		        	required: true,
		        },
		        'address': {
		        	required: true,
		        },
		        'postal_code': {
		        	required: true,
		        },
		        'password': {
		            required: true,
		            minlength: 6,
		            maxlength: 10
		        },
		        'password2': {
		        	equalTo: '#password',
		        },
		    },
		    messages: {
		    	'name': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		        'email': {
		            required: 'Este Campo es obligatorio.',
		            email: true,
		        },
		        'phone': {
		        	required: 'Este Campo es obligatorio.'
		        },
		        'dni': {
		        	required: 'Este Campo es obligatorio.'
		        },
		        'last_name': {
		        	required: 'Este Campo es obligatorio.'
		        },
		        'address': {
		        	required: 'Este Campo es obligatorio.'
		        },
		        'postal_code': {
		        	required: 'Este Campo es obligatorio.'
		        },
		        'password': {
		            required: 'Este Campo es obligatorio.',
		            minlength: 'Rango mínimo de la contraseña es de 6 carácteres',
		            maxlength: 'Rango máximo de la contraseña es de 10 carácteres',
		        },
		        'password2': {
		        	equalTo: 'La contraseña no coinciden',
		        },
		    }
		});

		$.validator.methods.email = function( value, element ) {
          return this.optional( element ) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
        }

        this.getProfile();
	}
});