new Vue({
	el: '#app-main',
	data: {
		loading: true,
		sending: false,
		action: 'save',
		client: {
			name: '',
			salary: '',
			num_services: '',
			shifts_id: '',
			shift: {name: ''},
			is_active: true,
			email: '',
			phone: '',
			address: '',
			name_person: '',
			num_watchmen: '',
			type_of_programming: '',
			shifts_selected: [],
		},
		shift_selected: '',
		shifts: [],
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
            {label: 'Razón social', field: 'name'},
            {label: 'Email', field: 'emial'},
            {label: 'Teléfono', field: 'phone'},
            {label: 'Persona de Contacto', field: 'name_person'},
            {label: 'Salario', field: 'salary'},
            // {label: 'Nº de Vigilantes', field: 'num_watchmen'},
            {label: 'Programación', field: 'shift.name'},
            {label: 'Status', field: ''},
            {label: '', field: ''},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        rows: [],
        filter: '',
        per_page: 100,
        money: {
		    decimal: '',
		    thousands: '.',
		    prefix: '',
		    suffix: '',
		    precision: 0,
		    masked: true
		},
	},
	created() {
		this.getAllShiftsActivated();
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
			this.client = element;			
			// $("#modal-form").modal('show');
		},
		saveForm()
		{	
			var vm = this;
			this.money.masked = false;
			setTimeout(function(){
				if (vm.action == 'save') {
					vm.saveItem();
				} else {
					vm.updateItem();
				}
			}, 500)
			
		},
		saveItem() {
			var url = '/admin_/clients';
			this.loading = true;
			axios.post(url, this.client).then(response => {
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
				this.money.masked = true;
			}).catch(error => {
				this.loading = false;
				this.money.masked = true;
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
			var url = '/admin_/clients/'+this.client.id;
			this.loading = true;
			axios.put(url, this.client).then(response => {
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
				this.money.masked = true;
			}).catch(error => {
				this.loading = false;
				this.money.masked = true;
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
			var url = '/admin_/clients/'+element.id;
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
			var url = '/admin_/clients/getAllWithPagination/';
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
		getAllShiftsActivated()
		{
			var url = '/admin_/shifts/getAllActivated';
			this.loading = true;
			axios.get(url).then(response => {
				this.shifts = response.data;
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});

		},
		addNew() {
			this.action = 'save';
			this.money.masked = true;
			this.client = {
				name: '',
				salary: 0,
				num_watchmen: '1',
				shifts_id: '',
				shift: {name: ''},
				shifts_selected: [],
				type_of_programming: '',
				is_active: true,
			};
			this.shift_selected = '';
		},
		addShifts()
		{
			if (this.shift_selected == '') {
				return false;
			}
			var s = {id: '', name: ''}
			for (var i = 0; i < this.shifts.length; i++) {
				if (this.shifts[i].id == this.shift_selected) {
					s = this.shifts[i];
				}
			}
			this.client.shifts_selected.push(s);
			this.shift_selected = '';
		},
		inListShiftsSelected(shift)
		{
			for (var i = 0; i < this.client.shifts_selected.length; i++) {
				if (this.client.shifts_selected[i].id == shift.id) {
					return true;
				}
			}
			return false;
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
		        'salary': {
		        	required: true,
		        },
		        'shifts_id': {
		        	required: true,
		        },
		        'num_watchmen': {
		        	required: true,
		        },
		        'email': {
		        	required: true,
		        	email: true,
		        },
		        'phone': {
		        	required: true,
		        },
		        'address': {
		        	required: true,
		        },
		        'name_person': {
		        	required: true,
		        },
		    },
		    messages: {
		    	'name': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'salary': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'shifts_id': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'address': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'phone': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'name_person': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'email': {
		    		required: 'Este Campo es obligatorio.',
		    		email: 'Debe ingresar una cuenta de correo válida.'
		    	},
		    	'num_watchmen': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    }
		});

		$.validator.methods.email = function( value, element ) {
          return this.optional( element ) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
        }

        this.getAllWithPagination();
	}
});