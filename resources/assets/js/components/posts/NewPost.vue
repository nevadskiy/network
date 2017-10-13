<template>
	<div>
		<div class="form-group" :class="{'has-error': hasError }">
			<textarea v-model="inputData" rows="3" class="form-control" placeholder="What's new?"></textarea>
		</div>
		<div>
			<button @click="post" class="btn btn-primary inline-block" :class="{'disabled': disabled}">Post</button>
			<span v-text="lengthValidation" class="help-block inline-block ml-2"></span>
		</div>
	</div>
</template>

<script>
	import postFormValidation from '../../mixins/postFormValidation';

	export default {
		mixins: [postFormValidation],

		methods: {
			post() {
				if (!this.disabled) {
					axios.post('/api/post/store', {body: this.inputData})
					.then(response => {
						this.inputData = '';
						flash('Posted successfully');
						this.$emit('posted', response.data)
					});
				} else {
                    this.isValidError = true;
                }
			}
		}
	}
</script>
<style>
	.inline-block {
		display: inline-block;
	}
</style>