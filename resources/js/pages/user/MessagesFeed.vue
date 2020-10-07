<template>
    <div class="feed" ref="feed" v-if="contact">
        <ul  v-for="message in messages" :key="message.id" >
            <li v-if="message.user_from == contact.id"  class="message received" >  
                <img :src="'/images/' + contact.pic" style="width:30px; height:30px; border-radius:100%; margin-left:5px">
                <div class="text">
                    {{ message.msg }}
                </div>
            </li>
            <li v-else  class="message sent">
                <div class="text">
                    {{ message.msg }}
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            }
        },
        // ready: function() {
        //     this.created();
        // },
        // created() {
        //     // this.conID = response.data[0].conversation_id
        //     console.log(1);
        //     console.log(this.messages)
        // },

        methods: {
            // scroll xuong duoi khi co tin nhan moi
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
        }
    }
</script>

<style lang="scss" scoped>
.feed {
    background: #f0f0f0;
    height: 100%;
    max-height: 400px;
    overflow: scroll;

    ul {
        list-style-type: none;
        padding: 5px;

        li {
            &.message {
                margin: 10px 0;
                width: 100%;

                .text {
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }

                &.received {
                    text-align: left;

                    .text {
                        background: #b2b2b2;
                    }
                }

                &.sent {
                    text-align: right;

                    .text {
                        background: #81c4f9;
                    }
                }
            }
        }
    }
}
</style>

