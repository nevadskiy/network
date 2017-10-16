<template>
    <div ref="post" class="media" :class="{'hidden-xs' : (item.depth > 1)}">
        <div class="media-left">
            <a :href="item.author.path">
                <img alt="64x64" class="media-object avatar" style="width: 64px; height: 64px;" :src="item.author.avatar_url" data-holder-rendered="true">
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
            <div :class="{'word-wrapper': item.depth}">
                <p class="post-body" v-text="body"></p> 
            </div>
            <div class="clearfix">
                <div class="pull-left">
                    <like :item="item"></like>
                    <button @click="replyingToggle" v-if="!replying && item.depth < 4" class="btn btn-xs btn-primary mr-1">Reply</button>
                </div>
                <div class="pull-right">
                    <button title="Edit"  v-if="canUpdate" @click="toggleEditModal" class="btn btn-xs btn-warning">Edit</button>
                    <button title="Delete" v-if="canDelete" @click="toggleDeleteModal" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                </div>
            </div>
            <reply-form :itemId="item.id" v-if="replying" @toggle="replying = false" @success="replyAdded"></reply-form>
           <div v-for="post in replies" :key="post.id">
                <hr>
                <post :bus="bus" :item="post" v-if="post.depth < 5"></post>
            </div>
        </div>
    </div>
</template>

<script>
    import authCheck from '../../mixins/authCheck';
    import updated_at from '../../mixins/updated_at';
    import Like from '../Like.vue';
    import ReplyForm from './ReplyForm.vue';

    export default {
        components: { Like, ReplyForm },
        mixins: [authCheck, updated_at],
        props: ['item', 'bus'],
        name: 'post',

        data() {
            return {
                body: this.item.body,
                replies: this.item.replies,
                replying: false,
                canDelete: false
            }
        },

        mounted: function () {
            this.canDeleteCheck(this);
        },

        computed: {
            canUpdate() {
                return window.App.isSignedIn && this.item.user_id == window.App.user.id;
            },
        },

        methods: {
            canDeleteCheck(element) {
                    if(!window.App.isSignedIn) {
                        return false;
                    }
                    if (element.canUpdate == true) {
                        return this.canDelete = true;
                    }
                    if (this.$parent.$refs.post) {
                        return this.canDeleteCheck(element.$parent);
                    }
                    return false;
                },

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
                this.bus.$emit('editModal', this.body, this.item.id);
                this.bus.$once('edited', (body) => this.update(body));
            },
            toggleDeleteModal() {
                this.bus.$emit('deleteModal', this.item);
            },
            update(body) {
                this.body = body;
                this.updated = true;
            }
        }
    }
</script>

<style>
  .word-wrapper {
    word-break: break-all;
  }
  .post-body {
    white-space: pre-line;
  }
</style>