<template>
    <div>
        <div v-for="attribute in role" :key="role[attribute]">
            <input type="text" v-model="role[attribute]"> 
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
            role: {}
        }
    },
    methods: {
        fetch() {
            axios.get('roles/' + this.$router.currentRoute.params.id).then(response => {
                this.monmodel = response.data.data;
            });
        }
    },
}
</script>

<style lang="scss" scoped>

</style>