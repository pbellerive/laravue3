<template>
    <div>
        <div v-for="obj in role" :key="obj.id">
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
            role: []
        }
    }
}
</script>

<style lang="scss" scoped>

</style>