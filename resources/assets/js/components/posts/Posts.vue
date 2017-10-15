<script>
    import Post from './Post.vue';
    import NewPost from './NewPost.vue';
    // import EditPost from './EditPost.vue';
    import DeletePost from './DeletePost.vue';

    export default {
        components: { Post, NewPost, DeletePost },
        props: ['link', 'initPostsCount'],

        data() {
            return {
                bus: new Vue(),
                postCounter: this.initPostsCount,
                posts: [],
                fetched: false,
                modalDelete: [],
            }
        },
    
        computed: {
            isEmptyFeedback() {
                return this.fetched && !this.posts.length;
            },
            canUpdate() {
                return window.App.isSignedIn && this.item.user_id == window.App.user.id;
            },
        },

        // watch: {
        //     posts() {
        //         let temp = this.posts;
        //         this.posts = [];
        //         this.posts = temp;
        //     }
        // },

        created() {
            this.fetch();
            this.bus.$on('deleted', id => this.remove(id));
        },

        methods: {
            fetch() {
                axios.get(this.link)
                    .then(response => {
                        this.refresh(response);
                        this.fetched = true;
                    });
            },

            refresh(response) {
                this.posts = response.data.data;
            },

            add(item) {
                this.postCounter++;
                this.posts.unshift(item);
            },

            remove(index) {
                // I dont know why that's not working
                // this.posts = this.filter(this.posts, index);
                let result = this.filter(this.posts, index);
                this.posts = [];
                setTimeout(() => {
                    this.posts = result;
                }, 100);
            },

            filter(data, id) {
                let that = this;
                  var r = data.filter(item => {
                    if (item.replies) item.replies = this.filter(item.replies, id);
                    return item.id != id
                  })
                  return r;
            },
        }
    }
</script>