<template>
  <div class="bgLogin bg-repeat-y">
    <div v-if="disabled">
      <h1 class="text-7xl text-center pt-10">
        {{ $t('registrationDisabled') }}
      </h1>
    </div>
    <div v-else>
      <div class="max-w-2xl mx-auto">
        <h1 class="uppercase font-bold text-5xl pt-5 text-black text-center">
          {{ $t('register') }}
        </h1>
        <!-- ******************************************** -->
        <div class="grid grid-cols-none grid-flow-row divide-y-2 divide-gray-300">
          <div class="grid grid-cols-2 my-4 gap-3">
            <div>
              <v-input variant="default" v-model="user.first_name" id="firstName" maxlength="255" :label="$t('firstName')" />
            </div>
            <div>
              <v-input variant="default" v-model="user.last_name" id="lastName" maxlength="255" :label="$t('lastName')" />
            </div>
          </div>
          <div class="my-4 pt-6">
            <div class="grid grid-cols-2 gap-3">
              <div class="my-6 mr-1">
                <v-input variant="default" v-model="user.email" id="email" :label="$t('email')" />
              </div>
              <div class="my-6 ml-1">
                <v-date-picker v-model="user.birth_date" :label="$t('birthDate')"> </v-date-picker>
              </div>

              <div>
                <t-select
                  :label="$t('preferredLocale')"
                  v-model="user.preferred_locale"
                  @change="setLocale(user.preferred_locale)"
                  :placeholder="$t('selectOption')"
                  :options="[
                    { text: $t('fr'), value: 'fr' },
                    { text: $t('en'), value: 'en' },
                  ]"
                  variant="default"
                ></t-select>
              </div>
            </div>
          </div>
          <div class="my-4 pt-6">
            <div class="grid grid-cols-2">
              <div class="mr-1">
                <v-select v-model="user.country_id" :placeholder="$t('selectOption')" :options="countries" variant="default" :label="$t('country')"></v-select>
              </div>
              <div class="mr-1">
                <v-input variant="default" v-model="user.address" maxlength="255" :label="$t('address')" />
              </div>
              <div class="ml-1">
                <v-input v-model="user.city" maxlength="50" :label="$t('city')" />
              </div>
              <div class="ml-1 grid grid-cols-2">
                <div class="mr-1">
                  <v-select v-model="user.state_id" :placeholder="$t('selectOption')" :options="states" variant="default" :label="$t('state')"></v-select>
                </div>
                <div class="mr-1">
                  <v-input variant="default" v-model="user.postal_code" maxlength="12" :label="$t('postalCode')" />
                </div>
              </div>
            </div>
          </div>
          <div class="my-4 pt-6">
            <div class="grid grid-cols-2">
              <div class="mr-1">
                <v-input v-model="user.phone_number" maxlength="12" :label="$t('phone')" />
              </div>
              <div class="ml-1">
                <v-input v-model="user.cell_phone_number" maxlength="12" :label="$t('cellPhoneNumber')" />
              </div>
            </div>
          </div>
          <div class="my-4 pt-6">
            <div class="grid grid-row-2 sm:grid-cols-2">
              <div class="mr-1">
                <v-input variant="default" v-model="user.password" type="password" id="password" :label="$t('password')" />
              </div>
              <div class="ml-1">
                <v-input variant="default" v-model="user.password_confirmation" type="password" id="password-confirmation" :label="$t('passwordConfirmation')" />
              </div>
            </div>
          </div>
        </div>
        <!-- ******************************************** -->
        <div class="w-full">
          <v-button @click="register()" variant="primary" class="w-full">
            {{ $t('register') }}
          </v-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onBeforeMount, ref } from 'vue';
import { VButton, VInput, VSelect, VDatePicker } from 'laravue-ui-components/src/components';
import { useI18n } from 'vue-i18n';

const { t } = useI18n({});
const countries = ref([]);
const errors = ref([]);
const states = ref([]);
const user = ref({
  email: '',
  password: '',
  password_confirmation: '',
  preferred_locale: 'fr',
});
const disabled = ref(false);

onBeforeMount(function () {
  fetchCountries();
  fetchStates();
});

const getError = function (fieldName) {
  let error = errors[fieldName] || undefined;
  if (error) {
    return error[0];
  }

  return '';
};

const fetchCountries = function () {
  axios.get('countries').then((response) => {
    countries.value = response.data.data;
  });
};

const fetchStates = function () {
  axios.get('states').then((response) => {
    states.value = response.data.data;
  });
};

const register = function () {
  axios
    .post('register', user.value)
    .then((response) => {
      $router.push('/login');
    })
    .catch((error) => {
      errors.value = error.response.data.errors;

      // $root.$refs.$notification.show({
      //   title: $i18n.t('saving'),
      //   text: $i18n.t('errorOccur'),
      //   variant: 'danger',
      // });
    });
};
</script>

<style lang="css" scoped>
.bgLogin {
  background-image: url('/images/jumpbox.jpg');
  background-repeat: none;
  background-size: cover;
}
</style>
