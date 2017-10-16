import moment from 'moment';
export default {
	computed: {
		updated() {
			return this.item.created_at != this.item.updated_at;
		},
		updated_at() {
        	return moment(moment.utc(this.item.updated_at)).local().fromNow();
    	}
	}
}