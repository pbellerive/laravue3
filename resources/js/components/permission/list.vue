<template>
    <div>
        <div v-for="obj in permission" :key="obj.id">
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
            permission: []
        }
    }
}
</script>

<style lang="scss" scoped>

</style>