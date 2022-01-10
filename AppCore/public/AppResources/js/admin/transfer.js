new Vue({
	el: '#app-main',
	data: {
		loading: false,
		action: 'save',
		operations: [],
		clients: [],
		operation: {
			type: 'transfer',
			client_selected: {shift:{name:''}, assignments: []},
			client_transfer_selected: {shift:{name:''}, assignments: []},
			clients_id: '',
			assignment_id: '',
			assignment_selected: {id: '', watchmen: []},
			assignment_transfer_selected: {id: '', watchmen: []},
			watchmen_id: '',
			watchmen_selected: {id: '', name: '', shift: {id: '', name: ''}, pivot: {start: '', date_ini: '', date_end: ''}},
			clients_transfer_id: '',
			assignment_transfer_id: '',
			shift_selected: '',
			start_vigilant: '',
			start_date_vigilant: '',
		},
		now: '',
		end: '',
		columns: [
            // {label: 'Imagén', field: 'image'},
            {label: 'ID', field: 'id'},
            {label: 'Fecha de creación', field: 'created_at'},
            {label: 'Puesto de Origen', field: 'clients_origin.name'},
            {label: 'Vigilante', field: 'watchmen.name'},
            {label: 'Pusto destino', field: 'clients_destiny.name'},
            {label: '', field: ''},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        filter: '',
        pagination: {
			'total': 0,
			'current_page': 1,
			'per_page': 100,
			'last_page': 0,
			'from': 0,
			'to': 0 
		},
		offset: 3,
	},
	created() {
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
		this.operation.start_date_vigilant = this.now;

		this.getAllClients();
		this.getOperations();
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
			this.getOperations();
		},
		changePage(page)
		{
			if (this.pagination.current_page == page) {
				return false;
			}

			this.pagination.current_page = page;
			this.getOperations();
		},
		getAllClients()
		{
			var url = '/admin_/clients/getAllClients';
			this.loading = true;
			axios.get(url).then(response => {
				this.clients = response.data;
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});
		},
		getOperations()
		{
			var url = '/admin_/operations/get-by-type/transfer';
			url += '?page='+this.pagination.current_page+'&per_page='+this.pagination.per_page;
			this.loading = true;
			axios.get(url).then(response => {
				this.operations = response.data.data;
				this.makePagination(response.data);
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});

		},
		addNew()
		{
			this.action = 'save';
			this.operation.client_selected = {shift:{name:''}, assignments: []};
			this.operation.client_transfer_selected = {shift:{name:''}, assignments: []};
			this.operation.clients_id = '';
			this.operation.assignment_id = '';
			this.operation.assignment_selected = {id: '', watchmen: []};
			this.operation.assignment_transfer_selected = {id: '', watchmen: []};
			this.operation.watchmen_id = '';
			this.operation.watchmen_selected = {id: '', name: '', shift: {id: '', name: ''}, pivot: {start: '', date_ini: '', date_end: ''}};
			this.operation.clients_transfer_id = '';
			this.operation.assignment_transfer_id = '';
			this.operation.shift_selected = '';
			this.operation.start_date_vigilant = this.now;
		},
		setClientSelected()
		{
			this.operation.client_selected = {shift:{name:''}, assignments: []};
			this.operation.client_transfer_selected = {shift:{name:''}, assignments: []};
			this.operation.assignment_id = '';
			this.operation.assignment_selected = {id: '', watchmen: []};
			this.operation.assignment_transfer_selected = {id: '', watchmen: []};
			this.operation.watchmen_id = '';
			this.operation.watchmen_selected = {id: '', name: '', shift: {id: '', name: ''}, pivot: {start: '', date_ini: '', date_end: ''}};
			this.operation.clients_transfer_id = '';
			this.operation.assignment_transfer_id = '';
			this.operation.shift_selected = '';
			this.operation.start_date_vigilant = this.now;

			if (this.operation.clients_id == '') {
				return false;
			}

			for (var i = 0; i < this.clients.length; i++) {
				if (this.clients[i].id == this.operation.clients_id) {
					return this.operation.client_selected = this.clients[i];
				}
			}
			return false;
		},
		setClientTransfer()
		{
			this.operation.client_transfer_selected  = {shift:{name:''}, assignments: []};
			this.operation.assignment_transfer_selected = {id: '', watchmen: []};
			this.operation.assignment_transfer_id  = '';
			this.operation.shift_selected  = '';
			this.operation.start_date_vigilant  = this.now;

			if (this.operation.clients_transfer_id == '') {
				return false;
			}

			for (var i = 0; i < this.clients.length; i++) {
				if (this.clients[i].id == this.operation.clients_transfer_id) {
					return this.operation.client_transfer_selected = this.clients[i];
				}
			}
			return false;
		},
		setAssignment()
		{
			this.operation.assignment_transfer_selected= {id: '', watchmen: []};
			this.operation.shift_selected = '';
			this.operation.start_date_vigilant = this.now;

			if (this.operation.assignment_id == '') {
				return false;
			}

			for (var i = 0; i < this.operation.client_selected.assignments.length; i++) {
				if (this.operation.client_selected.assignments[i].id == this.operation.assignment_id) {
					return this.operation.assignment_selected = this.operation.client_selected.assignments[i];
				}
			}
			return false;
		},
		setAssignmentTransfer()
		{
			this.operation.assignment_transfer_selected= {id: '', watchmen: []};
			this.operation.shift_selected = '';
			this.operation.start_date_vigilant = this.now;

			if (this.operation.assignment_transfer_id == '') {
				return false;
			}

			for (var i = 0; i < this.operation.client_transfer_selected.assignments.length; i++) {
				if (this.operation.client_transfer_selected.assignments[i].id == this.operation.assignment_transfer_id) {
					return this.operation.assignment_transfer_selected = this.operation.client_transfer_selected.assignments[i];
				}
			}
			return false;
		},
		setWatchmen()
		{
			this.operation.watchmen_selected = {id: '', name: '', shift: {id: '', name: ''}, pivot: {start: '', date_ini: '', date_end: ''}};
			this.operation.clients_transfer_id = '';
			this.operation.assignment_transfer_id = '';
			this.operation.shift_selected = '';
			this.operation.start_date_vigilant = this.now;

			if (this.operation.watchmen_id == '') {
				return false;
			}

			for (var i = 0; i < this.operation.assignment_selected.watchmen.length; i++) {
				if (this.operation.assignment_selected.watchmen[i].id == this.operation.watchmen_id) {
					return this.operation.watchmen_selected = this.operation.assignment_selected.watchmen[i];
				}
			}
			return false;
		},
		saveForm()
		{
			if (this.operation.watchmen_selected.pivot.date_ini > this.operation.start_date_vigilant) {
				Swal.fire({
                    title: '¡Error!',
                    text: 'La fecha de inicio en el puesto destino, para el vigilante seleccionado, debe ser mayor a la fecha de inicio en su programación de origen.',
                    icon: 'error',
                });
				return false;
			}
			var url = '/admin_/save-operation';
			this.loading = true;
			axios.post(url, this.operation).then(response => {
				this.getOperations();
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
				Swal.fire({
                    title: '¡Error!',
                    text: 'Se ha producido un error, verifique los datos enviados, y/o so conexión a internet y vuelva a intentarlo',
                    icon: 'error',
                });
			});
		},
		viewItem(element)
		{
			this.operation.clients_id = element.clients_id;
			this.setClientSelected();
			this.operation.assignment_id = element.assignment_id;
			this.setAssignment();
		 	this.operation.watchmen_id = element.watchmen.id;
			this.operation.assignment_selected.watchmen = [];
			this.operation.assignment_selected.watchmen.push(element.assignment_watchmen_origin);
			// this.operation.watchmen_selected = element.assignment_watchmen_origin;
			this.setWatchmen();
			this.operation.clients_transfer_id = element.client_transfer_selected;
			this.setClientTransfer();
			this.operation.assignment_transfer_id = element.assignment_transfer_id;
			this.setAssignmentTransfer();
			this.operation.shift_selected = element.shift_selected;
			this.operation.start_vigilant = element.start_vigilant;
			this.operation.start_date_vigilant = element.start_date_vigilant;
			this.action = 'view';
		},
		removeItem(element)
		{
			var url = '/admin_/operations/delete/'+element.id;
			Swal.fire({
        		title: 'Está seguro de eliminar el dato?',
        		html: "Si acepta eliminar no abrá vuelta atras, el dato será eliminado de forma permanente.<br/> Y la operación acá registrada se reiniciará",
        		icon: 'question',
        		showCancelButton: true,
        		confirmButtonColor: '#3085d6',
        		cancelButtonColor: '#d33',
        		confirmButtonText: 'Si, eliminar!'
        	}).then((result) => {
        		if (result.value) {
        			this.loading = true;
        			axios.delete(url).then(response => {
						this.loading = false;
						Swal.fire({
		                  position: 'center',
		                  icon: 'success',
		                  title: 'Se ha eliminado con éxito',
		                  showConfirmButton: false,
		                  timer: 1300
		                });
		                this.getOperations();
        			}).catch(error => {
						this.loading = false;
						Swal.fire({
		                    title: '¡Error!',
		                    text: 'Se ha producido un error, verifique los datos enviados, y/o so conexión a internet y vuelva a intentarlo',
		                    icon: 'error',
		                });
        			});     			
        		}
        	});
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
		this.loading = false;
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
		        'assignment_id': {
		        	required: true,
		        },
		        'watchmen_id': {
		        	required: true,
		        },
		        'clients_transfer_id': {
		        	required: true,
		        },
		        'assignment_transfer_id': {
		        	required: true,
		        },
		        'shift_selected': {
		        	required: true,
		        },
		        'start_vigilant': {
		        	required: true,
		        },
		        'start_date_vigilant': {
		        	required: true,
		        },
		    },
		    messages: {
		    	'clients_id': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'assignment_id': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'watchmen_id': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'clients_transfer_id': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'assignment_transfer_id': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'shift_selected': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    	'start_vigilant': {
		    		required: 'Este Campo es obligatorio.',
		    	},
		    	'start_date_vigilant': {
		    		required: 'Este Campo es obligatorio.'
		    	},
		    }
		});
	}
});