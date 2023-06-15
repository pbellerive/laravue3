<template>
    <div>
        <div v-for="attribute in role_user" :key="role_user[attribute]">
            <input type="text" v-model="role_user[attribute]"> 
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
            role_user: {}
        }
    },
    methods: {
        fetch() {
            axios.get('role_users/' + this.$router.currentRoute.params.id).then(response => {
                this.monmodel = response.data.data;
            });
        }
    },
}
</script>

<style lang="scss" scoped>

</style>