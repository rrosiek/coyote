<template>
    <div>
        <h3 class="title is-3">{{ productLabel }}: ${{ cents / 100 }}</h3>
        <div class="notification is-danger" v-if="inError">{{ errorText }} {{ cardErrorText }}</div>
        <form @submit.prevent="commitPayment">
            <div class="field">
                <p class="control">
                    <input class="input is-medium is-underlined" placeholder="Name" type="text" v-model="name">
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <input class="input is-medium is-underlined" placeholder="E-Mail" type="email" v-model="email">
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <input class="input is-medium is-underlined" placeholder="Zip Code" type="text" v-model="zip">
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <div style="border-bottom: 1px solid #b5b5b5" id="cardElement"></div>
                </p>
            </div>
            <br>
            <div class="field">
                <p class="control">
                    <button
                        :class="{ 'is-loading': loading }"
                        class="button is-medium is-primary is-fullwidth"
                        :disabled="loading"
                        type="submit"
                    >
                        Pay ${{ cents / 100 }}
                    </button>
                </p>
            </div>
        </form>
    </div>
</template>

<script>
const emailValidate = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

export default {
    data () {
        return {
            card: null,
            cardErrorText: '',
            cardValid: false,
            email: '',
            errorText: 'Please fill or correct all fields below.',
            inError: false,
            loading: false,
            name: '',
            stripe: null,
            zip: '',
        }
    },
    methods: {
        commitPayment () {
            this.inError = false

            if (
                !emailValidate.test(this.email) &&
                !this.name &&
                !this.zip &&
                !this.cardValid
            ) {
                this.inError = true

                return
            }

            this.loading = true

            this.stripe.createToken(this.card, {
                name: this.name,
                address_zip: this.zip,
                currency: 'usd'
            }).then(result => {
                if (result.token) {
                    this.$http.post('/payments', {
                        brand: result.token.card.brand,
                        email: this.email,
                        lastFour: result.token.card.last4,
                        name: this.name,
                        product: this.productLabel,
                        token: result.token.id,
                        payment: this.cents,
                        zip: this.zip
                    })
                    .then(resp => {
                        this.$emit('stripePaid')
                        this.loading = false
                    })
                    .catch(error => {
                        this.inError = true
                        this.loading = false
                    })
                } else if (result.error) {
                    this.inError = true
                    this.cardErrorText = result.error.message
                }
            });
        }
    },
    mounted () {
        this.stripe = Stripe(window.Laravel.stripeKey)
        let elements = this.stripe.elements()
        this.card = elements.create('card', {
            hidePostalCode: true,
            style: {
                base: {
                    iconColor: '#00355f',
                    color: '#32315e',
                    lineHeight: '38px',
                    fontWeight: 400,
                    fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif',
                    fontSize: '20px',
                    '::placeholder': {
                        color: '#cfd7df',
                    }
                }
            }
        })

        this.card.mount('#cardElement')
        this.card.on('change', event => this.cardValid = event.complete)
    },
    name: 'Stripe',
    props: {
        cents: {
            type: Number,
            default: 0
        },
        productLabel: {
            type: String,
            default: ''
        }
    }
}
</script>