<template>
    <button @click="toggle" class="btn btn-xs noutline mr-1" :class="classToggle">Like <span class="glyphicon glyphicon-heart"></span> {{ likesCount != 0 ? likesCount : '' }}</button>
</template>

<script>
    export default {
        props: ['item'],

        data() {
            return {
                isLiked: this.item.isLiked,
                likesCount: this.item.likes_count,
                url: '/api/post/' + this.item.id + '/like'
            }
        },

        computed: {
            classToggle() {
                return this.isLiked ? 'btn-primary' : 'like-button btn-link';
            }
        },

        methods: {
            toggle() {
                if (this.isLiked) {
                    this.unlike();
                } else {
                    this.like();
                }
            },

            like() {
                axios.post(this.url);
                this.isLiked = true;
                this.likesCount++;
            },

            unlike() {
                axios.delete(this.url);
                this.isLiked = false;
                this.likesCount--;
            }
        }
    }
</script>

<style>
    .like-button {
        color: #0d87e9!important;
    }
</style>