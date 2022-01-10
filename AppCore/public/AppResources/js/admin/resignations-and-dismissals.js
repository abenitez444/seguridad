new Vue({
	el: '#app-main',
	data: {
		loading: true,
		sending: false,
		action: 'save',
		storage_folder: APP_URL+'storage/',
		novelty: {
			type: '',
			date: '',
			url_doc: '',
			details: '',
			vigilant_principal: {id: '', name: ''},
			vigilant_change: {id: '', name: ''},
			has_doc: true,
			ext_doc: false,
			vigilant_id: '',
		},
		vigilant_principal_id: '',
		vigilant_change_id: '',
		vigilant_selected: '',
		all_watchmen: [],
		watchmen_free: [],
		image: null,
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
            {label: 'Tipo', field: 'type'},
            {label: 'Vigilante(s)', field: 'vigilant_principal.name'},
            {label: 'Fecha', field: 'date'},
            {label: 'Observaciones', field: 'details'},
            {label: '', field: ''},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        rows: [],
        filter: '',
        per_page: 100,
	},
	created() {
		this.getAllWatchmen();
		this.getFreeWatchers();
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
		saveForm()
		{	
			var vm = this;
			this.loading = true;
			if (this.novelty.date_ini > this.novelty.date_end) {
				Swal.fire({
                    title: '¡Error!',
                    text: 'La fecha final debe ser mayor a la fecha inicial',
                    icon: 'error',
                });
                this.loading = false;
                return false;
			}
			if (this.novelty.has_doc && this.image == null) {
				Swal.fire({
                    title: '¡Error!',
                    text: 'Debe enviar el documento, de no tener alguno para la novedad desmarque la opcion de: "Posee documento"',
                    icon: 'error',
                });
                this.loading = false;
                return false;
			}
			setTimeout(function(){
				if (vm.action == 'save') {
					vm.saveItem();
				} else {
					vm.updateItem();
				}
			}, 500)
			
		},
		saveItem() {
			var url = '/admin_/resignations-and-dismissals';
			var formData = new FormData($("#form_")[0]);
			this.loading = true;
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
				this.getAllWatchmen();
				this.getFreeWatchers();
			}).catch(error => {
				this.loading = false;
				if (error.response.data.errors.message) {
					Swal.fire({
	                    title: '¡Error!',
	                    text: error.response.data.errors.message,
	                    icon: 'error',
	                });
				}
			});

		},
		removeItem(element) {
			var url = '/admin_/resignations-and-dismissals/'+element.id;
			Swal.fire({
        		title: 'Está seguro de eliminar el dato?',
        		html: "Si acepta eliminar no abrá vuelta atras, el dato será eliminado de forma permanente<br/>\
        				y se realizará un reverso de la operación.",
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
		                this.getAllWatchmen();
						this.getFreeWatchers();
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
			var url = '/admin_/resignations-and-dismissals/getAllWithPagination';
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
		getAllWatchmen()
		{
			var url = '/admin_/watchmen/getAll';
			this.loading = true;
			axios.get(url).then(response => {
				this.all_watchmen = response.data;
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});

		},
		getFreeWatchers()
		{
			axios.get('/admin_/watchmen/getAll').then(response => {
				this.watchmen_free = response.data;
			});
		},
		changeVigilant() 
		{
			this.novelty.type = '';
			this.novelty.date = '';
			this.vigilant_selected = '';
			for(i=0; i < this.all_watchmen.length; i++)
			{
				var v = this.all_watchmen[i];
				if (v.id == this.novelty.vigilant_principal.id) {
					this.vigilant_selected = v;
					break;
				}
			}			
		},
		readFile(e){
			this.image =  this.$refs.image.files;
		},
		loadDoc()
		{
			var vm = this;
			if (this.novelty.has_doc) {
				setTimeout(function(){
					$('.dropify').dropify({
						messages: {
							default: 'Click o arraste el documento',
							replace: 'Click para remplazar el documento',
							remove: 'Eliminar',
							error: 'Dacumento inválido'
						},
					});
					if (vm.action == 'update') {
						vm.view(vm.novelty);
					}
				},500);
			} else {
				this.image = null;
			}
		},
		inListSelected(vigilant)
		{
			if (this.novelty.vigilant_principal.id == vigilant.id) {
				return true;
			} else {
				return false;
			}
		},
		addNew() {
			this.action = 'save';
			this.novelty = {
				type: '',
				date: '',
				url_doc: '',
				details: '',
				vigilant_principal: {id: '', name: ''},
				vigilant_change: {id: '', name: ''},
				has_doc: false,
				ext_doc: false,
				vigilant_id: '',
			};
			this.image = null;
			this.vigilant_principal_id = '';
			this.vigilant_change_id = '';
			// this.watchmen_free = [];
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
		$('.dropify').dropify({
			messages: {
				default: 'Click o arraste el documento',
				replace: 'Click para remplazar el documento',
				remove: 'Eliminar',
				error: 'Dacumento inválido'
			},
		});

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
		    	'vigilant_id': {
		    		required: true,
		    	},
				'type': {
		    		required: true,
		    	},
		    	'date': {
		    		required: true,
		    	},
		    	'vigilant_change_id': {
		    		required: true,
		    	},
		    },
		    messages: {
		    	'vigilant_id': {
		    		required: 'Este Campo es obligatorio.'
		    	},
				'type': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'date': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'vigilant_change_id': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    }
		});

        this.getAllWithPagination();
	}
});