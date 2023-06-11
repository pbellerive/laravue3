<template>
  <div class="bgLogin">
    <div class="grid p-3">
      <div class="flex flex-row justify-end text-black">
        <div class="flex-initial mr-1">
          <v-button to="/register" variant="link">
            {{ $t('register') }}
          </v-button>
        </div>
      </div>
    </div>
    <div class="container max-w-sm mx-auto grid grid-flow-row gap-2 justify-items-center">
      <h1 class="uppercase font-bold text-5xl my-5 text-black">
        {{ $t('login') }}
      </h1>
      <div class="mb-2 w-full">
        <v-input variant="default" @keypress.enter="login()" v-model="credentials.email" :label="$t('email')" class="w-full" dataTestId="input.email" />
      </div>
      <div class="w-full">
        <v-input variant="default" @keypress.enter="login()" v-model="credentials.password" type="password" :label="$t('password')" class="w-full" dataTestId="input.password" />
      </div>
      <div class="flex flex-col w-full">
        <div class="w-full">
          <v-button @click="login()" variant="primary" class="w-full" data-testid="button.login">
            {{ $t('login') }}
          </v-button>
        </div>
        <div class="w-full text-right">
          <v-button variant="link" to="/forgot-password">
            <span>{{ $t('forgotPassword') }} </span>
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
import { inject } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n({});
const emitter = inject('emitter');

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
      emitter.emit('show-notification', {
        title: t('saving'),
        text: t('errorOccur'),
        variant: 'danger',
      });
    });
};
</script>
