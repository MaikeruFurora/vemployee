<template>
    <div>
        <router-view/>
        <vue-progress-bar/>
    </div>
</template>
<script>
    export default{
        watch: {
            '$route' (to, from) {
                const toDepth = to.path.split('/').length
                const fromDepth = from.path.split('/').length
                this.transitionName = toDepth < fromDepth ? 'slide-right' : 'slide-right'
            }
        }

    }
</script>

