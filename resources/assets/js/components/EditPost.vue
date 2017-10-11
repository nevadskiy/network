<template>
    <div class="modal fade" id="edit-post" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Post Editing</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea id="edit-post-field" class="form-control" autofocus v-model="body"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button @click="update" type="button" class="btn btn-warning">Update</button>
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
			body() {
				return this.postItem.body ? this.postItem.body : '';
			},
			id() {
				return this.postItem.id ? this.postItem.id : '';
			}
		},

		methods: {
			update() {
                // let that = this;
                console.log('emited test');
                // console.log(this.$parent.$children.filter(function(child) {
                //    return true;
                //    // return child.id == 103;
                // }));
                // this.$parent.$emit('test');
				// axios.delete('/api/post/' + this.id + '/delete');
                // $('#delete-post').modal('hide');
                // this.$emit('deleted', this.id);
				// flash('Post deleted!');
			}
		}

	}
</script>