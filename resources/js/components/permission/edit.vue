<template>
    <div>
        <div v-for="attribute in permission" :key="permission[attribute]">
            <input type="text" v-model="permission[attribute]"> 
        </div>
    </div>
</template>

<script>
export default {
    setup () {


        return {}
    },
    data() {
        return {
            permission: {}
        }
    },
    methods: {
        fetch() {
            axios.get('permissions/' + this.$router.currentRoute.params.id).then(response => {
                this.monmodel = response.data.data;
            });
        }
    },
}
</script>

<style lang="scss" scoped>

</style>