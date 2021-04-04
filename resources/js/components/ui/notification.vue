<template>
    <div class="border-l-4 shadow-lg rounded-lg bg-white m-8 p-4 notification-box fixed top-0 right-0"
        :class="[ {'hidden': !isVisible}, wrapper]">
        <div class="text-sm pb-2">
          {{title}}
          <span class="float-right">
            <svg @click="hide()"
              class="fill-current "
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="22"
              height="22"
            >
              <path
                class="heroicon-ui"
                d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"
              />
            </svg>
          </span>
        </div>
        <div class="text-sm   tracking-tight ">
          {{text}}
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            wrapper() {
                return this.wrapperCss[this.variant];
            }
        },
        data() {
            return {
                isVisible: false,
                title: 'default',
                text: 'texte',
                variant: 'normal',
                wrapperCss: {
                    'danger': 'bg-red-100 text-red-700 border-red-500',
                    'success': 'bg-green-50 border-green-500 text-green-700',
                    'warning': 'bg-yellow-50 border-yellow-500 text-yellow-700',
                }
            }
        },
        methods: {
            show(options={}) {
                this.title = options.title;
                this.text = options.text;
                this.variant = options.variant || 'normal';

                this.isVisible = true;
                setTimeout(() => {this.hide()}, 3000)
            },
            hide() {
                this.isVisible = false;
            }
        }
    }
</script>

<style lang="css" scoped>
    .notification-box {
        width: 20rem;
        animation: popX 0.5s;
        animation-direction: normal;
    }

    @keyframes popX {
        0% {
            transform: translateX(200px);
        }
        100% {
            transform: translateX(0px);
        }
    }
</style>