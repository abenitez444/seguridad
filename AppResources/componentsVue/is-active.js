Vue.component('is-active', {
	props: ['is_active'],
	template: 	`<span v-if="is_active == 1" class="badge badge-success badge-pill">ACTIVO</span>
				<span v-else  class="badge badge-warning badge-pill">INACTIVO</span>`,
});
