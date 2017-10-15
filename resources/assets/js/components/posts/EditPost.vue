<template>
    <div class="modal fade" :id="'edit-post'+postId" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Post Editing</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" :class="{'has-error': hasError }">
                        <textarea id="edit-post-field" class="form-control" autofocus v-model="inputData"></textarea>
                        <span v-text="lengthValidation" class="help-block inline-block ml-2"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button @click="update" :class="{'disabled': disabled || notChanged}" type="button" class="btn btn-warning">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import postFormValidation from '../../mixins/postFormValidation';
	export default {
        mixins: [postFormValidation],

		props: ['postBody', 'postId'],

        data() {
            return {
                inputData: this.postBody,
            }
        },
        computed: {
            notChanged() {
                return this.inputData == this.postBody;
            }
        },

		methods: {
			update() {
                console.log(this.postId);
                if (this.disabled || this.notChanged) {
                    return this.isValidError = true;
                }
                axios.put('/api/post/' + this.postId, {'body': this.inputData})
                    .then(() => {
                        this.$emit('edited', this.inputData);
                        flash('Post changed', 'warning');
                    })
                    .catch(() => {
                        flash('Post has not been updated', 'danger');
                    });



                // let that = this;
                // console.log('emited test');
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