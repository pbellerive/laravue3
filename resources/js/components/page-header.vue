<template>
  <!-- This example requires Tailwind CSS v2.0+ -->
  <div class="relative bg-black text-white">
    <div class="mx-auto">
      <div class="flex justify-between items-center border-b-2 border-gray-100 py-2 lg:justify-start lg:space-x-10">
        <div class="flex justify-start lg:w-0 lg:flex-1">
          <span class="sr-only">laravue</span>
          <!-- <router-link to="/">
            <img src="/images/site-icon.jpg" class="hidden sm:inline w-10 sm:w-10" />
            <img src="/images/site-icon.jpg" class="sm:hidden w-20" width="32px" />
          </router-link> -->
        </div>
        <div v-if="show" class="-mr-2 -my-2 lg:hidden">
          <button @click="openMenu()" type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            <span class="sr-only">Open menu</span>
            <!-- Heroicon name: outline/menu -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
        <nav v-if="show" class="hidden lg:flex space-x-10 text-xl lg:text-2xl font-medium">
          <router-link to="/users" class="text-gray-300 hover:text-white">
            {{ $t('users') }}
          </router-link>
          <router-link to="/item2" class="text-gray-300 hover:text-white">
            {{ $tc('item 2', 2) }}
          </router-link>
          <router-link to="/item3" class="text-gray-300 hover:text-white">
            {{ $tc('item3', 2) }}
          </router-link>
        </nav>
        <div v-if="show" class="hidden lg:flex lg:flex-1 justify-end gap-3">
          <v-button to="/profile" variant="link">
            <i class="fas fa-user-circle text-gray-300 hover:text-white"></i>
          </v-button>
          <v-button @click="logout()" variant="link">
            <i class="fas fa-sign-out-alt text-gray-300 hover:text-white"></i>
          </v-button>
        </div>
      </div>
    </div>

    <!--
    Mobile menu, show/hide based on mobile menu state.

    Entering: "duration-200 ease-out"
      From: "opacity-0 scale-95"
      To: "opacity-100 scale-100"
    Leaving: "duration-100 ease-in"
      From: "opacity-100 scale-100"
      To: "opacity-0 scale-95"
  -->
    <div v-if="show" :class="{ hidden: !showMobileMenu }" class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden z-50">
      <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
        <div class="pt-5 pb-6 px-5">
          <div class="flex items-center justify-between">
            <router-link to="/">
              <img src="/images/site-icon.jpg" class="hidden sm:inline w-48 sm:w-60" />
              <img src="/images/site-icon.jpg" class="sm:hidden w-20" />
            </router-link>
            <div class="-mr-2">
              <button
                @click="closeMenu()"
                type="button"
                class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
              >
                <span class="sr-only">Close menu</span>
                <!-- Heroicon name: outline/x -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>
          <div class="mt-6">
            <nav class="grid gap-y-8">
              <v-button to="/a" @click.native="closeMenu()" class="text-base font-medium text-gray-500 hover:text-gray-900">
                {{ $tc('a', 2) }}
              </v-button>
              <v-button to="/b" @click.native="closeMenu()" class="text-base font-medium text-gray-500 hover:text-gray-900">
                {{ $tc('b', 2) }}
              </v-button>
              <v-button to="/c" @click.native="closeMenu()" class="text-base font-medium text-gray-500 hover:text-gray-900">
                {{ $tc('c', 2) }}
              </v-button>
            </nav>
          </div>
        </div>
        <div class="py-6 px-5 space-y-6">
          <div class="grid grid-cols-2 gap-y-4 gap-x-8"></div>
          <div>
            <v-button to="/register" variant="link">
              {{ $t('register') }}
            </v-button>
            <p class="mt-6 text-center text-base font-medium text-gray-500">
              <v-button to="/login" @click.native="closeMenu()" variant="primary">
                {{ $t('login') }}
              </v-button>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Login from './authentification/login';
import { computed, ref } from 'vue';
import { useSessionStore } from '../store/modules/session';
import { useRouter } from 'vue-router';
import { VButton } from 'laravue-ui-components/src/components';

const router = useRouter();
const session = useSessionStore();
const showMobileMenu = ref(false);

const show = computed(() => {
  return session.isAuthenticated && router.currentRoute.value.name != 'register' && router.currentRoute.value.name != 'login';
});

const openMenu = function () {
  showMobileMenu.value = true;
};

const closeMenu = function () {
  showMobileMenu.value = false;
};

const logout = function () {
  axios
    .post('logout')
    .then((response) => {
      session.logout();
    })
    .finally(() => {
      router.push('/login');
    });
};
</script>
