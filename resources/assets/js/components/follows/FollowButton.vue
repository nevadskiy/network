<template>
	<button @click="toggle" class="btn" :class="classToggle"><strong v-text="textButton"></strong></button>
</template>
<script>
import authCheck from '../../mixins/authCheck';
export default {
        props: ['userId', 'initIsFollowed'],
        mixins: [authCheck],

        data() {
            return {
                isFollowed: this.initIsFollowed,
            }
        },

        computed: {
            classToggle() {
                return this.isFollowed ? 'btn-warning' : 'btn-primary';
            },
            textButton() {
            	return this.isFollowed ? 'Unfollow' : 'Follow';
            }
        },

        methods: {
            toggle() {
                if (!this.authCheck()) {
                    return;
                }

                if (this.isFollowed) {
                    this.unfollow();
                } else {
                    this.follow();
                }
            },

            follow() {
                axios.post('/api/follow/' + this.userId)
                    .then(() => {
                        this.isFollowed = true;
                        this.$emit('followed');
                    })
            },

            unfollow() {
                axios.delete('/api/follow/' + this.userId)
                    .then(() => {
                        this.isFollowed = false;
                        this.$emit('unfollowed');
                    });
            }
        }
    }
</script>