new Vue({
	el: '#app-main',
	data: {
		loading: false,
		action: 'save',
		start: false,
		start_date_vigilant: '',
		assignment: {
			id: '',
			type: '',
			clients_id: '',
			list_watchmen: [],
			list_watchmen_deactivated: [],
			list_watchmen_replace: [],
			date_ini: '',
			date_end: '',
		},
		clients: [],
		watchmen: [],
		vigilant_selected: '',
		vigilant_selected_replace: null,
		client_selected: {shift:{name:''}, assignments: []},
		assignment_selected: '',
		start_vigilant: 'D',
		date_min: '1990-01-30',
		days_preview: [],
		shift_selected: '',
		vigilant_selected_to_list: '',
		now: '',
		end: '',
		columns_actived: [
            // {label: 'Imagén', field: 'image'},
            {label: 'Nº de Cédula', field: 'dni'},
            {label: 'Nombre', field: 'name'},
            {label: 'Teléfono', field: 'phone'},
            {label: 'Turno', field: 'shift.name'},
            {label: 'Forma de inicio', field: 'start'},
            {label: 'Fecha de inicio', field: 'start_date'},
            {label: '', field: ''},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        columns_deactived: [
            // {label: 'Imagén', field: 'image'},
            {label: 'Nº de Cédula', field: 'dni'},
            {label: 'Nombre', field: 'name'},
            {label: 'Teléfono', field: 'phone'},
            {label: 'Turno', field: 'shift.name'},
            {label: 'Forma de inicio', field: 'start'},
            {label: 'Fecha de inicio', field: 'start_date'},
            {label: 'Fecha de cierre', field: 'end_date'},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        filter_activated: '',
	},
	created() {
		// this.getFreeWatchers();
		this.loading = true;
		var date = new Date();

		
		if (date.getMonth() < 10) {
			var now = date.getFullYear()+'-0'+(date.getMonth()+1);
			var end = (date.getFullYear()+1)+'-0'+(date.getMonth()+1);
		} else {
			var now = date.getFullYear()+'-'+(date.getMonth()+1);
			var end = (date.getFullYear()+1)+'-'+(date.getMonth()+1);
		}

		if (date.getDate() < 10) {
			now += '-0'+date.getDate();
			end += '-0'+date.getDate();
		} else {
			now += '-'+date.getDate();
			end += '-'+date.getDate();
		}

		this.now = now;
		this.end = end;

		this.assignment.date_ini = now;
		this.assignment.date_end = end;
		this.date_min = now;
		this.start_date_vigilant = now;
		/* for (var i = 1; i < 32; i++) {
			this.days_preview.push(i);
		}*/
	},
	methods: {
		getFreeWatchers()
		{
			this.loading = true;
			axios.get('/admin_/watchmen/getAllFree').then(response => {
				this.watchmen = response.data;
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});
		},
		changeType()
		{
			this.start = false;
			this.loading = true;
			this.vigilant_selected_replace = null;
			this.client_selected = {type_of_programming: false, shift:{name:''}, assignments: []};
			this.assignment_selected = '';
			this.assignment.clients_id = '';
			if (this.assignment.type == 'nuevo') {
				this.assignment.date_ini = this.now;
				this.assignment.date_end = this.end;
				this.loading = false;
				// this.getEmptyClients();
			} else if (this.assignment.type == 'reemplazo') {
				this.getNotEmptyClients();
			}
		},
		getEmptyClients()
		{
			this.clients = [];
			axios.get('/admin_/clients/getEmpty').then(response => {
				this.clients = response.data;
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});
		},
		getAvailableClients()
		{
			if (this.assignment.date_end <= this.assignment.date_ini) {
				Swal.fire({
                    title: '¡Error!',
                    text: 'La fecha de cierre de la programación debe ser mayor a la fecha de inicio',
                    icon: 'error',
                });
				return false;
			}
			this.clients = [];
			this.vigilant_selected = '';
			this.start = false;
			this.start_date_vigilant = '';
			this.vigilant_selected = '';
			this.vigilant_selected_replace = null;
			this.client_selected = {shift:{name:''}, type_of_programming: '', assignments: []};
			this.assignment_selected = '';
			this.start_vigilant = 'D';
			this.filter_activated = '';
			this.assignment.clients_id = '';
			var url = '/admin_/clients/getAvailableClientsByDate';
			url += '?date_ini='+this.assignment.date_ini+'&date_end='+this.assignment.date_end;
			axios.get(url).then(response => {
				this.clients = response.data;
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});
		},
		getNotEmptyClients()
		{
			this.clients = [];
			axios.get('/admin_/clients/getNotEmptyClients').then(response => {
				this.clients = response.data;
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});
		},
		startassignment()
		{
			this.start = true;
			this.start_vigilant = '';
			this.vigilant_selected_replace = null;
			this.loading = true;
			if (this.assignment.type == 'reemplazo') {
				this.getFreeWatchers();
				this.getListWatchmenOfAssignment();
			} else if(this.assignment.type == 'nuevo'){
				this.assignment.list_watchmen = [];
				this.getFreeWatchers();
			}
		},
		getListWatchmenOfAssignment()
		{
			this.loading = true;
			this.assignment.list_watchmen = [];
			axios.get('/admin_/assignment/'+this.assignment_selected+'/getListWatchmenByClient/'+this.assignment.clients_id).then(response => {
				this.assignment.list_watchmen = response.data.activated;
				this.assignment.list_watchmen_deactivated = response.data.deactivated;
				this.assignment.id = response.data.activated[0].pivot.assignment_id;
				this.assignment.date_ini = response.data.date_ini;
				this.assignment.date_end = response.data.date_end;
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});
		},
		setClienteSelected()
		{
			this.start = false;
			if (this.assignment.clients_id == '') {
				this.assignment_selected = '';
				return this.client_selected = {shift:{name:''}, assignments: []};
			}
			for (var i = 0; i < this.clients.length; i++) {
				var c = this.clients[i];
				if (c.id == this.assignment.clients_id) {
					this.assignment_selected = '';
					this.client_selected = c;
					this.client_selected.type_programming_text = 'Multiple Turnos';
					break;
				}
			}
			this.list_watchmen = [];
		},
		addVigilant()
		{
			var selected = {id: ''};
			var in_list = false;
			var in_list_replace = false;

			for (var i = 0; i < this.watchmen.length; i++) {
				var w = this.watchmen[i];
				if (this.vigilant_selected == w.id) {
					selected = w;
					break;
				}
			}

			for (var i = 0; i < this.assignment.list_watchmen.length; i++) {
				var w = this.assignment.list_watchmen[i];
				if (w.id == selected.id) {
					in_list = true;
					break;
				}
			}

			this.vigilant_selected = '';
			if (in_list) {
				return false;
			}

			selected.start = this.start_vigilant;
			selected.start_date = this.start_date_vigilant;

			if (this.client_selected.type_of_programming == 2) {
				for (var i = 0; i < this.client_selected.shifts_selected.length; i++) {
					var shift = this.client_selected.shifts_selected[i];
					if (shift.id == this.shift_selected) {
						selected.shift = shift;
						break;
					}
				}
			} else {
				selected.shift = this.client_selected.shift;
			}
			

			if (this.assignment.type == 'reemplazo' && this.vigilant_selected_replace != null) {
				if (this.vigilant_selected_replace.id != selected.id) {
					selected.replace_watchmen = this.vigilant_selected_replace.id;
					selected.replace_watchmen_id = this.vigilant_selected_replace.pivot.id;
					selected.activated = 0;
					selected.date_ini = this.vigilant_selected_replace.date_ini;
				} /*else {
					for (var i = 0; i < this.assignment.list_watchmen_replace.length; i++) {
						var wr = this.assignment.list_watchmen_replace[i];
						if (wr.id == selected.id) {
							selected.start_date = wr.start_date;
							this.assignment.list_watchmen_replace.splice(i,1);
						}
					}
				}				
				this.vigilant_selected_replace = null;*/
			}

			

			this.vigilant_selected = '';
			this.start_date_vigilant = '';
			this.shift_selected = '';
			this.vigilant_selected_replace = null;

			return this.assignment.list_watchmen.push(selected);
		},
		reverseReplace()
		{
			for (var i = 0; i < this.assignment.list_watchmen_replace.length; i++) {
				var wr = this.assignment.list_watchmen_replace[i];
				if (wr.id == this.vigilant_selected_replace.id) {
					//selected.start_date = wr.start_date;
					this.assignment.list_watchmen.push(wr);
					this.assignment.list_watchmen_replace.splice(i,1);
					break;
				}
			}				
			this.vigilant_selected_replace = null;
		},
		save()
		{
			if (this.assignment.list_watchmen.length != this.client_selected.num_watchmen) {
				Swal.fire({
                    title: '¡Error!',
                    text: 'El puesto selecionado debe tener un total de '+this.client_selected.num_watchmen+' vigilantes.',
                    icon: 'error',
                });
				return false;
			}

			for (var i = 0; i < this.assignment.list_watchmen.length; i++) {
				var assig = this.assignment.list_watchmen[i];
				if (assig.start_date < this.assignment.date_ini) {
					Swal.fire({
	                    title: '¡Error!',
	                    text: 'La fecha de inicio de los vigilantes no puede ser menor a la de la programación',
	                    icon: 'error',
	                });
					return false;
				}
			}

			this.loading = true;
			if (this.assignment.type == 'reemplazo') {
				if (this.assignment.date_end < this.assignment.date_ini) {
					Swal.fire({
	                    title: '¡Error!',
	                    text: 'La fecha de inicio de la programación, no puede ser mayor a la fecha de cierre',
	                    icon: 'error',
	                });
					return false;
				}

				for (var i = 0; i < this.client_selected.assignments.length; i++) {
					var assg = this.client_selected.assignments[i];
					if (this.assignment.date_end < assg.date_end && this.assignment.date_end > assg.date_ini) {
						Swal.fire({
		                    title: '¡Error!',
		                    text: 'El rango de fecha, no puede coincidir con una programación anterior del puesto seleccionado',
		                    icon: 'error',
		                });
						return false;
					}
				}
				this.update();
			} else {
				axios.post('/admin_/assignment', this.assignment).then(response => {
					Swal.fire({
	                  position: 'center',
	                  icon: 'success',
	                  title: 'Se ha guardado con éxito',
	                  showConfirmButton: false,
	                  timer: 1300
	                });
					this.loading = false;
					this.init();
					// location.href = APP_URL + '/admin_/assignment';
				}).catch(error => {
					this.loading = false;
					if (error.response.data.errors.message) {
						Swal.fire({
		                    title: '¡Error!',
		                    text: error.response.data.errors.message,
		                    icon: 'error',
		                });
					}
					
				})
			}			
		},
		update()
		{
			axios.put('/admin_/assignment/'+this.assignment.id, this.assignment).then(response => {
				Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Se ha guardado con éxito',
                  showConfirmButton: false,
                  timer: 1300
                });
				this.loading = false;
				this.init();
				//location.href = APP_URL + '/admin_/assignment';
			}).catch(error => {
				this.loading = false;
				if (error.response.data.errors.message) {
					Swal.fire({
	                    title: '¡Error!',
	                    text: error.response.data.errors.message,
	                    icon: 'error',
	                });
				}
			})
		},
		init()
		{
			this.loading = false;
			this.action = 'save';
			this.start = false;
			this.assignment = {
				id: '',
				type: '',
				clients_id: '',
				list_watchmen: [],
				list_watchmen_deactivated: [],
				list_watchmen_replace: [],
				date_ini: '1990-01-30',
			};
			this.clients = [];
			this.watchmen = [];
			this.vigilant_selected = '';
			this.client_selected = {shift:{name:''}, assignments: []};
			this.assignment_selected = '';
			this.start = false;
			this.start_date_vigilant = '';
			this.vigilant_selected = '';
			this.vigilant_selected_replace = null;
			this.start_vigilant = 'D';
			this.filter_activated = '';
		},
		programationVigilant(vigilant)
		{
			var programation = [];
			var cant = [];
			var cant_d = 0;
			var cant_n = 0;
			var cant_x = 0;
			var cant_total = 0;

			var tur = vigilant.shift.turn.split(',');
			var cant_shift = vigilant.shift.cant_turn.split(',');

			for (var a_k = 0; a_k < cant_shift.length; a_k++) {
				var cant_shift_arr = cant_shift[a_k].split('=');
				cant[cant_shift_arr[0]] = cant_shift_arr[1];
			}
			cant['total'] = vigilant.shift.cant_total;
			var tur_ini = vigilant.start;
			for (var a_k = 0; a_k < tur.length; a_k++) {
				if (tur[a_k] == tur_ini) {
					tur.splice(a_k, 1);
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
				for (var th3 = 0; th3 < tur.length; th3++) {
					tur_v.push(tur[th3]);
				}
			}
			var i_t = 0;
			var counter_tur = [];
			counter_tur[i_t] = 0;
			var v_j = 0;

			for (var i = 0; i < this.days_preview.length; i++) {
				var day = this.days_preview[i];
				if (day < vigilant.start_date){
					programation.push(' ');
					continue;
				}

				if (tur_v[i_t] == 'D') {
					programation.push('D');
				} else if (tur_v[i_t] == 'N') {
					programation.push('N');
				} else if (tur_v[i_t] == 'X') {
					programation.push('X');
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
				v_j++;
			}

			/*if (this.client_selected.shift.id == 1 || vigilant.shift.id == 1 ) { // Progamación con turno 2X2
				if (vigilant.start == 'D') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_d < 2) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 2 && cant_n < 2) {
							programation.push('N');
							cant_n++;
						} else if (cant_d == 2 && cant_n == 2 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						}

						cant_total++;

						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
				if (vigilant.start == 'N') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_n < 2) {
							programation.push('N');
							cant_n++;
						} else if (cant_n == 2 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_n == 2 && cant_x == 2 && cant_d < 2) {
							programation.push('D');
							cant_d++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 2 && cant_d < 2) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 2 && cant_x == 2 && cant_n < 2) {
							programation.push('N');
							cant_n++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 2 || vigilant.shift.id == 2){ // Progamación con turno 4X2X2 Diurno
				if (vigilant.start == 'D') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_d < 4) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 4 && cant_n < 2) {
							programation.push('N');
							cant_n++;
						} else if (cant_d == 4 && cant_n == 2 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;

						if (cant_total == 8) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}					
					}
				}
				if (vigilant.start == 'N') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_n < 2) {
							programation.push('N');
							cant_n++;
						} else if (cant_n == 2 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_n == 2 && cant_x == 2 && cant_d < 4) {
							programation.push('D');
							cant_d++;
						}
						cant_total++;
						if (cant_total == 8) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 2 && cant_d < 4) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 4 && cant_x == 2 && cant_n < 2) {
							programation.push('N');
							cant_n++;
						}
						cant_total++;
						if (cant_total == 8) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 3 || vigilant.shift.id == 3){ // Progamación con turno 2X4X2 Nocturno
				if (vigilant.start == 'D') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_d < 2) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 2 && cant_n < 4) {
							programation.push('N');
							cant_n++;
						} else if (cant_d == 2 && cant_n == 4 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;

						if (cant_total == 8) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}					
					}
				}
				if (vigilant.start == 'N') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_n < 4) {
							programation.push('N');
							cant_n++;
						} else if (cant_n == 4 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_n == 4 && cant_x == 2 && cant_d < 2) {
							programation.push('D');
							cant_d++;
						}
						cant_total++;
						if (cant_total == 8) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 2 && cant_d < 2) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 2 && cant_x == 2 && cant_n < 4) {
							programation.push('N');
							cant_n++;
						}
						cant_total++;
						if (cant_total == 8) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 4 || vigilant.shift.id == 4){ // Progamación con turno 5X2 Nocturno
				if (vigilant.start == 'N') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_n < 5) {
							programation.push('N');
							cant_n++;
						} else if (cant_n == 5 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 2 && cant_n < 5) {
							programation.push('N');
							cant_n++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 5 || vigilant.shift.id == 5){ // Progamación con turno 5X2 Diurno
				if (vigilant.start == 'D') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_d < 5) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 5 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 2 && cant_d < 5) {
							programation.push('D');
							cant_d++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 6 || vigilant.shift.id == 6){ // Progamación con turno 6X1 Diurno
				if (vigilant.start == 'D') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_d < 6) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 6 && cant_x < 1) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 1) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 1 && cant_d < 6) {
							programation.push('D');
							cant_d++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 7 || vigilant.shift.id == 7){ // Progamación con turno 6X1 Nocturno
				if (vigilant.start == 'N') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_n < 6) {
							programation.push('N');
							cant_n++;
						} else if (cant_n == 6 && cant_x < 1) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 1) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 1 && cant_n < 6) {
							programation.push('N');
							cant_n++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 8 || vigilant.shift.id == 8){ // Progamación con turno 4X2 Diurno
				if (vigilant.start == 'D') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_d < 4) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 4 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 2 && cant_d < 4) {
							programation.push('D');
							cant_d++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 9 || vigilant.shift.id == 9){ // Progamación con turno 4X2 Nocturno
				if (vigilant.start == 'N') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_n < 4) {
							programation.push('N');
							cant_n++;
						} else if (cant_n == 4 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 2 && cant_n < 4) {
							programation.push('D');
							cant_n++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 10 || vigilant.shift.id == 10){ // Progamación con turno 3X3 Diurno
				if (vigilant.start == 'D') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_d < 3) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 3 && cant_x < 3) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 3) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 3 && cant_d < 3) {
							programation.push('D');
							cant_d++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 11 || vigilant.shift.id == 11){ // Progamación con turno 3X3 Nocturno
				if (vigilant.start == 'N') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_n < 3) {
							programation.push('N');
							cant_n++;
						} else if (cant_n == 3 && cant_x < 3) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 3) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 3 && cant_n < 3) {
							programation.push('N');
							cant_n++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 12 || vigilant.shift.id == 12){ // Progamación con turno 5X1 Nocturno
				if (vigilant.start == 'N') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_n < 5) {
							programation.push('N');
							cant_n++;
						} else if (cant_n == 5 && cant_x < 1) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 1) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 1 && cant_n < 5) {
							programation.push('N');
							cant_n++;
						}
						cant_total++;
						if (cant_total == 6) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 13 || vigilant.shift.id == 13){ // Progamación con turno 3X2X2
				if (vigilant.start == 'D') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_d < 3) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 3 && cant_n < 2) {
							programation.push('N');
							cant_n++;
						} else if (cant_d == 3 && cant_n == 2 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;

						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}					
					}
				}
				if (vigilant.start == 'N') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_n < 2) {
							programation.push('N');
							cant_n++;
						} else if (cant_n == 2 && cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_n == 2 && cant_x == 2 && cant_d < 3) {
							programation.push('D');
							cant_d++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 2) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 2 && cant_d < 3) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 3 && cant_x == 2 && cant_n < 2) {
							programation.push('N');
							cant_n++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			} else if(this.client_selected.shift.id == 14 || vigilant.shift.id == 14){ // Progamación con turno 2X2X3
				if (vigilant.start == 'D') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_d < 2) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 2 && cant_n < 2) {
							programation.push('N');
							cant_n++;
						} else if (cant_d == 2 && cant_n == 2 && cant_x < 3) {
							programation.push('X');
							cant_x++;
						}
						cant_total++;

						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}					
					}
				}
				if (vigilant.start == 'N') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_n < 2) {
							programation.push('N');
							cant_n++;
						} else if (cant_n == 2 && cant_x < 3) {
							programation.push('X');
							cant_x++;
						} else if (cant_n == 2 && cant_x == 3 && cant_d < 2) {
							programation.push('D');
							cant_d++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}						
					}
				}
				if (vigilant.start == 'X') {
					for (var i = 0; i < this.days_preview.length; i++) {
						var day = this.days_preview[i];
						if (day < vigilant.start_date){
							programation.push(' ');
							continue;
						}
						if (cant_x < 3) {
							programation.push('X');
							cant_x++;
						} else if (cant_x == 3 && cant_d < 2) {
							programation.push('D');
							cant_d++;
						} else if (cant_d == 2 && cant_x == 3 && cant_n < 2) {
							programation.push('N');
							cant_n++;
						}
						cant_total++;
						if (cant_total == 7) {
							cant_d = 0;
							cant_n = 0;
							cant_x = 0;
							cant_total = 0;
						}
					}
				}
			}*/
			return programation;
		},
		inListSelected(vigilant)
		{
			var inlist = false;
			for (var i = 0; i < this.assignment.list_watchmen.length; i++) {
				var w = this.assignment.list_watchmen[i];
				if (w.id == vigilant.id) {
					inlist = true;
					break;
				}
			}
			return inlist;
		},
		inListWatchmen(vigilant)
		{
			var inlist = false;
			for (var i = 0; i < this.watchmen.length; i++) {
				var w = this.watchmen[i];
				if (w.id == vigilant.id) {
					inlist = true;
					break;
				}
			}
			return inlist;
		},
		removeOfList(id)
		{
			for (var i = 0; i < this.assignment.list_watchmen.length; i++) {
				if (this.assignment.list_watchmen[i].id == id) {
					var index =  i;
					break;
				}
			}

			if (this.assignment.type == 'reemplazo') {
				var in_list_watchmen = false;
				var in_list_replace = false;
				var vi = this.assignment.list_watchmen[index];
				if (!this.inListWatchmen(vi)) {
					this.watchmen.push(vi);
				}

				if (vi.activated == 0) {
					vi = this.getVigilantOfList(vi.replacement_of);
				} else {
					this.assignment.list_watchmen_replace.push(vi);
				}
				this.vigilant_selected_replace = vi;

				this.assignment.list_watchmen.splice(index,1);
			} else if(this.assignment.type == 'nuevo'){
				this.assignment.list_watchmen.splice(index,1);
			}
		},
		removeOfListPermanent(id)
		{
			for (var i = 0; i < this.assignment.list_watchmen.length; i++) {
				if (this.assignment.list_watchmen[i].id == id) {
					var index =  i;
					break;
				}
			}
			if (this.assignment.type == 'reemplazo') {
				var in_list_watchmen = false;
				var in_list_replace = false;
				var vi = this.assignment.list_watchmen[index];
				if (!this.inListWatchmen(vi)) {
					this.watchmen.push(vi);
				}

				vi.pivot.date_end = this.now;

				if (vi.pivot.date_end < vi.start_date) {
					vi.pivot.date_end = vi.start_date;
				}


				this.assignment.list_watchmen_deactivated.push(vi);
				// this.vigilant_selected_replace = vi;

				this.assignment.list_watchmen.splice(index,1);
			} else if(this.assignment.type == 'nuevo'){
				this.assignment.list_watchmen.splice(index,1);
			}
		},
		cancelChange(id)
		{
			for (var i = 0; i < this.assignment.list_watchmen.length; i++) {
				if (this.assignment.list_watchmen[i].id == id) {
					var index =  i;
					var v_selected = this.assignment.list_watchmen[i];
					this.assignment.list_watchmen.splice(index,1);
					break;
				}
			}

			//replace_watchmen

			for (var i = this.assignment.list_watchmen_replace.length - 1; i >= 0; i--) {
				if (this.assignment.list_watchmen_replace[i].id == v_selected.replace_watchmen) {
					this.assignment.list_watchmen.push(this.assignment.list_watchmen_replace[i]);
					this.assignment.list_watchmen_replace.splice(i,1);
					break;
				}
			}
		},
		getVigilantOfList(id){
			for(i=0; i < this.watchmen.length; i++){
				if (this.watchmen[i].id == id) {
					return this.watchmen[i];
				}
			}
		},
		preview()
		{
			this.days_preview = [];
			var date_ini = this.assignment.date_ini;
			var date_ini_arr = date_ini.split('-');
			var start_date = new Date(date_ini_arr[0], date_ini_arr[1], date_ini_arr[2]);

			var year_date_ini = parseInt(date_ini_arr[0]);
			var month_date_ini = parseInt(date_ini_arr[1]);
			var day_date_ini = parseInt(date_ini_arr[2]);

			if (month_date_ini < 10) {
				month_date_ini = '0'+month_date_ini;
			}

			if (day_date_ini < 10) {
				day_date_ini = '0'+day_date_ini;
			}

			this.assignment.date_ini = year_date_ini+'-'+month_date_ini+'-'+day_date_ini;

			for (var i = 0; i < this.assignment.list_watchmen.length; i++) {
				var assig = this.assignment.list_watchmen[i];
				if (assig.start_date < this.assignment.date_ini) {
					Swal.fire({
	                    title: '¡Error!',
	                    text: 'La fecha de inicio de los vigilantes no puede ser menor a la de la programación',
	                    icon: 'error',
	                });
					return false;
				}
			}

			

		    this.days_preview.push(date_ini);
		    for (var i = 1; i < 31; i++) {
		    	var new_date = new Date(start_date.getFullYear(), start_date.getMonth(), start_date.getDate()+i);
		    	var year = new_date.getFullYear();

				if (new_date.getMonth() < 10) {
			    	var month = '0'+new_date.getMonth();
			    } else {
			    	var month = new_date.getMonth();
			    }

			    if (new_date.getDate() < 10) {
			    	var day = '0'+new_date.getDate();
			    } else {
			    	var day = new_date.getDate();
			    }

		    	var str_new_date =year+'-'+month+'-'+day;
		    	this.days_preview.push(str_new_date);
		    }
		    $("#modal-preview").modal('show');
		    // return 
		},
		changeVigilantSelected()
		{
			this.start_vigilant = '';
			this.shift_selected = '';
		}
	},
	computed: {
		/*clienteCompleted()
		{
			if (this.assignment.list_watchmen.length == this.client_selected.num_watchmen) {
				return true;
			} else {
				return false;
			}
		},*/
    },
	mounted(){
		this.loading = false;
	}
});