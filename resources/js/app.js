import { createApp } from 'vue';
import LoginRegister from './components/LoginRegister.vue';

const app = createApp({});
app.component('login-register', LoginRegister);
app.mount("#app");
