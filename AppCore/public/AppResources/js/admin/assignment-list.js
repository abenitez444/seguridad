new Vue({
	el: '#app-main',
	data: {
		loading: true,
		sending: false,
		action: 'save',
		storage_folder: APP_URL+'storage/',
		assignment: {
			type: '',
			clients_id: '',
			client: {},
			list_watchmen: [],
			date_end: '',
			date_ini: '1990-01-30',
			novelty: [],
			num_watchmen: '',
			watchmen: [],
		},
		client_selected: {
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
		},
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
		},
		list_novelty: [],
		shift_vigilant_principal_selected: '',
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
            {label: 'Puesto', field: 'client.name'},
            {label: 'Nº de Vigilantes', field: 'client.num_watchmen'},
            {label: 'Programación', field: 'client.shift.name'},
            {label: 'Fecha de inicio', field: 'date_ini'},
            {label: 'Fecha de cierre', field: 'date_end'},
            {label: '', field: ''},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        rows: [],
        filter: '',
        per_page: 100,
        calendar: '',
        columns_actived: [
            // {label: 'Imagén', field: 'image'},
            {label: 'Nº de Cédula', field: 'dni'},
            {label: 'Nombre', field: 'name'},
            {label: 'Teléfono', field: 'phone'},
            {label: 'Turno', field: 'shift.name'},
            {label: 'Forma de inicio', field: 'start'},
            {label: 'Fecha de inicio', field: 'start_date'},
            // {label: '', field: ''},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        filter_activated: '',
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
			this.client = element;			
			// $("#modal-form").modal('show');
		},
		getAllWithPagination(){
			var url = '/admin_/assignment/getAllWithPagination/';
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
		removeItem(element) {
			var url = '/admin_/assignment/'+element.id;
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
		eventDay(vigilant, start_date, day)
		{
			return {
					title          : '(D) '+vigilant.name,
					start          : new Date(start_date.getFullYear(), start_date.getMonth(), start_date.getDate()+day),
					allDay         : true,
					backgroundColor: '#17a2b8',
					borderColor    : '#17a2b8'
			}
		},
		eventNight(vigilant, start_date, day)
		{
			return {
					title          : '(N) '+vigilant.name,
					start          : new Date(start_date.getFullYear(), start_date.getMonth(), start_date.getDate()+day),
					allDay         : true,
					backgroundColor: '#6c757d',
					borderColor    : '#6c757d'
			}
		},
		eventX(vigilant, start_date, day)
		{
			return {
					title          : '(X) '+vigilant.name,
					start          : new Date(start_date.getFullYear(), start_date.getMonth(), start_date.getDate()+day),
					allDay         : true,
					backgroundColor: '#28a745',
					borderColor    : '#28a745'
			}
		},
		eventRemplace(novelty, start_date, end_date)
		{
			var vigilant_replace = novelty.vigilant_change;
			var vigilant_principal = novelty.vigilant_principal;

			var noveltyText = 'NOVEDAD ('+novelty.type+')';
			noveltyText += '\n(P)'+vigilant_principal.name;
			if (novelty.type != 'Cambio de Turno') {
				noveltyText += '\n(R)'+vigilant_replace.name;
			} else {
				noveltyText += '\n(Turno)';
				if (novelty.shifts_new == 'D') {
					noveltyText += ' Día';
				} else if (novelty.shifts_new == 'N') {
					noveltyText += ' Noche';
				} else if (novelty.shifts_new == 'X') {
					noveltyText += ' Descanso';
				}
			}
			
			this.list_novelty.push(novelty);
			return {
					title          : noveltyText,
					start          : new Date(start_date.getFullYear(), start_date.getMonth(), start_date.getDate()),
					end            : new Date(end_date.getFullYear(), end_date.getMonth(), end_date.getDate()+1),
					allDay         : true,
					url            : 'javascript:void(0)',
					backgroundColor: '#dc3545',
					borderColor    : '#dc3545',
					id 	   		   : novelty.id,
			}
		},
		viewNovelty(id)
		{
			var vm = this;
			$("#modal-calendar").modal('hide');
			setTimeout(function(){
				$("#modal-novelty").modal('show');
			}, 500);
			for(i=0; i<this.list_novelty.length; i++)
			{
				var nov = this.list_novelty[i];
				if (nov.id == id) {
					this.novelty = nov;
					break;
				}
			}			
		},
		reverseCalendar()
		{
			$("#modal-novelty").modal('hide');
			setTimeout(function(){
				$("#modal-calendar").modal('show');
			}, 300);
		},
		viewCalendar(element)
		{
			var vm = this;
			this.client_selected = element.client;
			this.list_novelty = [];
			var date = new Date()
		    var d    = date.getDate(),
		        m    = date.getMonth(),
		        y    = date.getFullYear()

		    var start = element.date_ini;
		    start = start.split('-');
		    var start_date = new Date(parseInt(start[0]), parseInt(start[1])-1, parseInt(start[2]));

		    var end = element.date_end;
		    end =  end.split('-');
		    var end_date = new Date(parseInt(end[0]), parseInt(end[1])-1, parseInt(end[2]));
		    var list_event = [];

		    var count_vig = 1;
	    	for (var j = 0; j < element.watchmen.length; j++) {
	    		var vigilant = element.watchmen[j];
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

				var tur_ini = vigilant.pivot.start;
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

				count_vig++;
				var v_j = 0;
				while (true) {
					var s_date = new Date(start_date.getFullYear(), start_date.getMonth(), start_date.getDate()+v_j);
					
					if (s_date > end_date) {break;}
					if (this.in_day_activated(s_date, vigilant) == true) {v_j++; continue;}

					if (tur_v[i_t] == 'D') {
						var event = this.eventDay(vigilant, start_date, v_j);
					} else if (tur_v[i_t] == 'N') {
						var event = this.eventNight(vigilant, start_date, v_j);
					} else if (tur_v[i_t] == 'X') {
						var event = this.eventX(vigilant, start_date, v_j);
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
					list_event.push(event);
					v_j++;
				}
	    		count_vig++;
	    	}

	    	// Colocar las novedades en el calendario
			for (var k = 0; k < element.novelty.length; k++) {
				var novelty = element.novelty[k];
				var start_novelty = novelty.date_ini;
				start_novelty = start_novelty.split('-');
				var start_date_novelty = new Date(start_novelty[0], start_novelty[1]-1, start_novelty[2]);

				if (novelty.type == 'Cambio de Turno') {
			    	var end_date_novelty = start_date_novelty;
			    } else {
			    	var end_novelty = novelty.date_end;
			    	end_novelty = end_novelty.split('-');
			    	var end_date_novelty = new Date(end_novelty[0], end_novelty[1]-1, end_novelty[2]);	
			    }

			    var event = this.eventRemplace( novelty, start_date_novelty, end_date_novelty);
				list_event.push(event);						
			}

		    var Calendar = FullCalendar.Calendar;
		    var Draggable = FullCalendarInteraction.Draggable;
		    var containerEl = document.getElementById('external-events');
		    var checkbox = document.getElementById('drop-remove');
		    var calendarEl = document.getElementById('calendar');
		    if (this.calendar != '') {
		    	this.calendar.destroy();
		    }
		    this.calendar = new Calendar(calendarEl, {
		    	locale: 'es',
	      		plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
	      		header    : {
	        		left  : 'prev,next today',
	        		center: 'title',
	        		right : 'dayGridMonth, timeGridDay'
	     		},
	      		//Random default events
			    events    : list_event,
	      		editable  : false,
	      		droppable : true, // this allows things to be dropped onto the calendar !!!
	      		drop      : function(info) {
	        		// is the "remove after drop" checkbox checked?
	        		if (checkbox.checked) {
	          			// if so, remove the element from the "Draggable Events" list
	          			info.draggedEl.parentNode.removeChild(info.draggedEl);
	        		}
	      		},
	      		eventClick: function(info) {
	      			info.jsEvent.preventDefault();
	      			if (info.event.id == null || info.event.id == '') {
	      				return false;
	      			}
				    // alert('Event: ' + info.event.title);
				    // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
				    // alert('View: ' + info.view.type);
				    vm.viewNovelty(info.event.id);
				    // change the border color just for fun
				    // info.el.style.borderColor = 'red';
				 }    
	    	});

	    	this.calendar.render();
	    	setTimeout(function(){
	    		$("button.fc-dayGridMonth-button").trigger('click');
	    		// $(".fc-day-grid .fc-widget-content .fc-bg table td.fc-axis span").html('Programación');
	    	},500)
		},
		in_day_activated(s_date, vigilant)
		{
			var year = s_date.getFullYear();
			var month = s_date.getMonth()+1;
			var day = s_date.getDate();
			var is_valid = false;

			if (month < 10) {
				month = '0'+month;
			}
			if (day < 10) {
				day = '0'+day;
			}

			var day_i = year+'-'+month+'-'+day;
			// break;
			is_valid = day_i < vigilant.pivot.date_ini;
			if (is_valid == false) {
				is_valid = day_i >= vigilant.pivot.date_end;
			}
			return is_valid;
		},
		viewListWatchmen(element)
		{
			this.assignment = element;
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
        this.getAllWithPagination();
	}
});