<template>
    <div class="modal fade" id="edit-modal" role="dialog">
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
        props: ['bus'],

        mixins: [postFormValidation],

        data() {
            return {
                inputData: '',
                id: ''
            }
        },
        computed: {
            notChanged() {
                return this.inputData == this.postBody;
            }
        },

        created() {
            this.bus.$on('editModal', (body, id) => {
                this.inputData = body;
                this.id = id;
                $('#edit-modal').modal();
            });
        },

		methods: {
			update() {
                if (this.disabled || this.notChanged) {
                    return this.isValidError = true;
                }
                axios.put('/api/post/' + this.id, {'body': this.inputData})
                    .then(() => {
                        this.bus.$emit('edited', this.inputData);
                        flash('Post changed', 'warning');
                    })
                    .catch(() => {
                        flash('Post has not been updated', 'danger');
                    });
                $('#edit-modal').modal('hide');
			}
		}

	}
</script>