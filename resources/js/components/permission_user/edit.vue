<template>
    <div>
        <div v-for="attribute in permission_user" :key="permission_user[attribute]">
            <input type="text" v-model="permission_user[attribute]"> 
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
            permission_user: {}
        }
    },
    methods: {
        fetch() {
            axios.get('permission_users/' + this.$router.currentRoute.params.id).then(response => {
                this.monmodel = response.data.data;
            });
        }
    },
}
</script>

<style lang="scss" scoped>

</style>