<script>
    import FollowButton from './FollowButton.vue';
    
    export default {
        components: { FollowButton },

        props: ['initFollowing', 'initFollowers'],

        data() {
            return {
                followingsCount: this.initFollowing,
                followersCount: this.initFollowers,
            }
        }
    }
</script>