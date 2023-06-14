<template>
    <div>
        <div v-for="attribute in permission_role" :key="permission_role[attribute]">
            <input type="text" v-model="permission_role[attribute]"> 
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
            permission_role: {}
        }
    },
    methods: {
        fetch() {
            axios.get('permission_roles/' + this.$router.currentRoute.params.id).then(response => {
                this.monmodel = response.data.data;
            });
        }
    },
}
</script>

<style lang="scss" scoped>

</style>