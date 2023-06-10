<template>
  <div>
    <div class="flex flex-row bg-transparent">
      <div class="flex-initial pt-0 sm:pt-5">
        <router-link to="/">
          <img src="/images/site-icon.jpg" class="ml-10 md:ml-20 w-8" />
        </router-link>
      </div>
      <div class="flex flex-row flex-grow justify-end items-center text-white">
        <div class="flex-initial">
          <v-button to="/login" class="uppercase hover:text-green-500 text-sm md:text-lg">
            {{ $t('login') }}
          </v-button>
        </div>
        <div class="flex-initial">
          <v-button to="/register" class="uppercase hover:text-green-500 text-sm md:text-lg">
            {{ $t('register') }}
          </v-button>
        </div>
      </div>
    </div>
    <div class="container max-w-sm px-1 md:max-w-2xl mx-auto justify-items-center">
      <h1 class="uppercase font-bold text-5xl pt-5 text-white text-center">
        {{ $t('forgotPassword') }}
      </h1>
      <div>
        <v-input v-model="email" id="email" :label="$t('email')" />
      </div>
      <div>
        <v-button @click="send" variant="primary" class="w-full mt-2">
          {{ $t('sendPasswordResetLink') }}
        </v-button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { VButton, VInput } from 'laravue-ui-components/src/components';

const email = ref('');
const send = function () {
  axios
    .post('/forgot-password', { email: this.email })
    .then((response) => {
      this.$router.push('/login');
    })
    .catch((error) => {
      this.errors = error.response.data.errors;

      this.$root.$refs.$notification.show({
        title: this.$i18n.t('saving'),
        text: this.$i18n.t('errorOccur'),
        variant: 'danger',
      });
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
