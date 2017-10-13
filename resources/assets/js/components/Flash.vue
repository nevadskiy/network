<template>
    <ul class="alert-list">
        <li v-for="message in messages">
            <div  :class="'alert-'+message.s" class="alert alert-dismissible flash">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ message.m }}
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['message', 'type'],

        data() {
            return {
                messages: []
            }
        },

        methods: {
            flash(message, style) {
                this.messages.push({m: message, s: style});
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
                this.flash(this.message, this.type)
            };
            window.events.$on('flash', (message, style) => this.flash(message, style));
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