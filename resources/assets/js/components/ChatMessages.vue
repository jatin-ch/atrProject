<style>
.chat li{
list-style:none;
}
</style>

<template>
    <ul class="chat">
        <li class="media left clearfix" v-for="message in messages">
            <div class="media-body chat-body clearfix">
                <div class="header">
                    {{ message.message }}
                </div>
                <small>
                    {{ message.user.name }} | <i class="fa fa-clock-o"></i> {{ message.created_at  }}
                </small>
            </div>
        </li>
    </ul>
</template>

<script>
  export default {
    props: ['messages']
  };
</script>
