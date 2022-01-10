new Vue({
	el: '#app-main-news',
	data: {
		loading: true,
		sending: false,
		action: 'save',
		storage_folder: APP_URL+'storage/',
		novelty: {
			type: '',
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
			assignment_id: '',
		},
		vigilant_principal_id: '',
		vigilant_change_id: '',
		shift_vigilant_principal_selected: '',
		shift_str_selected: '',
		clients: [],
		watchmen_free: [],
		watchmen_client: [],
		watchmen_selected: {id: '', name: '', clients_activated: [], clients_activated_news: [], assignment: []},
		all_watchmen: [],
		assignment_selected: {id: '', name: '', date_end: '', date_ini: ''},
		vigilant_change_id_old: '',
		image: null,
		viewDetailsElement: false,
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
            {label: 'ID', field: 'id'},
            {label: 'Tipo', field: 'type'},
            {label: 'Puesto', field: 'client.name'},
            {label: 'Vigilante', field: 'vigilant_principal.name'},
            {label: 'Desde', field: 'date_ini'},
            {label: 'Hasta', field: 'date_end'},
            {label: 'Relevo', field: 'vigilant_change.name'},
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
		view(element, editAction=null) {
			var vm = this;
			if (editAction == null) {
				this.viewDetailsElement = false;
			} else {
				this.viewDetailsElement = true;
			}

			this.action = 'update';
			this.novelty = element;
			this.vigilant_principal_id = this.novelty.vigilant_principal.id;
			if (this.novelty.type != 'Cambio de Turno' && this.novelty.count_watchmen > 1) {
				this.vigilant_change_id = this.novelty.vigilant_change.id;
				this.vigilant_change_id_old = this.novelty.vigilant_change.id;
			} else {
				this.vigilant_change_id = '';
				this.novelty.vigilant_change = {name: '', id: ''};
				this.vigilant_change_id_old = '';
				//this.changeType();
			}						
			this.image = null;
			this.changeWatchmen();

			if (this.novelty.has_doc) {
				this.image = 1;
				$('.dropify').dropify({
					messages: {
						default: 'Click o arraste el documento',
						replace: 'Click para remplazar el documento',
						remove: 'Eliminar',
						error: 'Dacumento inválido'
					},
				});
				var path = this.novelty.url_doc;
				var image_split = path.split('.');
				var image_type = image_split[image_split.length - 1];
				var image_name = image_split[image_split.length - 2].split('/');
				image_name = image_name[image_name.length-1];
				image_name += '.'+image_type;
				$('input[name=image]').attr('data-default-file', APP_URL+'storage/'+this.novelty.url_doc);
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
				// dropify_render.html('<img src="/stotage/'+this.novelty.url_doc+'"');
				dropify_render.html('<img src="'+APP_URL+'/storage/'+this.novelty.url_doc+'" >');
				dropify_infos.children('div.dropify-infos-inner').children('p.dropify-filename').children('span.dropify-filename-inner').html(image_name);

				setTimeout(function(){
					$("#image .dropify-clear").click(function(){
						vm.image = null;
					});
				},500);
			}

			setTimeout(function(){
				vm.changeType();
			}, 1000);

		},
		saveForm()
		{	
			var vm = this;
			this.loading = true;
			if (this.novelty.type != 'Cambio de Turno' && this.novelty.type != 'Desvinculación') {
				if (this.novelty.date_ini > this.novelty.date_end) {
					Swal.fire({
	                    title: '¡Error!',
	                    text: 'La fecha final debe ser mayor a la fecha inicial',
	                    icon: 'error',
	                });
	                this.loading = false;
	                return false;
				}

				if (this.vigilantAvailable() == false) {
					this.loading = false;
					return false;
				}
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
			var url = '/admin_/news/getAllWithPagination';
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
			this.viewDetailsElement = false;
			this.novelty = {
				type: '',
				date_ini: '',
				date_end: '',
				url_doc: '',
				details: '',
				is_active: true,
				clients_id: '',
				client: {id: '', name: ''},
				vigilant_principal: {id: '', name: ''},
				vigilant_change: {id: '', name: ''},
				ext_doc: true,
				has_doc:  false,
			};
			this.image = null;
			this.vigilant_principal_id = '';
			this.vigilant_change_id = '';
			// this.watchmen_free = [];
			this.watchmen_client = [];
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
		vigilantAvailable()
		{
			var date_start = this.novelty.date_ini;
			var date_end = this.novelty.date_end;
			date_start = date_start.split('-');
			date_end = date_end.split('-');
			var start_date_novelty = new Date(date_start[0], date_start[1]-1, date_start[2]);
			var end_date_novelty = new Date(date_end[0], date_end[1]-1, date_end[2]);

			// Fechas de la novedad
			var dates_novelty = [];

			// Respueta si esta disponible para esa novedad sin complicaciones
			var is_available = false;

			// obtener el vigilante principal (el que va a ser relevado)
			for (var i = 0; i < this.all_watchmen.length; i++) {
				if(this.all_watchmen[i].id == this.vigilant_principal_id){
					this.novelty.vigilant_principal = this.all_watchmen[i];
					break;
				}
			}

			// obtener el vigilante secundario (el que va a relevar al principal)
			this.novelty.vigilant_change = '';
			for (var i = 0; i < this.all_watchmen.length; i++) {
				if(this.all_watchmen[i].id == this.vigilant_change_id){
					this.novelty.vigilant_change = this.all_watchmen[i];
					break;
				}
			}

			var i = 0;
			var date = new Date(start_date_novelty.getFullYear(), start_date_novelty.getMonth(), start_date_novelty.getDate()+i);
			while (date < end_date_novelty) {
				date = new Date(start_date_novelty.getFullYear(), start_date_novelty.getMonth(), start_date_novelty.getDate()+i);
				i++;
				dates_novelty.push(date);
			}

			/* PROGRAMACION DEL VIGILANTE QUE VA A RELEVAR */
			var programation_vigilant_change = [];
			if (this.novelty.vigilant_change == '') {
				return true;
			}
			if (this.novelty.vigilant_change.assignment.length > 0) {
				//recorrer todas las programaciones del vigilante relevo
				for (var i = 0; i < this.novelty.vigilant_change.assignment.length; i++) {
					var assig = this.novelty.vigilant_change.assignment[i];
					var v_date_end_acepted = true;
					var v_date_start = assig.pivot.date_ini;
						v_date_start = v_date_start.split('-');
						v_date_start = new Date(v_date_start[0], v_date_start[1]-1, v_date_start[2]);

					if (assig.pivot.date_end != null) {
						var v_date_end = assig.pivot.date_end;
						v_date_end = v_date_end.split('-');
						v_date_end = new Date(v_date_end[0], v_date_end[1]-1, v_date_end[2]);

						if ((v_date_end > start_date_novelty && v_date_end < end_date_novelty) || (v_date_start > start_date_novelty && v_date_start < end_date_novelty)) {
							v_date_end_acepted = true;
						} else {
							v_date_end_acepted = false;
						}
					}

					var cant = [];
					var cant_d = 0;
					var cant_n = 0;
					var cant_x = 0;
					var cant_total = 0;

					if (assig.pivot.date_end == null || v_date_end_acepted == null) {
						// Obtener programacion del vigilante relevo
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
							
							if ((s_date >= start_date_novelty && s_date <= end_date_novelty) == false) {
								counter_tur[i_t]++;
								cant_total++;
								continue;
							}

							if (s_date > end_date_novelty) {break;}

							programation_vigilant_change.push({date: s_date, start: tur_v[i_t]});
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
					} else {
						continue;
					}
				}				
			} else {
				return true;
			}

			/* PROGRAMACION DEL VIGILANTE DEL PUESTO SELECCIONA */
			var programation_vigilant_principal = [];
			//recorrer todas las programaciones del vigilante principal
			var assig = '';
			for (var i = 0; i < this.novelty.vigilant_principal.assignment.length; i++) {
				if (this.novelty.vigilant_principal.assignment[i].id == this.novelty.assignment_id) {
					assig = this.novelty.vigilant_principal.assignment[i];
					break;
				}
			}

			if (assig == '') {
				return true;
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
				
				if ((s_date >= start_date_novelty && s_date <= end_date_novelty) == false) {
					counter_tur[i_t]++;
					cant_total++;
					continue;
				}

				if (s_date > end_date_novelty) {break;}

				programation_vigilant_principal.push({date: s_date, start: tur_v[i_t]});
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


			for (var i = 0; i < dates_novelty.length; i++) {
				var date_principal = '';
				var s_principal = '';
				var date_change = '';
				var s_change = '';

				var d_novelty_year = dates_novelty[i].getFullYear();
				var d_novelty_m = dates_novelty[i].getMonth()+1;
				var d_novelty_day = dates_novelty[i].getDate();

				if (d_novelty_m < 10) {
					d_novelty_m = '0'+d_novelty_m;
				}

				if (d_novelty_day < 10) {
					d_novelty_day = '0'+d_novelty_day;
				}

				var d_novelty = d_novelty_year+'-'+d_novelty_m+'-'+d_novelty_day;

				for (var j = 0; j < programation_vigilant_change.length; j++) {
					var d_vigilant_change_year = programation_vigilant_change[j]['date'].getFullYear();
					var d_vigilant_change_m = programation_vigilant_change[j]['date'].getMonth()+1;
					var d_vigilant_change_day = programation_vigilant_change[j]['date'].getDate();

					if (d_vigilant_change_m < 10) {
						d_vigilant_change_m = '0'+d_vigilant_change_m;
					}

					if (d_vigilant_change_day < 10) {
						d_vigilant_change_day = '0'+d_vigilant_change_day;
					}

					var d_novelty_vigilant_change = d_vigilant_change_year+'-'+d_vigilant_change_m+'-'+d_vigilant_change_day;
					if (d_novelty_vigilant_change == d_novelty) {
						date_change = d_novelty_vigilant_change;
						s_change = programation_vigilant_change[j]['start'];
						break;
					}
				}

				for (var j = 0; j < programation_vigilant_principal.length; j++) {
					var d_vigilant_principal_year = programation_vigilant_principal[j]['date'].getFullYear();
					var d_vigilant_principal_m = programation_vigilant_principal[j]['date'].getMonth()+1;
					var d_vigilant_principal_day = programation_vigilant_principal[j]['date'].getDate();

					if (d_vigilant_principal_m < 10) {
						d_vigilant_principal_m = '0'+d_vigilant_principal_m;
					}

					if (d_vigilant_principal_day < 10) {
						d_vigilant_principal_day = '0'+d_vigilant_principal_day;
					}

					var d_novelty_vigilant_principal = d_vigilant_principal_year+'-'+d_vigilant_principal_m+'-'+d_vigilant_principal_day;
					if (d_novelty_vigilant_principal == d_novelty) {
						date_principal = d_novelty_vigilant_principal;
						s_principal = programation_vigilant_principal[j]['start'];
						break;
					}
				}

				if (date_principal != '' && date_change != '') {
					if (s_principal == s_change) {

						text_error = 'El vigilante: '+this.novelty.vigilant_change.name+' no puede hacer el relevó indicado.\n';
						text_error += 'Ya que el Día '+date_change+' esta cumpliendo una programación con el turno de ';
						if (s_change == 'D') {
							text_error += '"DÍA" \n';
						} else if (s_change == 'N') {
							text_error += '"NOCHE" \n';
						} else if (s_change == 'X') {
							text_error += '"DESCANSO" \n';
						}

						text_error += 'Y donde hará el relevó para la misma fecha, estaría cumpliendo el mismo turno.';
						Swal.fire({
		                    title: '¡Error!',
		                    text: text_error,
		                    icon: 'error',
		                });
						return false;
					}
				}
			}
		},
		changeType()
		{
			if (this.novelty.type == 'Cambio de Turno' 
				&& this.vigilant_principal_id != ''
				&& this.watchmen_selected.id != '') {
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
    		if (this.novelty.type == 'Cambio de Turno') {
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
	    			this.changeType();
	    			return true
	    		} else {
	    			for (var i = 0; i < this.watchmen_selected.clients_activated_news.length; i++) {
	    				if (this.watchmen_selected.clients_activated_news[i].id == this.novelty.assignment_id) {
	    					this.assignment_selected = this.watchmen_selected.clients_activated_news[i].novelty;
	    				}
	    			}
	    		}
	    		this.changeType();
	    		return false;
    		}
    		this.assignment_selected = {id: '', name: '', date_end: '', date_ini: ''};
    		for (var i = 0; i < this.watchmen_selected.assignment.length; i++) {
    			if (this.watchmen_selected.assignment[i].id == this.novelty.assignment_id) {
    				this.assignment_selected = this.watchmen_selected.assignment[i];
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
    	},
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

        this.getAllWithPagination();
	}
});