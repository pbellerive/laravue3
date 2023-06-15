<template>
  <div class="bgLogin bg-cover bg-no-repeat">
    <div class="p-3">
      <div class="flex w-full justify-end text-white">
        <div class="mr-1">
          <v-button to="/register" class="uppercase hover:text-green-500">
            {{ $t('register') }}
          </v-button>
        </div>
      </div>
    </div>
    <div class="container max-w-sm mx-auto grid grid-rows-3 justify-items-center">
      <h1 class="uppercase font-bold text-xl my-5 text-white">
        {{ $t('resetPassword') }}
      </h1>
      <div class="mb-2 w-full">
        <input type="hidden" name="token" v-model="credentials.token" />
        <v-input @keypress.enter="reset()" v-model="credentials.email" type="text" :placeholder="$t('email')" class="w-full" />
      </div>
      <div class="w-full">
        <v-input @keypress.enter="reset()" v-model="credentials.password" type="password" :placeholder="$t('newPassword')" class="w-full" />
      </div>
      <div class="w-full">
        <v-input @keypress.enter="reset()" v-model="credentials.password_confirmation" type="password" :placeholder="$t('passwordConfirmation')" class="w-full" />
      </div>
      <div class="w-full mt-8">
        <v-button @click="reset()" variant="primary" class="w-full">
          {{ $t('resetPassword') }}
        </v-button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { VButton, VInput, VSelect } from 'laravue-ui-components/src/components';
import { useI18n } from 'vue-i18n';
import { useRouter } from 'vue-router';

const router = useRouter();

const credentials = ref({
  email: '',
  password: '',
  password_confirmation: '',
  token: '',
});

const reset = function () {
  axios
    .post('reset-password', credentials)
    .then((response) => {
      router.push('/login');
    })
    .catch((error) => {
      // this.$root.$refs.$notification.show({
      //     'title': this.$i18n.t('saving'),
      //     'text': this.$i18n.t('errorOccur'),
      //     'variant': 'danger'
      // });
    });
};

onMounted(() => {
  credentials.value.token = router.currentRoute.query.token;
  credentials.value.email = router.currentRoute.query.email;
});
</script>
