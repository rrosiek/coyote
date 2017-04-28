<template>
    <div :class="{ 'is-active': show }" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content" v-if="show">
            <div class="box" v-if="show">
                <article class="media">
                    <div class="media-left">
                        <figure class="image is-128x128">
                            <img :src="profile.avatar_url + '?s=128'" alt="Avatar">
                        </figure>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <h4 class="title is-4">{{ profile.name }}</h4>
                            <p>
                                <strong>E-Mail:</strong> {{ profile.email }}
                                <br><strong>Address:</strong> {{ profile.full_address }}
                                <br><strong>Phone:</strong> {{ profile.phone }}
                                <br><strong>Graduation Year:</strong> {{ profile.grad_year }}
                                <br><strong>Employer:</strong> {{ profile.employer }}
                                <br><strong>Roll Book No:</strong> {{ profile.roll_number }}
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <button @click="close" class="modal-close">Close</button>
    </div>
</template>

<script>
export default {
    created () {
        this.$bus.$on('showProfileDetails', id => {
            this.$http.get('/members/profiles/' + id).then(resp => {
                this.profile = resp.data
                this.show = true
            })
        })
    },
    data () {
        return {
            profile: {},
            show: false
        }
    },
    methods: {
        close () {
            this.show = false
            this.profile = {}
        }
    }
}
</script>
