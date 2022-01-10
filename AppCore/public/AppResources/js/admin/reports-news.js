new Vue({
	el: '#app-main',
	data: {
		loading: true,
		storage_folder: APP_URL+'storage/',
		query_s: {
			type: '',
			date_ini: '',
			date_end: '',
		},
		columns: [
            {label: 'Tipo', field: 'type'},
            {label: 'Puesto', field: 'client.name'},
            {label: 'Vigilante', field: 'vigilant_principal.name'},
            {label: 'Desde', field: 'date_ini'},
            {label: 'Hasta', field: 'date_end'},
            {label: 'Relevo', field: 'vigilant_change.name'},
            {label: 'Observaciones', field: 'details'},
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
			// location.href = url;
			window.open(url, "_blank");
		}
	},
	computed: {
    },
	mounted(){
		this.loading = false;
	}
});