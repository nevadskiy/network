<template>
	<div>
		<div class="form-group">
			<textarea v-model="body" rows="3" class="form-control" placeholder="What's new?"></textarea>
		</div>
		<button @click="post" class="btn btn-primary" :class="disabled" >Post</button>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				body: '',
			}
		},
		computed: {
			disabled() {
				return this.body.length ? '' : 'disabled';
			}
		},
		methods: {
			post() {
				axios.post('/api/post/store', {body: this.body})
				.then(response => {
					this.body= '';
					flash('Reply posted');
					this.$emit('posted', response.data)
					console.log('emited');
				})
			}
		}
	}
</script>