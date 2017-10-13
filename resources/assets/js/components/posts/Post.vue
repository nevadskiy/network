<template>
    <div class="media" :class="{'hidden-xs' : (item.depth > 1)}">
        <div class="media-left">
            <a :href="item.author.path">
                <img alt="64x64" class="media-object avatar" style="width: 64px; height: 64px;" :src="item.author.avatar_url" data-holder-rendered="true">
            </a>
        </div>
        <div class="media-body">
            <div class="media-heading clearfix mb-0">
                <div class="pull-left">
                        <h4 class="mt-0"><a class="btn-link" :href="item.author.path">{{ item.author.username }}</a></h4>
                    </div>
                <div class="pull-right text-right">
                    <p class="mb-0"><span v-if="updated" class="label label-default mt-0 text-right">Updated</span> {{ updated_at }}</p>
                </div>
            </div>
            <div :class="{'word-wrapper': item.depth}">
                <p v-text="body"></p> 
            </div>
            <div class="clearfix">
                <div class="pull-left">
                    <button @click="replyingToggle" v-if="!replying && item.depth < 4" class="btn btn-xs btn-primary mr-1">Reply</button>
                    <like :item="item"></like>
                </div>
                <div class="pull-right" v-if="accessed">
                    <button @click="toggleEditModal" class="btn btn-xs btn-warning">Edit</button>
                    <!-- <button @click="showDeleteModal" class="btn btn-xs btn-danger">Delete</button> -->
                </div>
            </div>
            <reply-form :itemId="item.id" v-if="replying" @toggle="replying = false" @success="replyAdded"></reply-form>
           <div v-for="post in replies" :key="post.id">
                <hr>
                <post :item="post" v-if="post.depth < 5"></post>
            </div>
        </div>

    <edit-post @edited="update" :post-body="item.body" :post-id="item.id"></edit-post>
    <!-- <delete-post v-show="deleting" @deleted="remove" :post-item="item"></delete-post> -->
    <!-- <delete-post v-show="deleting" @deleted="remove" :post-item="item"></delete-post> -->

    </div>
</template>

<script>
    import authCheck from '../../mixins/authCheck';
    import Like from '../Like.vue';
    import moment from 'moment';
    import ReplyForm from './ReplyForm.vue';
    import EditPost from './EditPost.vue';
    // import DeletePost from './DeletePost.vue';

    export default {
        components: { Like, ReplyForm, EditPost },
        mixins: [authCheck],
        props: ['item'],
        name: 'post',

        data() {
            return {
                body: this.item.body,
                replies: this.item.replies,
                replying: false,
                updated: this.item.created_at != this.item.updated_at
            }
        },
        computed: {
            // updated() {
            //         return this.item.created_at != this.item.updated_at;
            // },
            updated_at() {
                return moment(moment.utc(this.item.updated_at)).local().fromNow();
            },
            accessed() {
                return window.App.isSignedIn && this.item.user_id == window.App.user.id;
            },
        },

        methods: {
            replyAdded(reply) {
                this.replies.push(reply);
            },
            replyingToggle() {
                if (!this.authCheck()) {
                    return;
                }
                this.replying = true;
            },
            toggleEditModal() {
                $('#edit-post'+this.item.id).modal('toggle');
            },
            // remove() {
            //     this.$parent.$emit('deleted', this.item.id);
            // },

            update(body) {
                this.body = body;
                this.updated = true;
                this.toggleEditModal();
            }
        }
    }
</script>

<style>
  .word-wrapper {
    word-break: break-all;
  }
</style>