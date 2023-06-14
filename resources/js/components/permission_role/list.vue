<template>
    <div>
        <div v-for="obj in permission_role" :key="obj.id">
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
            permission_role: []
        }
    }
}
</script>

<style lang="scss" scoped>

</style>