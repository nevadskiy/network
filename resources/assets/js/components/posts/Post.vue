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
                    <button @click="replyingToggle" v-if="!replying && item.depth < 4" class="btn btn-xs btn-primary mr-1">Reply</button>
                    <like :item="item"></like>
                </div>
                <div class="pull-right">
                    <button v-if="canUpdate" @click="toggleEditModal" class="btn btn-xs btn-warning">Edit</button>
                    <button v-if="canDelete" @click="toggleDeleteModal" class="btn btn-xs btn-danger">Delete</button>
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

        created() {            
            this.canDeleteCheck(this);
        },

        computed: {
            canUpdate() {
                return window.App.isSignedIn && this.item.user_id == window.App.user.id;
            },
        },

        methods: {
            canDeleteCheck(element) {
                    if(!window.App.isSignedIn || typeof element.canUpdate == 'undefined') {
                        return false;
                    }
                    if (element.canUpdate == true) {
                        return this.canDelete = true;
                    }
                    return this.canDeleteCheck(element.$parent);
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
                $('#edit-post'+this.item.id).modal('toggle');
            },
            toggleDeleteModal() {
                this.bus.$emit('deleteModal', this.item);
            },
            update(body) {
                this.body = body;
                this.updated = true;
                this.toggleEditModal();
            },
            remove(index) {
                function filterData(data, id) {
                  var r = data.filter(function(o) {
                    if (o.children) o.children = filterData(o.children, id);
                    return o.id != id
                  })
                  return r;
                }
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