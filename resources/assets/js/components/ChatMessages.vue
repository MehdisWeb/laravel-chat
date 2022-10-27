<template>
<div v-if="user.id == 4">
    <ul class="chat">
        <li class="left clearfix" :key = message.id v-for="message in messages">
            <div 
             v-bind:class="{
                'moveright': message.user.id == user.id,
                }"
            class="chat-body clearfix" v-if="(message.reciever == user.id && reciever == message.user.id)|| (message.user.id == user.id && reciever == message.reciever)">
                <div class="header">
                    <strong class="primary-font">
                     
                     
                    </strong>
                </div>
                <p>
                    {{ message.message }}  
                </p>
            </div>
        </li>
    </ul>
</div>
<div v-else>
    <ul class="chat">
        <li class="left clearfix" :key = message.id v-for="message in messages">
            <div 
                v-bind:class="{
                'moveright': message.user.id == user.id,
                }"
                class="chat-body clearfix " v-if="message.reciever == user.id || message.user.id == user.id">
                <div class="header">
                    <strong class="primary-font">
                     
                     
                    </strong>
                </div>
                <p>
                    {{ message.message }}  
                </p>
            </div>
        </li>
    </ul>
</div>
</template>

<script>
export default {
  props: ['messages','user','reciever'],
  mounted() {
            console.log(this.user.id)
            

        }
};
</script>

<style scoped>

.moveright p{
text-align:right;
 direction:rtl;
}
</style>