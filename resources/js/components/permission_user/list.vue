<template>
    <div>
        <div v-for="obj in permission_user" :key="obj.id">
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
            permission_user: []
        }
    }
}
</script>

<style lang="scss" scoped>

</style>