<template>
  <div class="container max-w-7xl items-center mx-auto">
    <header>
      <h1 class="block text-center my-4 text-2xl">{{ $t('manageProfile', { name: user.fullName }) }}</h1>
      <div class="grid grid-cols-none">
        <div class="inline-grid justify-items-end">
          <v-button @click="save()" variant="primary" class=""> <i class="fas fa-save pr-1"></i>{{ $t('save') }} </v-button>
        </div>
      </div>
    </header>

    <div class="grid grid-cols-none grid-flow-row divide-y-2 divide-slate-700">
      <div class="grid grid-cols-2 my-4">
        <div class="mr-1">
          <v-input v-model="user.first_name" id="firstName" maxlength="255" :label="$t('firstName')" />
        </div>
        <div class="ml-1">
          <v-input v-model="user.last_name" id="lastName" maxlength="255" :label="$t('lastName')" />
        </div>
      </div>
      <div class="my-4 pt-6">
        <div class="grid grid-cols-2">
          <div class="my-6 mr-1">
            <v-input v-model="user.email" id="email" :label="$t('email')" />
          </div>
        </div>
      </div>
      <section>
        <div>
          <h1 class="uppercase font-bold">{{ $t('roles') }}</h1>
        </div>
        <div class="mt-3">
          <div class="flex gap-3">
            <div>
              <v-rich-select variant="default" :options="roles" v-model="roleToAdd" valueOptionAttribute="object" textOptionAttribute="name" :label="t('roles')"></v-rich-select>
            </div>
            <div>
              <v-button variant="primary" @click="addRole">{{ t('add') }}</v-button>
            </div>
          </div>
          <div class="flex gap-3 divide-x-2 mt-2">
            <div v-for="role in user.roles" :key="role.id" class="px-2">
              <div>
                {{ role.name }}
                <v-button @click="removeRole(role)" variant="link">
                  <font-awesome-icon icon="fa-solid fa-trash" class="text-red-500 text-xs"></font-awesome-icon>
                </v-button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section v-if="showPermissions()" data-testid="section.permissions">
        <div>
          <h1 class="uppercase font-bold">{{ $t('permissions') }}</h1>
        </div>
        <div class="flex gap-2">
          <div v-for="permission in permissions" :key="permission.id" class="flex gap-1 place-items-center">
            <v-checkbox v-model="user.permissions" :trueValue="permission.id" falseValue="null" /> <label>{{ $t(permission.name) }}</label>
          </div>
        </div>
      </section>
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
    <v-modal ref="deleteModalConfirmation" :title="$t('role.remove')" :message="$t('cannotBeUndone')"> </v-modal>
  </div>
</template>

<script setup>
import { VButton, VCheckbox, VInput, VModal, VRichSelect } from 'laravue-ui-components/src/components';
import { fetchCurrentUser } from '../composites/user';
import { useSessionStore } from '../../store/modules/session';
import { onMounted, onBeforeMount, ref, defineProps } from 'vue';
import { inject } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRouter } from 'vue-router';

const { t } = useI18n({});
const emitter = inject('emitter');
const router = useRouter();
const session = useSessionStore();

const props = defineProps({
  id: {
    type: [String, Number],
    default: undefined,
  },
});

const user = ref({});
const roleToAdd = ref({});
const permissions = ref([]);
const roles = ref([]);
const deleteModalConfirmation = ref(null);

const addRole = function () {
  axios
    .post('users/' + user.value.id + '/role/' + roleToAdd.value.id)
    .then((response) => {
      user.value.roles = response.data.data;
    })
    .catch((error) => {
      emitter.emit('show-notification', {
        title: '',
        text: t('errorOccur'),
        variant: 'danger',
      });
    });
};

const showPermissions = function () {
  return user.value.id != session.currentUser.id && session.currentUser.isAdmin;
};

const fetchUser = function () {
  const id = props.id || session.currentUser.id;
  axios
    .get('users/' + id)
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

const fetchRoles = function () {
  axios
    .get('roles')
    .then((response) => {
      roles.value = response.data.data;
    })
    .catch((error) => {
      emitter.emit('show-notification', {
        title: '',
        text: t('errorOccur'),
        variant: 'danger',
      });
    });
};

const removeRole = function (role) {
  deleteModalConfirmation.value.open().then((result) => {
    if (result.isOk) {
      axios
        .delete('users/' + user.value.id + '/role/' + role.id)
        .then((response) => {
          const i = _.findIndex(user.value.roles, (obj) => {
            return obj.id == role.id;
          });
          user.value.roles.splice(i, 1);
          emitter.emit('show-notification', {
            title: '',
            text: t('successfulSaving', { name: 'role' }),
            variant: 'success',
          });
        })
        .catch((error) => {
          // let message = this.buildErrorMessage(error.response);
          // this.$showMessage(message, 'danger');
        });
    }
  });
};

onBeforeMount(() => {
  // fetchCountries();
  // fetchStates();
  fetchRoles();
  fetchPermissions();
});

onMounted(() => {
  fetchUser();
  // if (props.id) {
  // }
});

const save = function () {
  const id = props.id || session.currentUser.id;
  axios
    .patch('users/' + id, user.value)
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
