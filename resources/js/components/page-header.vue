<template>
  <!-- This example requires Tailwind CSS v2.0+ -->
  <div v-if="show" class="relative">
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
          <!-- header menu items here -->
        </nav>
        <div v-if="show" class="hidden lg:flex lg:flex-1 justify-end gap-3">
          <v-button to="/profile" variant="link" data-testid="button.profile">
            <i class="fas fa-user-circle text-gray-300 hover:text-white"></i>
          </v-button>
          <v-button @click="logout()" variant="link">
            <i class="fas fa-sign-out-alt text-gray-300 hover:text-white"></i>
          </v-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Login from './authentication/login';
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
