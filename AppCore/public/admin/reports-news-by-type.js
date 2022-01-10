new Vue({
	el: '#app-main',
	data: {
		loading: true,
		storage_folder: APP_URL+'storage/',
		query_s: {
			type: TYPE_NEW,
			date_ini: '',
			date_end: '',
			watchmen: 'all',
		},
		columns: [
            {label: 'Vigilante', field: 'vigilant_principal.name'},
            {label: 'Fecha', field: 'date_ini'},
            {label: 'Doblaje de turno', field: 'shifts_double'},
            {label: 'Puesto & Turno de Origen', field: 'client.name'},
            {label: 'Puesto & Turno a cubrir', field: 'client_change.name'},
            // {label: 'address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        rows: [],
        all_watchmen: [],
        filter: '',
        per_page: 100,
	},
	created() {
		this.loading = true;
		this.getAllWatcmen();
	},
	methods: {
		getReport() {
			if (this.query_s.date_ini == '' || this.query_s.date_end == '' || this.query_s.date_ini > this.query_s.date_end) {
				Swal.fire({
                    title: '¡Error!',
                    text: 'Debe colocar una fecha y rango de fechas válidos',
                    icon: 'error',
                });
                return false;
			}
			this.rows = [];
			this.loading = true;
			axios.get('/admin_/news/getReport',{params: this.query_s})
			.then(response => {
				this.rows = response.data;
				this.loading = false;
			}).catch(error => {
				this.loading = false;
			});
		},
		printReport()
		{
			if (this.query_s.date_ini == '' || this.query_s.date_end == '' || this.query_s.date_ini > this.query_s.date_end) {
				Swal.fire({
                    title: '¡Error!',
                    text: 'Debe colocar una fecha y rango de fechas válidos',
                    icon: 'error',
                });
                return false;
			}
			var url = APP_URL + 'admin_/news/printReport?';
			url += 'type='+this.query_s.type+'&date_ini='+this.query_s.date_ini+'&date_end='+this.query_s.date_end;
			url += '&watchmen='+this.query_s.watchmen;
			// location.href = url;
			window.open(url, "_blank");
		},
		getAllWatcmen()
		{
			this.loading = true;
			axios.get('/admin_/watchmen/getAll').then(response => {
				this.all_watchmen = response.data;
				this.loading = false;
			});
		},
	},
	computed: {
    },
	mounted(){
		this.loading = false;
	}
});