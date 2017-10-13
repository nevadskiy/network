<template>
    <div class="mt-1">
        <div class="form-group" :class="{'has-error': hasError }">
            <input ref="reply" v-model="inputData" name="body" class="form-control" placeholder="You got something to reply?" autocomplete="off" autofocus>
            <span v-text="lengthValidation" class="help-block"></span>
        </div>
        <button @click="reply" class="btn btn-sm btn-primary" :class="{'disabled': disabled}">Reply</button>
        <button @click="toggleReplyForm" class="btn btn-sm btn-link">Cancel</button>
    </div>
</template>
<script>
    import postFormValidation from '../../mixins/postFormValidation';
	export default {
		props: ['itemId'],
		mixins: [postFormValidation],

		// data() {
		// 	return {
  //               inputData: '',
  //               isValidError: false,
		// 	}
		// },
		// computed: {
  //           lengthValidation() {
  //               return 'Left : ' + (255 -this.inputData.length);
  //           },
  //           hasError() {
  //               return (this.isValidError && this.disabled) || this.inputData.length > 255;
  //           },
  //           disabled() {
  //               return this.inputData.length < 1 || this.inputData.length > 255;
  //           },
		// },
		methods: {
            toggleReplyForm() {
                this.inputData = '';
                this.isValidError = false;
                this.$emit('toggle');
            },
            reply() {
                if (!this.disabled) {
                    axios.post('/api/post/store/' + this.itemId, {'body': this.inputData})
                    .then(response => {
                    	this.$emit('success', response.data);
                        // this.replies.push(response.data);
                        this.toggleReplyForm();
                        flash('Reply added!');
                    }).catch(response => {
                        flash(response.message, 'danger');
                    });
                } else {
                    this.isValidError = true;
                }
            },
		}
	}
</script>