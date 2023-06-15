<template>
    <div>
        <div v-for="obj in role_user" :key="obj.id">
            {{obj.id}}
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
            role_user: []
        }
    }
}
</script>

<style lang="scss" scoped>

</style>