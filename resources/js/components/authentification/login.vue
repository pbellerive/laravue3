<template>
    <div class="bgLogin">
         <div class="grid grid-cols-2 p-3">
            <div>
                 <router-link to="/">
                    <img src="/images/site-icon.jpg" class="w-10 sm:w-10">
                </router-link>
            </div>
            <div class="flex flex-row justify-end text-white">
                <div class="flex-initial mr-1">
                    <t-button to="/register" class="uppercase hover:text-green-jem-500">
                        {{$t('register')}}
                    </t-button>
                </div>
            </div>
        </div>
        <div class="container max-w-sm mx-auto grid grid-rows-3 justify-items-center">
            <h1 class="uppercase font-bold text-5xl my-5 text-white">
                {{$t('login')}}
            </h1>
            <div class="mb-2 w-full">
                <t-input @keypress.enter="login()" v-model="credentials.email" type="text" :placeholder="$t('email')" class="w-full"/>
            </div>
            <div class="w-full">
                <t-input @keypress.enter="login()" v-model="credentials.password" type="password"  :placeholder="$t('password')" class="w-full" />
            </div>
            <div class="w-full">
                <t-button @click="login()" variant="primary" class="w-full">
                    {{$t('login')}}
                </t-button>
            </div>
        </div>
    </div>

</template>

<script>

    export default {
        data() {
            return {
                credentials: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            login() {
                axios.get('sanctum/csrf-cookie', {baseURL: '/'}).then(response => {
                    this.authenticate();
                });
            },
            authenticate() {
                axios.post('login', this.credentials)
                    .then(response => {
                        this.$store.commit('session/setUser', response.data.user);
                        this.$store.commit('session/setToken', response.data.token);
                        this.$router.push('/dashboard');
                    })
                    .catch(error => {
                        this.$root.$refs.$notification.show({
                            'title': this.$i18n.t('saving'),
                            'text': this.$i18n.t('errorOccur'),
                            'variant': 'danger'
                        });
                    })
            }
        }
    }
</script>

<style lang="css" scoped>
    .bgLogin {
        background-image: url('/images/jumpbox.jpg');
        background-repeat: none;
        background-size: cover;
    }
</style>