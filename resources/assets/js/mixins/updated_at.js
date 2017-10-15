import moment from 'moment';
export default {
	computed: {
		updated() {
			this.item.created_at != this.item.updated_at
		},
		updated_at() {
        	return moment(moment.utc(this.item.updated_at)).local().fromNow();
    	}
	}
}