new Vue({
	el: '#app-main',
	data: {
		loading: true,
		sending: false,
		action: 'save',
		user: {
			name: '',
			phone: '',
			email: '',
			dni: '',
			address: '',
			i_quit: false,
			is_dismissal: false,
			is_active: true,
		},
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
            {label: 'DNI / Nº de Cédula', field: 'dni'},
            {label: 'Nombre Completo', field: 'name'},
            {label: 'Teléfono', field: 'phone'},
            {label: 'Puestos Asignados', field: ''},
            {label: 'Cubriendo novedad en: ', field: ''},
            {label: 'Status', field: ''},
            {label: '', field: 'is_active'},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        rows: [],
        filter: '',
        per_page: 100,
	},
	created() {
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
			// $("#modal-form").modal('show');
		},
		saveForm()
		{	
			if (this.action == 'save') {
				this.saveItem();
			} else {
				this.updateItem();
			}
		},
		saveItem() {
			var url = '/admin_/watchmen';
			this.loading = true;
			axios.post(url, this.user).then(response => {
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
			var url = '/admin_/watchmen/'+this.user.id;
			this.loading = true;
			axios.put(url, this.user).then(response => {
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
			var url = '/admin_/watchmen/'+element.id;
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
						if (typeof error.response.data.errors.message !== 'undefined') {                        
		                    Swal.fire({
				                title: '¡Error!',
				                html: error.response.data.errors.message,
				                icon: 'error',
				            });
		                } else {
		                    swal("¡Error!", 'Se ha producido un error', "error");
		                }
        			});     			
        		}
        	});
		},
		getAllWithPagination(){
			var url = '/admin_/watchmen/getAllWithPagination/';
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
			this.user = {
				name: '',
				phone: '',
				email: '',
				dni: '',
				address: '',
				is_active: true,
				i_quit: false,
				is_dismissal: false,
			};
		},
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
		/*$('.table-responsive').responsiveTable({
            addDisplayAllBtn: 'btn btn-secondary'
        });*/
        var vm = this;


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
		        'phone': {
		        	required: true,
		        },
		        'dni': {
		        	required: true,
		        },
		        'email': {
		        	email: true,
		        },
		    },
		    messages: {
		    	'name': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'phone': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'dni': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'email': {
		    		email: 'Debe ingresar un email válido'
		    	},
		    }
		});

		$.validator.methods.email = function( value, element ) {
          return this.optional( element ) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
        }

        this.getAllWithPagination();
	}
});