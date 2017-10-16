<script>
    import Post from './Post.vue';
    import NewPost from './NewPost.vue';
    import EditPost from './EditPost.vue';
    import DeletePost from './DeletePost.vue';

    export default {
        components: { Post, NewPost, DeletePost, EditPost },
        props: ['link', 'initPostsCount'],

        data() {
            return {
                bus: new Vue(),
                postCounter: this.initPostsCount,
                posts: [],

                resource: this.link,
                loading: true
            }
        },  
    
        computed: {
            canUpdate() {
                return window.App.isSignedIn && this.item.user_id == window.App.user.id;
            },
        },

        created() {
            this.load();
            this.bus.$on('deleted', id => this.remove(id));
            window.addEventListener('scroll', this.handleScroll);
        },

        methods: {
            load() {
                this.loading = true;
                axios.get(this.resource)
                    .then(response => {
                        this.refresh(response);
                        this.loading = false;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            handleScroll(event) {
                let diffOffset = document.body.offsetHeight - window.innerHeight,
                    scrolled = window.scrollY;

                if (diffOffset <= scrolled && !this.loading && this.resource) {
                    this.load();
                }
            },

            refresh(response) {
                this.posts = this.posts.concat(response.data.data);
                this.resource = response.data.next_page_url;
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