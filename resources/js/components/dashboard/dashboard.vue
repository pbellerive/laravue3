<template>
  <div class="container mx-auto flex flex-col">
    <header class="text-center text-3xl">Bonjour</header>
    <div class="flex flex-row text-gray-500 text-center">
      <div class="bg-white border rounded-md border-gray-200 w-1/4">stats</div>

      <div class="container bg-white border rounded-md border-gray-200 flex-1 mx-2 h-36 w-1/2">MAIN</div>

      <div class="bg-white border rounded-md border-gray-200 hidden sm:inline w-1/4">news</div>
    </div>
    <div>
      {{ user.first_name }}
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';

const socket = ref({});
const user = ref({
  first_name: 'empty',
});

onMounted(() => {
  socket.value = Echo.channel('newevent').listen('NewEvent', (e) => {
    user.value = e.newEvent;
    console.log(e.newEvent);
  });
});
</script>
