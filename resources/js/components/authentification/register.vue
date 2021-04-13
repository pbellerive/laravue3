<template>
    <div class="bgLogin bg-repeat-y">
        <div v-if="disabled">
            <h1 class="text-7xl text-center pt-10">
                {{$t('registrationDisabled')}}
            </h1>
        </div>
        <div v-else>
            <div class="container max-w-sm px-1 md:max-w-2xl mx-auto justify-items-center">
                <h1 class="uppercase font-bold text-5xl pt-5 text-white text-center">
                    {{$t('register')}}
                </h1>
                <!-- ******************************************** -->
                 <div class="grid grid-cols-none grid-flow-row divide-y-2 divide-green-500">
                    <div class="grid grid-cols-2 my-4">
                        <div class=" mr-1">
                            <t-input-group :label="$t('firstName')" :feedback="getError('first_name')">
                                <t-input v-model="user.first_name" id='firstName' placeholder="John" maxlength="255"/>
                            </t-input-group>
                        </div>
                        <div class="ml-1">
                            <t-input-group :label="$t('lastName')" :feedback="getError('last_name')">
                                <t-input v-model="user.last_name" id="lastName" placeholder="Doe" maxlength="255"/>
                            </t-input-group>
                        </div>
                    </div>
                    <div  class="my-4 pt-6">
                        <div class="grid grid-cols-2">
                            <div  class="my-6 mr-1">
                                <t-input-group :label="$t('email')" :feedback="getError('email')">
                                    <t-input v-model="user.email" id="email" placeholder="john.doe@email.com" />
                                </t-input-group>
                            </div>
                            <div class="my-6 ml-1">
                                <t-input-group :label="$t('birthDate')" :feedback="getError('birth_date')">
                                    <t-datepicker v-model="user.birth_date">
                                    </t-datepicker>
                                </t-input-group>
                            </div>

                            <div>
                                 <t-input-group :label="$t('preferredLocale')" :feedback="getError('preferred_locale')">
                                        <t-select v-model="user.preferred_locale"
                                            @change="setLocale(user.preferred_locale)"
                                            :placeholder="$t('selectOption')"
                                            :options="[
                                                { text: $t('fr'), value: 'fr'},
                                                {text: $t('en'), value: 'en'}
                                            ]"
                                            variant="default"
                                    ></t-select>
                                 </t-input-group>
                            </div>
                        </div>
                    </div>
                    <div class="my-4 pt-6">
                        <div class="grid grid-cols-2">
                            <div class="mr-1">
                                <t-input-group :label="$t('country')">
                                    <t-select v-model="user.country_id"
                                        :placeholder="$t('selectOption')"
                                        :options="countries"
                                        variant="default"
                                    ></t-select>
                                </t-input-group>
                            </div>
                            <div class="mr-1">
                                <t-input-group :label="$t('address')">
                                    <t-input v-model="user.address" maxlength="255"/>
                                </t-input-group>
                            </div>
                            <div class="ml-1">
                                <t-input-group :label="$t('city')">
                                    <t-input v-model="user.city" maxlength="50"/>
                                </t-input-group>
                            </div>
                            <div class="ml-1 grid grid-cols-2">
                                <div class="mr-1">
                                    <t-input-group :label="$t('state')">
                                        <t-select v-model="user.state_id"
                                            :placeholder="$t('selectOption')"
                                            :options="states"
                                            variant="default"
                                    ></t-select>

                                    </t-input-group>
                                </div>
                                <div class="mr-1">
                                    <t-input-group :label="$t('postalCode')">
                                        <t-input v-model="user.postal_code" maxlength="12" />
                                    </t-input-group>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="my-4 pt-6">
                        <div class="grid grid-cols-2">
                            <div class="mr-1">
                                <t-input-group :label="$t('phone')">
                                    <t-input v-model="user.phone_number" maxlength="12"/>
                                </t-input-group>
                            </div>
                            <div class="ml-1">
                                <t-input-group :label="$t('cellPhoneNumber')">
                                    <t-input v-model="user.cell_phone_number" maxlength="12"/>
                                </t-input-group>
                            </div>
                        </div>
                    </div>
                    <div class="my-4 pt-6">
                        <div class="grid grid-row-2 sm:grid-cols-2">
                            <div class="mr-1">
                                <t-input-group :label="$t('password')" :feedback="getError('password')">
                                    <t-input v-model="user.password" type="password" id="password"/>
                                </t-input-group>
                            </div>
                            <div class="ml-1">
                                <t-input-group
                                    :label="$t('passwordConfirmation')"
                                >
                                    <t-input v-model="user.password_confirmation" type="password" id="password-confirmation" />
                                </t-input-group>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ******************************************** -->
                <div class="w-full">
                    <t-button @click="register()" variant="primary" class="w-full">
                        {{$t('register')}}
                    </t-button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    export default {
         created() {
            this.fetchCountries();
            this.fetchStates();
        },
        data() {
            return {
                countries: [],
                errors: [],
                states: [],
                user: {
                    email: '',
                    password: '',
                    password_confirmation: '',
                    preferred_locale: 'fr'
                },
                disabled: false
            }
        },
        methods: {
            getError(fieldName) {
                let error = this.errors[fieldName] || undefined;
                if (error) {
                    return  error[0];
                }

                return ''
            },
            fetchCountries() {
                axios.get('countries').then(response => {
                    this.countries = response.data.data;
                });
            },
            fetchStates() {
                axios.get('states').then(response => {
                    this.states = response.data.data;
                });
            },
            register() {
                axios.post('sanctum/csrf-cookie', {baseURL: '/'}).then(response => {
                    this.authenticate();
                });


            },
            register() {
                axios.post('register', this.user)
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