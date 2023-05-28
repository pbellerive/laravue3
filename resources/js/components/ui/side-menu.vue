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
    <!-- <section class="mt-10">
            <div v-if="store.currentProject">
                <h1 class="text-gray-500 pl-2 md:pl-5 mb-5">
                    {{$t('project')}}
                </h1>
                <ul class="flex flex-col pl-2 md:pl-5 divide-y divide-gray-500">
                    <li class="text-white p-2 md:p-3 cursor-pointer">
                        <font-awesome-icon class="mr-3" icon="fa-solid fa-layer-group" />{{$t('dashboard')}}
                    </li>
                    <li class="text-gray-500 p-2 md:p-3 cursor-pointer" @click="store.currentTabName='backlog'" >
                        <font-awesome-icon class="mr-3" icon="fa-solid fa-box" /> {{$t('backlog')}}
                    </li>
                    <li class="text-gray-500 p-2 md:p-3 cursor-pointer">
                        <font-awesome-icon class="mr-3" icon="fa-solid fa-table-columns" />{{$t('kanban')}}
                    </li>
                    <li class="text-gray-500 p-2 md:p-3 cursor-pointer">
                        <font-awesome-icon class="mr-3" icon="fa-solid fa-rectangle-list" /> {{$t('list')}}
                    </li>
                    <li class="text-gray-500 p-2 md:p-3 cursor-pointer">
                        <font-awesome-icon class="mr-3" icon="fa-solid fa-calendar-day" />{{$t('calendar')}}
                    </li>
                    <li class="text-gray-500 p-2 md:p-3 cursor-pointer">
                        <font-awesome-icon class="mr-3" icon="fa-solid fa-gear" />{{$t('projectSettings')}}
                    </li>
                </ul>
            </div>
            <div v-else class="text-center">
                {{$t('noSelectedProject')}}
            </div>
        </section> -->
    <section class="mt-10">
      <h1 v-if="showLabel" class="text-gray-500 mb-5">
        {{ $t('general') }}
      </h1>
      <ul class="flex flex-col divide-y divide-gray-500">
        <li class="text-gray-500 py-2 md:py-3" :class="{ 'text-white': textColor('MyTasks'), 'text-center': !showLabel }">
          <router-link to="/tasks/my">
            <font-awesome-icon class="mr-1" icon="fa-solid fa-box" /> <span v-if="showLabel">{{ $t('myTasks') }}</span>
          </router-link>
        </li>
        <li class="py-2 md:py-3" :class="{ 'text-white': textColor('ProjectList'), 'text-center': !showLabel }">
          <router-link to="/projects">
            <font-awesome-icon class="mr-1" icon="fa-solid fa-layer-group" /><span v-if="showLabel">{{ $t('projectList') }}</span>
          </router-link>
        </li>
        <li class="text-gray-500 py-2 md:py-3" :class="{ 'text-white': textColor('reports'), 'text-center': !showLabel }">
          <font-awesome-icon class="mr-1" icon="fa-solid fa-chart-simple" /><span v-if="showLabel">{{ $t('reports') }}</span>
        </li>

        <li class="text-gray-500 py-2 md:py-3" :class="{ 'text-white': textColor('preferences'), 'text-center': !showLabel }">
          <font-awesome-icon class="mr-1" icon="fa-solid fa-gear" /><span v-if="showLabel">{{ $t('preferences') }}</span>
        </li>
      </ul>
    </section>
    <section v-if="store.currentOrganisation" class="mt-10">
      <h1 v-if="showLabel" class="text-gray-500 mb-5">
        {{ $t('organisation') }}
      </h1>
      <ul class="flex flex-col divide-y divide-gray-500">
        <li class="text-gray-500 py-2 md:py-3" :class="{ 'text-white': textColor('organisation'), 'text-center': !showLabel }">
          <font-awesome-icon class="mr-1" icon="fa-solid fa-building" /><span v-if="showLabel">{{ $t('organisation') }}</span>
        </li>
        <li class="text-gray-500 py-2 md:py-3" :class="{ 'text-white': textColor('members'), 'text-center': !showLabel }">
          <font-awesome-icon class="mr-1" icon="fa-solid fa-user-group" /><span v-if="showLabel">{{ $t('members') }}</span>
        </li>
        <!-- <li class="text-gray-500 py-2 md:py-3" :class="{ 'text-white': textColor('Inbox'), 'text-center': !showLabel }">
          <font-awesome-icon class="mr-1" icon="fa-solid fa-envelope" /><span v-if="showLabel">{{ $t('inbox') }}</span>
        </li> -->

        <!-- <li class="text-gray-500 py-2 md:py-3" :class="{ 'text-white': textColor('realissation'), 'text-center': !showLabel }">
          <font-awesome-icon class="mr-1" icon="fa-solid fa-table-columns" /><span v-if="showLabel">{{ $t('realisations') }}</span>
        </li> -->
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
