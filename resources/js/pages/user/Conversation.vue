<template>
    <div class="conversation col-md-6 col-sm-12 col-xs-12 center-con">
        <h1 v-if="contact">
            <img :src="'/images/' + contact.pic" style="width:30px; height:30px; border-radius:100%; margin-left:5px"> {{contact.name}}     
        </h1>
        <h1 v-else>
            Select a Contact
        </h1>
        <MessagesFeed :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage"/>
    </div>
</template>

<script>
    import MessagesFeed from './MessagesFeed';
    import MessageComposer from './MessageComposer';

    export default {
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                conID: '',
            }
        },

        methods: {
            sendMessage(msg) {
                if (!this.contact) {
                    return;
                }
                console.log(this.messages.length);
                if(this.messages.length == 0) {
                    axios.post('/conversation/send', {
                        contact_id: this.contact.id,
                        msg: msg
                    }).then((response) => {
                        this.$emit('newMess', response.data);
                    })
                    return;

                }

                axios.post('/conversation/send', {
                    contact_id: this.contact.id,
                    msg: msg,
                    conID : this.messages[0].conversation_id
                }).then((response) => {
                    this.$emit('newMess', response.data);
                })
            }
        },
        components: {MessagesFeed, MessageComposer}
    }
</script>

<style lang="scss" scoped>
.conversation {
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    h1 {
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
    }
}
</style>
