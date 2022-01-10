new Vue({
	el: '#app-main',
	data: {
		loading: true,
		sending: false,
		action: 'save',
		user: {
			name: '',
			last_name: '',
			email: '',
			password: '',
			password2: '',
			phone: '',
			type: '',
			is_active: '',
			image: '',
			dni: '',
			roles: [],
		},
		image: null,
		changeImage: 0,
		roles: [],
		pagination: {
			'total': 0,
			'current_page': 1,
			'per_page': 100,
			'last_page': 0,
			'from': 0,
			'to': 0 
		},
		offset: 3,
		columns: [
            // {label: 'Imagén', field: 'image'},
            {label: 'Foto', field: ''},
            {label: 'Cédula', field: 'dni'},
            {label: 'Nombre completo', field: 'name'},
            {label: 'Correo', field: 'email'},
            {label: 'Tipo', field: 'type'},
            {label: 'Teléfono', field: 'phone'},
            {label: 'Status', field: 'is_active'},
            {label: '', field: ''},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        rows: [],
        filter: '',
        per_page: 100,
	},
	created() {
		this.allRolesUsers();
		this.loading = true;
	},
	methods: {
		makePagination: function(response){
			this.pagination = {
				'total': response.total,
				'current_page': response.current_page,
				'per_page': response.per_page,
				'last_page': response.last_page,
				'from': response.from,
				'to': response.to
			}
		},
		changePerPage()
		{
			this.pagination.per_page = this.per_page;
			this.getAllWithPagination();
		},
		changePage(page)
		{
			if (this.pagination.current_page == page) {
				return false;
			}

			this.pagination.current_page = page;
			this.getAllWithPagination();
		},
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
		view(element) {
			this.action = 'update';
			this.user = element;
			this.user.password = '********';
			this.user.password2 = '********';

			$('#image .dropify-clear').trigger('click');
			this.changeImage = 0;
			this.image = null;
			if (this.user.image != '' && (typeof this.user.image === 'string')) {
				var path = this.user.image;
				this.image = 1;
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
		},
		saveForm()
		{	
			var vm = this;
			this.loading = true;
			setTimeout(function(){
				if (vm.action == 'save') {
					vm.saveItem();
				} else {
					vm.updateItem();
				}
			}, 500)
			
		},
		saveItem() {
			var url = '/admin_/users';
			var formData = new FormData($("#form_")[0]);
			axios.post(url, formData).then(response => {
				this.getAllWithPagination();
				Swal.fire({
	                  position: 'center',
	                  icon: 'success',
	                  title: 'Se ha guardado con éxito',
	                  showConfirmButton: false,
	                  timer: 1300
	                });
				$("#modal-form").modal('hide');
				this.loading = false;
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
		updateItem() {
			var url = '/admin_/users/update/'+this.user.id;
			var formData = new FormData($("#form_")[0]);
			if (this.changeImage == 1) {
				formData.append('changeImage', '1');
			}			
			axios.post(url, formData).then(response => {
				this.getAllWithPagination();
				Swal.fire({
	                  position: 'center',
	                  icon: 'success',
	                  title: 'Se ha guardado con éxito',
	                  showConfirmButton: false,
	                  timer: 1300
	                });
				$("#modal-form").modal('hide');
				this.loading = false;
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
		removeItem(element) {
			var url = '/admin_/users/'+element.id;
			Swal.fire({
        		title: 'Está seguro de eliminar el dato?',
        		html: "Si acepta eliminar no abrá vuelta atras, el dato será eliminado de forma permanente<br/>\
        				al igual que todos los datos relacionado al el.",
        		icon: 'question',
        		showCancelButton: true,
        		confirmButtonColor: '#3085d6',
        		cancelButtonColor: '#d33',
        		confirmButtonText: 'Si, eliminar!'
        	}).then((result) => {
        		if (result.value) {
        			this.loading = true;
					this.sending = true;
        			axios.delete(url).then(response => {
        				this.sending = false;
						this.loading = false;
						for (var i = 0; i < this.rows.length; i++) {
							var r = this.rows[i];
							if (r.id == element.id) {
								this.rows.splice(i, 1);
								break;
							}
						}
						Swal.fire({
		                  position: 'center',
		                  icon: 'success',
		                  title: 'Se ha eliminado con éxito',
		                  showConfirmButton: false,
		                  timer: 1300
		                });
        			}).catch(error => {
						this.sending = false;
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
		                    swal("¡Error!", 'Se ha producido un error', "error");
		                }
        			});     			
        		}
        	});
		},
		getAllWithPagination(){
			var url = '/admin_/users/getAllWithPagination/';
			url += '?page='+this.pagination.current_page+'&per_page='+this.pagination.per_page;
			this.loading = true;
			axios.get(url).then(response => {
				this.rows = response.data.data;
				this.makePagination(response.data);
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});
		},
		addNew() {
			this.action = 'save';
			this.user ={
				name: '',
				last_name: '',
				email: '',
				password: '',
				phone: '',
				type: '',
				is_active: true,
				image: '',
				dni: '',
				roles: [],
			};
			this.image = null;
			$('#image .dropify-clear').trigger('click');
			this.changeImage = 0;
		},
		readFile(e){
			this.image =  this.$refs.image.files;
			this.changeImage = 1;
		},
		allRolesUsers(){
			axios.get('/admin_/users/getAllRoles').then(response => {
				this.roles = response.data;
			});
		},
		hasRole(role_id)
		{
			var rol_on_user = false;
			for(i=0; i < this.user.roles.length; i++)
			{
				if (this.user.roles[i].id == role_id) {
					rol_on_user = true;
					break;
				}
			}
			return rol_on_user;
		}
	},
	computed: {
    	isActived: function() {
    		return this.pagination.current_page;
    	},

    	pagesNumber: function() {
    		if (!this.pagination.to) {
    			return [1];
    		}

    		var from = this.pagination.current_page - this.offset;
    		if (from < 1) {
    			from = 1;
    		}

    		var to = from + (this.offset * 2);
    		if (to > this.pagination.last_page) {
    			to = this.pagination.last_page;
    		}

    		var pagesArray = [];
    		while(from <= to) {
    			pagesArray.push(from);
    			from++;
    		}

    		return pagesArray;
    	}
    },
	mounted(){
		var vm = this;

		$('.dropify').dropify({
			messages: {
				default: 'Click o arraste la imagén',
				replace: 'Click para remplazar la imagén',
				remove: 'Eliminar',
				error: 'Dacumento inválido'
			},
		});

		$('#image .dropify-clear').click(function(){
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
		        'last_name': {
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
		        'type': {
		        	required: true,
		        },
		        'password': {
		        	required: true,
		        	minlength: 6,
					maxlength: 10,
		        },
		        'password2': {
		        	required: true,
		        	equalTo: '#password'
		        }
		    },
		    messages: {
		    	'name': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'email': {
		    		required: 'Este Campo es obligatorio.',
		    		email: 'Debe ingresar una cuenta de correo válida.'
		    	},
		    	'last_name': {
		        	required: 'Este Campo es obligatorio.',
		        },
		        'phone': {
		        	required: 'Este Campo es obligatorio.',
		        },
		        'dni': {
		        	required: 'Este Campo es obligatorio.',
		        },
		        'type': {
		        	required: 'Este Campo es obligatorio.',
		        },
		        'password': {
		        	required: 'Este Campo es obligatorio.',
		        	minlength: 'La contraseña debe ser entre un mínimo de 6 y un máximo de 10 carácteres.',
					maxlength: 'La contraseña debe ser entre un mínimo de 6 y un máximo de 10 carácteres.',
		        },
		        'password2': {
		        	required: 'Este Campo es obligatorio.',
		        	equalTo: 'La contraseña no coincide'
		        }
		    }
		});

		$.validator.methods.email = function( value, element ) {
          return this.optional( element ) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
        }

        this.getAllWithPagination();
	}
});