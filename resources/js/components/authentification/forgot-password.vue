<template>
    <div class="bgLogin bg-repeat-y">
        <div class="flex flex-row bg-transparent">
            <div class="flex-initial pt-0 sm:pt-5">
                 <router-link to="/">
                    <img src="/images/logo_here.png" class="ml-10 md:ml-20 w-24 sm:w-60">
                </router-link>
            </div>
            <div class="flex flex-row flex-grow justify-end items-center text-white">
                <div class="flex-initial">
                    <t-button to="/login" class="uppercase hover:text-green-500 text-sm md:text-lg">
                        {{$t('login')}}
                    </t-button>
                </div>
                <div class="flex-initial">
                    <t-button to="/register" class="uppercase hover:text-green-500 text-sm md:text-lg">
                        {{$t('register')}}
                    </t-button>
                </div>
            </div>
        </div>
        <div class="container max-w-sm px-1 md:max-w-2xl mx-auto justify-items-center">
            <h1 class="uppercase font-bold text-5xl pt-5 text-white text-center">
                {{$t('forgotPassword')}}
            </h1>
            <div>
                <t-input-group :label="$t('email')">
                    <t-input v-model="email" id="email" placeholder="john.doe@email.com" />
                </t-input-group>
            </div>
            <div>
                <t-button @click="sendt" variant="primary" class="w-full mt-2">
                    {{$t('sendPasswordResetLink')}}
                </t-button>
            </div>
        </div>
    </div>

</template>

<script>

    export default {
        data() {
            return {
                email: ''
            }
        },
        methods: {
            sendt() {
                axios.post('/forgot-password', { 'email': this.email } )
                    .then(response => {
                        this.$router.push('/login');
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;

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