new Vue({
	el: '#app-main',
	data: {
		loading: true,
		sending: false,
		action: 'save',
		storage_folder: APP_URL+'storage/',
		novelty: {
			type: 'Cambio de Turno',
			date_ini: '',
			date_end: '',
			url_doc: '',
			details: '',
			is_active: '',
			clients_id: '',
			client: {id: '', name: ''},
			vigilant_principal: {id: '', name: ''},
			vigilant_change: {id: '', name: ''},
			has_doc: true,
			ext_doc: false,
			shifts_double: '',
			clients_id_change: '',
			shifts_new: '',
			shifts_old: '',
			assignment_clients_id: '',
		},
		vigilant_principal_id: '',
		vigilant_change_id: '',
		shift_vigilant_principal_selected: '',
		shift_str_selected: '',
		clients: [],
		all_watchmen: [],
		watchmen_client: [],
		watchmen_selected: {id: '', name: '', clients_activated: [], clients_activated_news: [], assignment: []},
		assignment_selected: {id: '', name: '', date_end: '', date_ini: ''},
		image: null,
		view_element: false,
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
            {label: 'Vigilante', field: 'vigilant_principal.name'},
            {label: 'Fecha', field: 'date_ini'},
            {label: 'Doblaje de turno', field: 'shifts_double'},
            {label: 'Puesto & Turno de Origen', field: 'client.name'},
            {label: 'Puesto & Turno a cubrir', field: 'client_change.name'},
            {label: '', field: ''},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        rows: [],
        filter: '',
        per_page: 100,
	},
	created() {
		this.getAllClients();
		this.getActivatedWatchers();
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
			var vm = this;
			this.action = 'update';
			this.novelty = element;
			this.vigilant_principal_id = this.novelty.vigilant_principal.id;
			this.view_element = true;
			if (this.novelty.type != 'Cambio de Turno') {
				this.vigilant_change_id = this.novelty.vigilant_change.id;
			} else {
				this.vigilant_change_id = '';
				this.novelty.vigilant_change = {name: '', id: ''};
				if (this.novelty.news_id != null) {
					this.novelty.assignment_id = this.novelty.news_id;
					this.changeAssignment();
				}
				this.changeType();
			}						
			this.image = null;
			this.changeWatchmen();
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
			var url = '/admin_/news';
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
		updateItem() {
			var url = '/admin_/news/'+this.novelty.id;
			var formData = new FormData($("#form_")[0]);
			formData.append('_method', 'PUT');
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
			var url = '/admin_/news/'+element.id;
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
			var url = '/admin_/news/getAllWithPaginationByType';
			url += '?page='+this.pagination.current_page+'&per_page='+this.pagination.per_page;
			url += '&type=Cambio de Turno';
			this.loading = true;
			axios.get(url).then(response => {
				this.rows = response.data.data;
				this.makePagination(response.data);
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});
		},
		getAllClients()
		{
			var url = '/admin_/clients/getAll';
			this.loading = true;
			axios.get(url).then(response => {
				this.clients = response.data;
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});

		},
		getActivatedWatchers()
		{
			axios.get('/admin_/watchmen/getAll').then(response => {
				this.all_watchmen = response.data;
			});
		},
		changeWatchmen() {
			this.watchmen_selected = {id: '', name: '', clients_activated: [], clients_activated_news: [], assignment: []};
			for (var i = 0; i < this.all_watchmen.length; i++) {
				if (this.all_watchmen[i].id == this.vigilant_principal_id) {
					this.watchmen_selected = this.all_watchmen[i];
					if (this.action == 'update') {
						// this.novelty.clients_id = '';
						// this.novelty.date_ini = '';
						/*var is_client = false;
						for (var j = 0; j < this.watchmen_selected.clients_activated.length; j++) {
							if (this.watchmen_selected.clients_activated[j].id == this.novelty.clients_id) {
								is_client = true;
								break;
							}
						}
						if (is_client == false) {
							this.novelty.date_ini = '';
							this.novelty.clients_id = '';
						}*/
					}					
					break;
				}
			}
		},
		clienteInWatchmenSelected(client)
		{
			for (var i = 0; i < this.watchmen_selected.clients_activated.length; i++) {
				var c = this.watchmen_selected.clients_activated[i];
				if (c.id == client.id) {
					return true;
				}
			}
			return false;
		},
		clienteInWatchmenSelectedNovelty(client)
		{
			for (var i = 0; i < this.watchmen_selected.clients_activated_news.length; i++) {
				var c = this.watchmen_selected.clients_activated_news[i];
				if (c.id == client.id) {
					return true;
				}
			}
			return false;
		},
		readFile(e){
			this.image =  this.$refs.image.files;
		},
		loadDoc()
		{
			var vm = this;
		},
		addNew() {
			this.action = 'save';
			this.novelty = {
				type: 'Cambio de Turno',
				date_ini: '',
				date_end: '',
				url_doc: '',
				details: '',
				is_active: true,
				clients_id: '',
				client: {id: '', name: ''},
				vigilant_principal: {id: '', name: ''},
				vigilant_change: {id: '', name: ''},
				watchmen_selected: {id: '', name: '', assignment: []},
				ext_doc: true,
				has_doc:  false,
			};
			this.image = null;
			this.vigilant_principal_id = '';
			this.vigilant_change_id = '';
			// this.all_watchmen = [];
			this.watchmen_client = [];
			this.view_element = false;
		},
		inListOfClient(watchmen)
		{
			for (var i = 0; i < this.watchmen_client.length; i++) {
				if (this.watchmen_client[i].id == watchmen.id) {
					return true;
				}
			}
			return false;
		},
		changeType()
		{
			if (this.novelty.type == 'Cambio de Turno') {
				this.shift_vigilant_principal_selected = '';
				this.shift_str_selected = '';
				// this.novelty.shifts_double = '';
				// this.novelty.clients_id_change = '';
				// this.novelty.shifts_new = '';
				if (this.novelty.date_ini == '') {
					var date_now = new Date();
				} else {
					var date_ini_novelty = this.novelty.date_ini.split('-');
					var date_now = new Date(parseInt(date_ini_novelty[0]), parseInt(date_ini_novelty[1])-1, parseInt(date_ini_novelty[2]));
				}

				var year_now = date_now.getFullYear();
				var month_now = date_now.getMonth()+1;
				var day_now = date_now.getDate();

				if (month_now < 10) {
					month_now = '0'+month_now;
				}

				if (day_now < 10) {
					day_now = '0'+day_now;
				}

				this.novelty.date_ini = year_now+'-'+month_now+'-'+day_now;
				

				/* PROGRAMACION DEL VIGILANTE DEL PUESTO SELECCIONA */
				// obtener el vigilante principal (el que va a ser relevado)
				for (var i = 0; i < this.all_watchmen.length; i++) {
					if(this.all_watchmen[i].id == this.vigilant_principal_id){
						this.novelty.vigilant_principal = this.all_watchmen[i];
						break;
					}
				}
				var programation_vigilant_principal = [];
				//recorrer todas las programaciones del vigilante principal
				var assig = '';
				var cliented_selected = this.getClientSelected(this.novelty.clients_id);
				for (var i = 0; i < this.novelty.vigilant_principal.assignment.length; i++) {
					if (this.novelty.vigilant_principal.assignment[i].id == this.novelty.assignment_id) {
						assig = this.novelty.vigilant_principal.assignment[i];
						break;
					}
				}

				if (assig == '') {
					for (var i = 0; i < this.novelty.vigilant_principal.clients_activated_news.length; i++) {
						if (this.novelty.vigilant_principal.clients_activated_news[i].novelty.id == this.novelty.assignment_id) {
							assig = this.novelty.vigilant_principal.clients_activated_news[i].novelty.assignment;
							break;
						}
					}
				}

				var v_date_start = assig.pivot.date_ini;
				v_date_start = v_date_start.split('-');
				v_date_start = new Date(v_date_start[0], v_date_start[1]-1, v_date_start[2]);

				var cant = [];
				var cant_d = 0;
				var cant_n = 0;
				var cant_x = 0;
				var cant_total = 0;

				var tur = assig['shift'].turn.split(',');
				var cant_shift = assig['shift'].cant_turn.split(',');

				for (var k = 0; k < cant_shift.length; k++) {
					var cant_shift_arr = cant_shift[k].split('=');
					cant[cant_shift_arr[0]] = cant_shift_arr[1];
				}

				cant['total'] = assig['shift'].cant_total;

				var tur_ini = assig.pivot.start;
				for (var k = 0; k < tur.length; k++) {
					if (tur[k] == tur_ini) {
						tur.splice(k, 1);
					}
				}
				var tur_v = [tur_ini];
				if (tur.length == 2) {
					if (tur_ini == 'D') {
						tur_v.push('N');
						tur_v.push('X');
					} else if (tur_ini == 'N') {
						tur_v.push('X');
						tur_v.push('D');
					}else if (tur_ini == 'X') {
						tur_v.push('D');
						tur_v.push('N');
					}
				} else {
					for (var j = 0; j < tur.length; j++) {
						tur_v.push(tur[j]);
					}
				}

				var i_t = 0;
				var counter_tur = [];
				counter_tur[i_t] = 0;

				for (var j = 0; j < 365; j++) {
					var s_date = new Date(v_date_start.getFullYear(), v_date_start.getMonth(), v_date_start.getDate()+j);
					if (s_date.getFullYear() != date_now.getFullYear() &&
						s_date.getMonth() != date_now.getMonth() &&
						s_date.getDate() != date_now.getDate()) {
						counter_tur[i_t]++;
						cant_total++;
						continue;
					}

					programation_vigilant_principal.push({date: s_date, start: tur_v[i_t]});

					if (s_date.getFullYear() == date_now.getFullYear() &&
						s_date.getMonth() == date_now.getMonth() &&
						s_date.getDate() == date_now.getDate())
					{
						if (tur_v[i_t] == 'D') {
							this.shift_vigilant_principal_selected = 'Día';
							this.novelty.shifts_old = 'D';
						} else if (tur_v[i_t] == 'N') {
							this.shift_vigilant_principal_selected = 'Noche';	
							this.novelty.shifts_old = 'N';
						} else if (tur_v[i_t] == 'X') {
							this.shift_vigilant_principal_selected = 'Descanso';	
							this.novelty.shifts_old = 'X';
						}
						
						break;
					}
					counter_tur[i_t]++;

					if (counter_tur[i_t] == cant[tur_v[i_t]]) {
						i_t++;
						counter_tur[i_t] = 0;
					}

					cant_total++;

					if (cant_total == cant['total']) {
						i_t = 0;
						counter_tur[i_t] = 0;
						cant_total = 0;
					}
				}

			}
		},
		getClientSelected(id)
		{
			for (var i = 0; i < this.clients.length; i++) {
				if (this.clients[i].id == id) {
					return this.clients[i];
				}
			}
			return false;
		},
		changeAssignment()
    	{
    		var is_assigment = false;
    		this.assignment_selected = {id: '', name: '', date_end: '', date_ini: ''};

    		for (var i = 0; i < this.watchmen_selected.assignment.length; i++) {
    			if (this.watchmen_selected.assignment[i].id == this.novelty.assignment_id) {
    				this.assignment_selected = this.watchmen_selected.assignment[i];
    				is_assigment = true;
    				break;
    			}
    		}

    		if (is_assigment) {
    			return true
    		} else {
    			for (var i = 0; i < this.watchmen_selected.clients_activated_news.length; i++) {
    				if (this.watchmen_selected.clients_activated_news[i].id == this.novelty.assignment_id) {
    					this.assignment_selected = this.watchmen_selected.clients_activated_news[i].novelty;
    				}
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
		    	'clients_id': {
		    		required: true,
		    	},
				'vigilant_principal_id': {
		    		required: true,
		    	},
				'type': {
		    		required: true,
		    	},
		    	'date_ini': {
		    		required: true,
		    	},
		    	'date_end': {
		    		required: true,
		    	},
		    	'vigilant_change_id': {
		    		required: true,
		    	},
		    	'shifts_double': {
		    		required: true,
		    	},
		    	'clients_id_change': {
		    		required: true,
		    	},		    	
		    	'shifts_new': {
		    		required: true,
		    	},
		    },
		    messages: {
		    	'clients_id': {
		    		required: 'Este Campo es obligatorio.'
		    	},
				'vigilant_principal_id': {
		    		required: 'Este Campo es obligatorio.'
		    	},
				'type': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'date_ini': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'date_end': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'vigilant_change_id': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'shifts_double': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'clients_id_change': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'shifts_new': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    }
		});

        this.getAllWithPagination();
	}
});