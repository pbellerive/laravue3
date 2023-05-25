<template>
  <div class="bgLogin">
    <div class="grid p-3">
      <div class="flex flex-row justify-end text-white">
        <div class="flex-initial mr-1">
          <v-button to="/register" class="uppercase hover:text-green-500">
            {{ $t('register') }}
          </v-button>
        </div>
      </div>
    </div>
    <div class="container max-w-sm mx-auto grid grid-flow-row gap-2 justify-items-center">
      <h1 class="uppercase font-bold text-5xl my-5 text-white">
        {{ $t('login') }}
      </h1>
      <div class="mb-2 w-full">
        <v-input @keypress.enter="login()" v-model="credentials.email" type="text" :placeholder="$t('email')" class="w-full" />
      </div>
      <div class="w-full">
        <v-input @keypress.enter="login()" v-model="credentials.password" type="password" :placeholder="$t('password')" class="w-full" />
      </div>
      <div class="flex w-full">
        <div class="w-full text-left">
          <v-button variant="link" to="/forgot-password">
            <span>{{ $t('forgotPassword') }} </span>
          </v-button>
        </div>
        <div>
          <v-button @click="login()" variant="primary" class="w-full">
            {{ $t('login') }}
          </v-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useSessionStore } from '../../store/modules/session';
import { useRouter } from 'vue-router';
import { VButton, VInput } from 'laravue-ui-components/src/components';

const session = useSessionStore();
const router = useRouter();

const credentials = ref({
  email: '',
  password: '',
});

const login = () => {
  authenticate();
};

const authenticate = () => {
  axios
    .post('login', credentials.value)
    .then((response) => {
      session.setUser(response.data.user);
      session.setToken(response.data.token);
      router.push('/');
    })
    .catch((error) => {
      // this.$root.$refs.$notification.show({
      //   title: this.$i18n.t('saving'),
      //   text: this.$i18n.t('errorOccur'),
      //   variant: 'danger',
      // });
    });
};
</script>
