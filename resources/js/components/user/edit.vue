<template>
  <div class="container max-w-7xl items-center mx-auto">
    <header>
      <h1 class="block text-center my-4 text-5xl">{{ $t('manageProfile', { name: user.fullName }) }}</h1>
      <div class="grid grid-cols-none">
        <div class="inline-grid justify-items-end">
          <t-button @click="save()" variant="primary" class=""> <i class="fas fa-save pr-1"></i>{{ $t('save') }} </t-button>
        </div>
      </div>
    </header>

    <div class="grid grid-cols-none grid-flow-row divide-y-2 divide-green-500">
      <div class="grid grid-cols-2 my-4">
        <div class=" mr-1">
          <label for="firstName" class="block mb-2">{{ $t('firstName') }}</label>
          <t-input v-model="user.first_name" id="firstName" placeholder="John" maxlength="255" />
        </div>
        <div class="ml-1">
          <label for="lastName" class="block mb-2">{{ $t('lastName') }}</label>
          <t-input v-model="user.last_name" id="lastName" placeholder="Doe" maxlength="255" />
        </div>
      </div>
      <div class="my-4 pt-6">
        <div class="grid grid-cols-2">
          <div class="my-6 mr-1">
            <label for="email" class="block mb-2">{{ $t('email') }}</label>
            <t-input v-model="user.email" id="email" placeholder="john.doe@email.com" />
          </div>
          <div class="my-6 ml-1">
            <t-input-group :label="$t('birthDate')">
              <t-datepicker v-model="user.birth_date"> </t-datepicker>
            </t-input-group>
          </div>
        </div>
      </div>
      <div class="my-4 pt-6">
        <div class="grid grid-cols-2">
          <div class="mr-1">
            <t-input-group :label="$t('country')">
              <t-select v-model="user.country_id" :placeholder="$t('selectOption')" :options="countries" variant="default"></t-select>
            </t-input-group>
          </div>
          <div class="mr-1">
            <t-input-group :label="$t('address')">
              <t-input v-model="user.address" maxlength="255" />
            </t-input-group>
          </div>
          <div class="ml-1">
            <t-input-group :label="$t('city')">
              <t-input v-model="user.city" maxlength="50" />
            </t-input-group>
          </div>
          <div class="ml-1 grid grid-cols-2">
            <div class="mr-1">
              <t-input-group :label="$t('state')">
                <t-select v-model="user.state_id" :placeholder="$t('selectOption')" :options="states" variant="default"></t-select>
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
              <t-input v-model="user.phone_number" maxlength="12" />
            </t-input-group>
          </div>
          <div class="ml-1">
            <t-input-group :label="$t('cellPhoneNumber')">
              <t-input v-model="user.cell_phone_number" maxlength="12" />
            </t-input-group>
          </div>
        </div>
      </div>
      <div class="my-4 pt-6">
        <div class="grid grid-cols-2">
          <div class="mr-1">
            <t-input-group :label="$t('password')">
              <t-input v-model="user.password" type="password" id="password" />
            </t-input-group>
          </div>
          <div class="ml-1">
            <t-input-group :label="$t('passwordConfirmation')">
              <t-input v-model="user.password_confirmation" type="password" id="password-confirmation" />
            </t-input-group>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VInput } from 'laravue-ui-components/src/components';

export default {
  components: {
    'v-input': VInput,
  },
  created() {
    this.fetchCountries();
    this.fetchStates();
  },
  data() {
    return {
      countries: [],
      states: [],
      user: {},
    };
  },
  methods: {
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
    save() {
      axios
        .patch('users/' + this.user.id, this.user)
        .then(response => {
          this.$root.$refs.$notification.show({
            title: this.$i18n.t('saving'),
            text: this.$i18n.t('successfulSaving'),
            variant: 'success',
          });
          this.$router.push('/');
        })
        .catch(error => {
          this.$root.$refs.$notification.show({
            title: this.$i18n.t('saving'),
            text: this.$i18n.t('errorOccur'),
            variant: 'danger',
          });
        });
    },
  },
  mounted() {
    this.fetchCurrentUser().then(response => {
      this.user = response.data;
    });
  },
};
</script>

<style lang="scss" scoped></style>
