<script>
    import Post from './Post.vue';
    import NewPost from './NewPost.vue';

    export default {
        components: { Post, NewPost },
        props: ['link', 'initPostsCount'],

        data() {
            return {
                postCounter: this.initPostsCount,
                posts: [],
                fetched: false,
                modalDelete: [],
            }
        },
        computed: {
            isEmptyFeedback() {
                return this.fetched && !this.posts.length;
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
                axios.get(this.link)
                    .then(response => this.refresh(response));
                this.fetched = true;
            },
            refresh(response) {
                this.posts = response.data.data;
            },

            add(item) {
                this.postCounter++;
                this.posts.unshift(item);
            },
            remove(index) {
                this.postCounter--;
                this.posts = this.posts.filter(function (item) {
                    return index != item.id;
                });
            }
        }
    }
</script>