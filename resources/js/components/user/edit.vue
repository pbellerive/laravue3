<template>
  <div class="container max-w-7xl items-center mx-auto">
    <header>
      <h1 class="block text-center my-4 text-5xl">{{ $t('manageProfile', { name: user.fullName }) }}</h1>
      <div class="grid grid-cols-none">
        <div class="inline-grid justify-items-end">
          <v-button @click="save()" variant="primary" class=""> <i class="fas fa-save pr-1"></i>{{ $t('save') }} </v-button>
        </div>
      </div>
    </header>

    <div class="grid grid-cols-none grid-flow-row divide-y-2 divide-slate-700">
      <div class="grid grid-cols-2 my-4">
        <div class="mr-1">
          <label for="firstName" class="block mb-2">{{ $t('firstName') }}</label>
          <v-input v-model="user.first_name" id="firstName" placeholder="John" maxlength="255" />
        </div>
        <div class="ml-1">
          <label for="lastName" class="block mb-2">{{ $t('lastName') }}</label>
          <v-input v-model="user.last_name" id="lastName" placeholder="Doe" maxlength="255" />
        </div>
      </div>
      <div class="my-4 pt-6">
        <div class="grid grid-cols-2">
          <div class="my-6 mr-1">
            <label for="email" class="block mb-2">{{ $t('email') }}</label>
            <v-input v-model="user.email" id="email" placeholder="john.doe@email.com" />
          </div>
          <!-- <div class="my-6 ml-1">
            <v-date-picker v-model="user.birth_date" :label="$t('birthDate')"> </v-date-picker>
          </div> -->
        </div>
      </div>
      <section>
        <div>
          <h1 class="uppercase font-bold">{{ $t('roles') }}</h1>
        </div>
        <div>
          <div v-for="role in user.roles" :key="role.id">
            {{ role.name }}
          </div>
        </div>
      </section>
      <section>
        <div>
          <h1 class="uppercase font-bold">{{ $t('permissions') }}</h1>
        </div>
        <div class="flex gap-2">
          <div v-for="permission in permissions" :key="permission.id" class="flex gap-1 place-items-center">
            <v-checkbox v-model="user.permissions" :trueValue="permission.id" falseValue="null" /> <label>{{ permission.name }}</label>
          </div>
        </div>
      </section>
      <!-- <div class="my-4 pt-6">
        <div class="grid grid-cols-2">
          <div class="mr-1">
            <v-select v-model="user.country_id" :placeholder="$t('selectOption')" :options="countries" variant="default" :label="$t('country')"></v-select>
          </div>
          <div class="mr-1">
            <v-input v-model="user.address" maxlength="255" :label="$t('address')" />
          </div>
          <div class="ml-1">
            <v-input v-model="user.city" maxlength="50" :label="$t('city')" />
          </div>
          <div class="ml-1 grid grid-cols-2">
            <div class="mr-1">
              <v-select v-model="user.state_id" :placeholder="$t('selectOption')" :options="states" variant="default" :label="$t('state')"></v-select>
            </div>
            <div class="mr-1">
              <v-input v-model="user.postal_code" maxlength="12" :label="$t('postalCode')" />
            </div>
          </div>
        </div>
      </div> -->
      <!-- <div class="my-4 pt-6">
        <div class="grid grid-cols-2">
          <div class="mr-1">
            <v-input v-model="user.phone_number" maxlength="12" :label="$t('phone')" />
          </div>
          <div class="ml-1">
            <v-input v-model="user.cell_phone_number" maxlength="12" :label="$t('cellPhoneNumber')" />
          </div>
        </div>
      </div> -->
      <div class="my-4 pt-6">
        <div class="grid grid-cols-2">
          <div class="mr-1">
            <v-input v-model="user.password" type="password" id="password" :label="$t('password')" />
          </div>
          <div class="ml-1">
            <v-input v-model="user.password_confirmation" type="password" id="password-confirmation" :label="$t('passwordConfirmation')" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { VButton, VCheckbox, VInput, VSelect, VDatePicker } from 'laravue-ui-components/src/components';
import { fetchCurrentUser } from '../composites/user';
import { useSessionStore } from '../../store/modules/session';
import { onMounted, onBeforeMount, ref, defineProps } from 'vue';
import { inject } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRouter } from 'vue-router';

const { t } = useI18n({});
const emitter = inject('emitter');
const router = useRouter();

const props = defineProps({
  id: {
    type: [String, Number],
    default: undefined,
  },
});

const user = ref({});
const permissions = ref([]);

const fetchUser = function () {
  axios
    .get('users/' + props.id)
    .then((response) => {
      user.value = response.data.data;
    })
    .catch((error) => {
      emitter.emit('show-notification', {
        title: '',
        text: t('errorOccur'),
        variant: 'danger',
      });
    });
};

const fetchPermissions = function () {
  axios
    .get('permissions')
    .then((response) => {
      permissions.value = response.data.data;
    })
    .catch((error) => {
      emitter.emit('show-notification', {
        title: '',
        text: t('errorOccur'),
        variant: 'danger',
      });
    });
};

onBeforeMount(() => {
  // fetchCountries();
  // fetchStates();
  fetchPermissions();
});

onMounted(() => {
  if (props.id) {
    fetchUser();
  }
});

const save = function () {
  axios
    .patch('users/' + props.id, user.value)
    .then((response) => {
      emitter.emit('show-notification', {
        title: t('saving'),
        text: t('successfulSaving'),
        variant: 'success',
      });
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
