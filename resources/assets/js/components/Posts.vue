<script>
    import Post from './Post.vue';
    import DeletePost from './DeletePost.vue';
    import NewPost from './NewPost.vue';

    export default {
        components: { Post, DeletePost, NewPost },

        data() {
            return {
                posts: [],
                modalDelete: [],
            }
        },

        created() {
            this.fetch();
            this.$on('modalDelete', item => {
                this.modalDelete = item;
            });
        },

        methods: {
            fetch() {
                axios.get('/api/id1/posts')
                    .then(response => this.refresh(response));
            },
            refresh(response) {
                this.posts = response.data.data;
            },

            add(item) {
                console.log(item);
                this.posts.unshift(item);
            },
            remove(index) {
                this.posts = this.posts.filter(function (item) {
                    return index != item.id;
                });
            }
        }
    }
</script>