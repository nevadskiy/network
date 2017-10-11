<template>
    <ul class="alert-list">
        <li v-for="message in messages">
            <div class="alert alert-success alert-dismissible flash">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ message }}
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                messages: []
            }
        },

        methods: {
            flash(message) {
                this.messages.push(message);
                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.messages.shift()
                }, 8000);
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message)
            };
            window.events.$on('flash', message => this.flash(message));
        }
    }
</script>

<style>
    .alert-list {
        text-align: right;
        list-style-type: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
    }

    .flash {
        display: inline-block;
        width: auto;
    }
</style>