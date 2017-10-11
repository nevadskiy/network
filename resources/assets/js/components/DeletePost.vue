<template>
    <div class="modal fade" id="delete-post" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Are you sure to delete this post?</h4>
                </div>
                <div class="modal-body">
                    <div class="media-left">
                        <a href="#">
                        <img alt="64x64" class="media-object" style="width: 64px; height: 64px;" src="/storage/avatars/default/boy.png" data-holder-rendered="true">
                    </a>
                    </div>
                    <div class="media-body">
                        <div class="media-heading clearfix">
                            <div class="pull-left">
                                <h4 class="mt-0">{{ username }}
                                <small>{{ created_at }}</small>
                            </h4>
                            </div>
                        </div>
                        <p>{{ body }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button @click="destroy" type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		props: ['postItem'],

		computed: {
			username() {
				return this.postItem.username ? this.postItem.username : ''
			},
			body() {
				return this.postItem.body ? this.postItem.body : '';
			},
			created_at() {
				return this.postItem.created_at ? this.postItem.created_at : '';
			},
			id() {
				return this.postItem.id ? this.postItem.id : '';
			}
		},

		methods: {
			destroy() {
				axios.delete('/api/post/' + this.id + '/delete');
                $('#delete-post').modal('hide');
                this.$emit('deleted', this.id);
				flash('Post deleted!');
			}
		}

	}
</script>