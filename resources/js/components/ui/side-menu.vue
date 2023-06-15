<template>
  <div v-if="store.isAuthenticated" :class="{ 'w-1/5 px-2': showLabel, 'w-16 px-1': !showLabel }" class="bg-slate-700 text-gray-500 pt-3">
    <section class="flex items-center">
      <div v-if="showLabel" class="flex flex-1 px-1">
        <img src="/images/site-icon.jpg" class="hidden sm:inline w-10 sm:w-10" />
      </div>
      <div class="flex flex-1 cursor-pointer" :class="{ 'justify-end ': showLabel, 'justify-center': !showLabel }">
        <font-awesome-icon icon="fa-bars" @click="toggleShowLabel()" />
      </div>
    </section>
    <section class="mt-10">
      <h1 v-if="showLabel" class="text-gray-500 mb-5">
        {{ $t('general') }}
      </h1>
      <ul class="flex flex-col divide-y divide-gray-500">
        <li class="py-2 md:py-3" :class="{ 'text-white': textColor('ProjectList'), 'text-center': !showLabel }">
          <router-link to="/projects">
            <font-awesome-icon class="mr-1" icon="fa-solid fa-layer-group" /><span v-if="showLabel">{{ $t('B') }}</span>
          </router-link>
        </li>
        <li class="text-gray-500 py-2 md:py-3" :class="{ 'text-white': textColor('reports'), 'text-center': !showLabel }">
          <font-awesome-icon class="mr-1" icon="fa-solid fa-chart-simple" /><span v-if="showLabel">{{ $t('C') }}</span>
        </li>

        <li class="text-gray-500 py-2 md:py-3" :class="{ 'text-white': textColor('users'), 'text-center': !showLabel }">
          <router-link to="/users">
            <font-awesome-icon :icon="['fas', 'people-group']" /> <span v-if="showLabel">{{ $t('A') }}</span>
          </router-link>
        </li>
        <li class="text-gray-500 py-2 md:py-3" :class="{ 'text-white': textColor('preferences'), 'text-center': !showLabel }">
          <font-awesome-icon class="mr-1" icon="fa-solid fa-gear" /><span v-if="showLabel">{{ $t('settings') }}</span>
        </li>
      </ul>
    </section>
  </div>
</template>

<script setup>
import { useSessionStore } from '../../store/modules/session';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

let store = useSessionStore();
let router = useRouter();
const showLabel = ref(false);

const textColor = function ($name) {
  return router.currentRoute.value.name == $name;
};

const toggleShowLabel = function () {
  showLabel.value = !showLabel.value;
};
</script>

<style lang="scss" scoped></style>
