<template>
    <div class="modal fade" id="delete-modal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Are you sure to delete this post?</h4>
                </div>
                <div class="modal-body">
                    <div class="media-left">
                        <a :href="item.author.path">
                        <img alt="64x64" class="media-object" style="width: 64px; height: 64px;" :src="item.author.avatar_url" data-holder-rendered="true">
                    </a>
                    </div>
                    <div class="media-body">
                        <div class="media-heading clearfix mb-0">
                            <div class="pull-left">
                                    <h4 class="mt-0"><a class="hlink" :href="item.author.path">{{ item.author.username }}</a></h4>
                                </div>
                            <div class="pull-right text-right">
                                <p class="mb-0" <span v-if="updated" class="label label-default mt-0 text-right">Updated</span> {{ updated_at }}</p>
                            </div>
                        </div>
                        <p class="post-body">{{ item.body }}</p> 
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
    import updated_at from '../../mixins/updated_at';

	export default {
        mixins: [updated_at],

		props: ['bus'],

        data() {
            return {
                item: {
                    updated_at: 0,
                    created_at: 0,
                    body: '',
                    author: {
                        username: '',
                        avatar: '',
                        path: '',
                    }
                }
            }
        },

        created() {
            this.bus.$on('deleteModal', item => {
                $('#delete-modal').modal();
                this.item = item;
            });
        },

		methods: {
			destroy() {
				axios.delete('/api/post/' + this.item.id )
                    .then(() => {
                        this.bus.$emit('deleted', this.item.id);
                        flash('Post has been deleted!', 'info');
                    })
                    .catch(response => {
                        flash(response.message, 'danger');
                    });
                $('#delete-modal').modal('hide');
			}
		}

	}
</script>