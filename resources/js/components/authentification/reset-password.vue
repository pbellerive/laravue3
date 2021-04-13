<template>
    <div class="bgLogin bg-cover bg-no-repeat">
         <div class="grid grid-cols-2 p-3">
            <div>
                <router-link to="/">
                    <img src="/images/logo_here.png" class="w-48 sm:w-60">
                </router-link>
            </div>
            <div class="flex flex-row justify-end text-white">
                <div class="flex-initial mr-1">
                    <t-button to="/register" class="uppercase hover:text-green-500">
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
                 <input type="hidden" name="token" v-model="credentials.token">
                <t-input @keypress.enter="reset()" v-model="credentials.email" type="text" :placeholder="$t('email')" class="w-full"/>
            </div>
            <div class="w-full">
                <t-input @keypress.enter="reset()" v-model="credentials.password" type="password"  :placeholder="$t('newPassword')" class="w-full" />
            </div>
            <div class="w-full">
                <t-input @keypress.enter="reset()" v-model="credentials.password_confirmation" type="password"  :placeholder="$t('passwordConfirmation')" class="w-full" />
            </div>
            <div class="w-full mt-8">
                <t-button @click="reset()" variant="primary" class="w-full">
                    {{$t('resetPassword')}}
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
                    password: '',
                    password_confirmation: '',
                    token: ''
                }
            }
        },
        methods: {
            reset() {
                axios.post('reset-password', this.credentials)
                    .then(response => {
                        this.$router.push('/login');
                    })
                    .catch(error => {
                        this.$root.$refs.$notification.show({
                            'title': this.$i18n.t('saving'),
                            'text': this.$i18n.t('errorOccur'),
                            'variant': 'danger'
                        });
                    })
            }
        },
        mounted() {
            this.credentials.token = this.$router.currentRoute.query.token;
            this.credentials.email = this.$router.currentRoute.query.email;
        }
    }
</script>

<style lang="css" scoped>
    .bgLogin {
        background-image: url('/images/jumpbox.jpg');
    }
</style>