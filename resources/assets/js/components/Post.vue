<template>
    <li class="media">
        <div class="media-left">
            <a href="#">
                <img alt="64x64" class="media-object" style="width: 64px; height: 64px;" src="/storage/avatars/default/boy.png" data-holder-rendered="true">
            </a>
        </div>
        <div class="media-body">
            <div class="media-heading clearfix">
                <div class="pull-left">
                    <h4 class="mt-0">{{ item.author.username }}</h4>
                </div>
                <div class="pull-right">
                    <p>{{ item.author.created_at }}</p>
                </div>
            </div>
            <p class="mb-0">{{ item.body }}</p>
            <div class="clearfix">
                <div class="pull-left" v-if="accessed">
                    <!-- <button @click="showEditModal" class="btn btn-xs btn-warning">Edit</button> -->
                    <button @click="showDeleteModal" class="btn btn-xs btn-danger">Delete</button>
                </div>
                <div class="pull-right">
                    <button @click="toggleReplyForm" v-if="!replying" class="btn btn-xs btn-primary">Reply</button>
                    <like :item="item"></like>
                </div>
            </div>

            <div v-if="replying" class="mt-1">
                <div class="form-group">
                    <input ref="reply" v-model="replyData"name="body" class="form-control" placeholder="You got something to reply?" autocomplete="off" autofocus>
                </div>
                <button @click="reply" class="btn btn-sm btn-primary" :class="disabled">Reply</button>
                <button @click="toggleReplyForm" class="btn btn-sm btn-link">Cancel</button>
            </div>

            <div class="mt-2" v-for="(reply, index) in replies">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img alt="64x64" class="media-object" style="width: 64px; height: 64px;" src="storage/avatars/default/boy.png" data-holder-rendered="true">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading clearfix">
                            <div class="pull-left">
                                {{ reply.author.username }}
                                <small>{{ reply.created_at }}</small>
                            </div>
                            <div class="pull-right"><button class="btn btn-default noutline mr-1"><span class="glyphicon glyphicon-heart"></span> 25</button></div>
                        </h4>
                        {{ reply.body }}
                    </div>
                </div>
                <div v-if="item.replies.length - 1 !== index">
                    <hr>
                </div>
            </div>
        </div>
    <edit-post v-show="editing" @edited="update" :post-item="item"></edit-post>
    </li>
</template>

<script>
    import Like from './Like.vue';
    import EditPost from './EditPost.vue';

    export default {
        components: { Like, EditPost },
        props: ['item'],

        data() {
            return {
                replies: this.item.replies,
                replying: false,
                replyData: '',
                editing: false,
            }
        },
        computed: {
            disabled() {
                return this.replyData.length ? '' : 'disabled';
            },
            accessed() {
                return this.item.user_id !== window.App.user.id;
            }
        },

        methods: {
            toggleReplyForm() {
                if (this.replying) {
                    this.replyData = '';
                }
                this.replying = !this.replying;
            },
            reply() {
                axios.post('/api/post/' + this.item.id + '/reply', {'body': this.replyData})
                    .then(response => {
                        this.replies.push(response.data);
                        this.toggleReplyForm();
                    });

                flash('Reply added!');
            },
            showDeleteModal() {
                this.$parent.$emit('modalDelete', this.item);
                $('#delete-post').modal();
            },
            showEditModal() {
                this.editing = true;
                $('#edit-post').modal();
            },
            update() {

            }

        }
    }
</script>