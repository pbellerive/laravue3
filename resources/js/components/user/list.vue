<template>
  <div class="mx-auto w-full px-5 mt-5">
    <div class="border border-white">
      <div class="grid grid-cols-3 border-b border-b-white text-center">
        <div>{{ $t('firstName') }}</div>
        <div>{{ $t('lastName') }}</div>
        <div>{{ $t('action') }}</div>
      </div>
      <div v-for="user in users" :key="user.id" class="grid grid-cols-3 divide-x-2 hover:bg-gray-200 hover:text-black hover:cursor-pointer">
        <div class="px-3">{{ user.first_name }}</div>
        <div class="px-3">{{ user.last_name }}</div>
        <div class="px-3">-</div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { inject, onBeforeMount, ref } from 'vue';
const emitter = inject('emitter');

const users = ref([]);

const fetchUsers = () => {
  axios
    .get('users')
    .then((response) => {
      users.value = response.data.data;
    })
    .catch((error) => {
      emitter.emit('show-notification', { variant: 'danger', title: 'error' });
    });
};

onBeforeMount(() => {
  fetchUsers();
});
</script>

<style lang="scss" scoped></style>
