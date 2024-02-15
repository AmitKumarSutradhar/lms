import './bootstrap';

import { createApp } from 'vue'
import SendMessage from './components/SendMessage.vue'


const app = createApp({
    components:{
        SendMessage,
    }
});

// app.component('send-message', SendMessage)

app.mount('#app')

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
