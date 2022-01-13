new Vue({
	el: '#app-main',
	vuetify: new Vuetify(),
	data: () => ({
		loading: true,
		sending: false,
		action: 'save',
		avatar:'',
		previewAvatar:'',
		disabledSend: false,
		countries:[],
		states:[],
		stateDisabled:true,
		agency: {
			name_agency: '',
			rut: '',
			email: '',
			local_agency: '',
			tlf_agency: '',
			desc_sociality: '',
			country: '',
			state: '',
			password: '',
			confirmPassword: '',
			valid: true,
			is_active: '',
		},
		form: {},
		rules:{
			passwordRules: [
				v => !!v || 'Por favor escriba la contraseña.',
				v => (v && v.length >= 6) || 'Mínimo 6 caracteres',
			],
			confirmPasswordRules: [
				v => !!v || 'La contraseña es requerida',
			],
			nameRules: [
			  v => !!v || 'El campo nombre de empresa es requerido.',
			  v => (v && v.length <= 50) || 'El campo  nombre de empresa debe contener máximo 50 caracteres.',
			  v => (v && v.length >= 3) || 'El campo  nombre de empresa debe contener mínimo 3 caracteres.',
			],
			emailRules: [
				v => !!v || 'El campo nombre de empresa es requerido.',
				v => (v && v.length <= 50) || 'El campo  nombre de empresa debe contener máximo 50 caracteres.',
				v => (v && v.length >= 3) || 'El campo  nombre de empresa debe contener mínimo 3 caracteres.',
				v => /.+@.+\..+/.test(v) || 'El nombre de empresa debe ser válido.',
			  ],
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
            //{label: 'Imagén', field: 'avatar'},
            {label: 'Empresa', field: 'name_agency'},
            {label: 'Rut', field: 'rut'},
            {label: 'Email', field: 'email'},
            {label: 'Teléfono', field: 'local_agency'},
            {label: 'Status', field: ''},
            // {label: '', field: ''},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        rows: [],
        filter: '',
        per_page: 100,

	}),
	created() {
		this.loading = true;
		//Avatar agency//
		this.previewAvatar= '/img/newyork.jpg';
		this.getCountries();
		if(this.data) 
		{
		  this.$refs.form.resetValidation()
		  this.agency = this.data;
		 
		  if(this.data.country || this.data.state)
          {
            this.data.country = this.data.country;
            this.getStates();
          }
		}
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
		// La imagen debe cumplir con las siguientes especificaciones:
		//  - Tamaño 120 x 120 px.
		//  - Peso máximo 3MB.
		//  - Formato:   . JPG , . JPEG o . PNG
		setAvatar(e){
		  this.avatar = e;
		  this.previewAvatar = URL.createObjectURL(e)
		},
		getCountries(){
			axios.get('/admin_/getCountries')
			.then((res) => {
				this.countries = res.data.country;
				this.states = res.data.state;
			})
			.catch((error) => {
			// eslint-disable-next-line no-console
			console.log(error)
			})
		},
		getStates(){
			
			const code = this.agency.country
      
			axios.get(
			  `/admin_/getStates/${code}`
			  )
			  .then((res) => {

				let estados = res.data.states
	
				if(estados.length > 0){
				  this.states = res.data.states
				  this.stateDisabled = false
				}else{
				  this.stateDisabled = true
				}
			  })
			  .catch((error) => {
				console.log(error)
			  })
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
			this.shift = element;
			
			var tur = this.shift.turn.split(',');
			var cant_shift = this.shift.cant_turn.split(',');
			for (var a_k = 0; a_k < cant_shift.length; a_k++) {
				var cant_shift_arr = cant_shift[a_k].split('=');
				if (cant_shift_arr[0] == 'D') {
					this.shift.d = cant_shift_arr[1];
				}
				if (cant_shift_arr[0] == 'N') {
					this.shift.n = cant_shift_arr[1];
				}
				if (cant_shift_arr[0] == 'X') {
					this.shift.x = cant_shift_arr[1];
				}
			}

			// $("#modal-form").modal('show');
		},
		saveForm()
		{	
			var vm = this;
			setTimeout(function(){
				if (vm.action == 'save') {
					vm.saveItem();
				} else {
					vm.updateItem();
				}
			}, 500)
			
		},
		saveItem() {
			var url = '/admin_/agencyStore';
			this.loading = true;
			axios.post(url, this.agency).then(response => {
				this.getAllWithPagination();
				console.log(response)
				// Swal.fire({
	            //       position: 'center',
	            //       icon: 'success',
	            //       title: 'Se ha guardado con éxito',
	            //       showConfirmButton: false,
	            //       timer: 1300
	            //     });
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
			var url = '/admin_/agency/'+this.agency.id;
			this.loading = true;
			axios.put(url, this.agency).then(response => {
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
			var url = '/admin_/shifts/'+element.id;
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
						Swal.fire({
		                  position: 'center',
		                  icon: 'error',
		                  title: '¡ERROR!',
		                  text: 'Asegure que el turno seleccionado no este asociado a ninguna programación',
		                  showConfirmButton: true,
		                });
        			});     			
        		}
        	});
		},
		getAllWithPagination(){
			var url = '/admin_/shifts/getAllWithPagination/';
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
			this.agency = {
				name_agency: '',
				rut: '',
				email: '',
				local_agency: '',
				tlf_agency: '',
				desc_sociality: '',
				country: '',
				state: '',
				password: '',
				confirmPassword: '',
				valid: true,
				is_active: 1,
			};
		},
	},
	computed: {
		passwordConfirmationRule() {
			return () =>
			  this.agency.password === this.agency.confirmPassword || "Las contraseñas no coinciden.";
		},
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
		    	// 'name_agency': {
		    	// 	required: true,
		    	// },
		        // 'cant_watchmen': {
		        // 	required: true,
		        // },
		        // 'd': {
		        // 	required: true,
		        // },
		        // 'n': {
		        // 	required: true,
		        // },
		        // 'x': {
		        // 	required: true,
		        // },
		    },
		    messages: {
		    	// 'name_agency': {
		    	// 	required: 'Este Campo es obligatorio.'
		    	// },
		    	// 'cant_watchmen': {
		    	// 	required: 'Este Campo es obligatorio.'
		    	// },
		    	// 'd': {
		    	// 	required: 'Este Campo es obligatorio.'
		    	// },
		    	// 'n': {
		    	// 	required: 'Este Campo es obligatorio.'
		    	// },
		    	// 'x': {
		    	// 	required: 'Este Campo es obligatorio.'
		    	// },
		    }
		});

        this.getAllWithPagination();
	}
});