<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">
        
        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user','reciever'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                console.log('iam working')
                console.log(this.reciever)
                 if(!this.newMessage || this.newMessage.trim() === '') {
                    return
                }
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage,
                    reciever:this.reciever
                });

                this.newMessage = ''
            }
        }    
    }
</script>
