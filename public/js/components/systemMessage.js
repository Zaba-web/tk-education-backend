Vue.component("system-message-container",{
    template: 
    `
        <div class="informer-wrapper">
            <system-message v-for="(msg, index) in this.messages" :key="index" :title='msg.title' :type='msg.type' :index="index"><span v-html="msg.msg"></span></system-message>
        </div>
    `,
    data(){
        return{
            messages: {}
        }
    },
    beforeMount(){
        this.messages = window.systemMessages;
    }
})

Vue.component("system-message",{
    props:["title", "type", "index"],
    template:`
        <div :class="this.type" class='informer-container show' :data-index='this.index'>
            <b class="h4-like white">{{this.title}}</b>
            <p class="white"><slot></slot></p>
            <a href='#' class='p-like white' v-on:click='close'>Закрити</a>
        </div>
    `,
    methods:{
        close: function(){
            this.$el.classList.add("close");
            setTimeout(()=>{
                window.systemMessages.splice(this.index,1);
                this.$el.classList.remove("close");
            },400);
        }
    },
    mounted(){
		if(this.type != "informative"){
			setTimeout(this.close,7000);
		}
    }
});
