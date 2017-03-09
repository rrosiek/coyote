<template>
    <div :class="{ 'is-active': show }" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <h4 class="title is-4">
                    <slot name="content">Are you sure you want to complete this action?</slot>
                </h4>
                <div class="columns">
                    <div class="column">
                        <a @click="show = false" class="button is-fullwidth">Cancel</a>
                    </div>
                    <div class="column">
                        <slot name="confirmAction">
                            <button class="button is-primary is-fullwidth">OK</button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
        <a @click="show = false" class="modal-close"></a>
    </div>
</template>

<script>
export default {
    data () {
        return {
            show: false
        }
    },
    props: ['name'],
    mounted () {
        this.$bus.$on('confirm', target => {
            if (this.name === target) this.show = true
        })
    }
}
</script>
