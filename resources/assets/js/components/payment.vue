<template>
    <div class="column is-half is-offset-3">
        <transition name="slide-fade" mode="out-in">
            <div v-if="current === 'payment'" key="payment">
                <div class="columns">
                    <div class="column is-half">
                        <button @click="current = 'dues'" class="button is-primary is-large is-fullwidth">Pay Dues</button>
                    </div>
                    <div class="column is-half">
                        <button @click="current = 'donate'" class="button is-primary is-large is-fullwidth">Make Donation</button>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <p class="content">
                            Dues are a necessity for the Alumni Association to perform its basic functions detailed in the annual budget.  Why select a lifetime membership?
                            <ul>
                                <li>Allows the association to dispense with collecting money for operating expenses, and to begin funding educational programs for alumni and undergraduates, such as risk management training.</li>
                                <li>Funds future events held by the association for alumni.</li>
                                <li>Receive a custom numbered Lifetime Iota Zeta Member coin and Certificate.</li>
                            </ul>
                        </p>
                        <p class="content">
                            If you would simply like to make a donation to the association, you can do so here. Please let us know the specific cause so we can be sure your money is used in the proper manner.
                        </p>
                    </div>
                </div>
            </div>
            <div v-if="current === 'dues'" key="dues">
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <h4 class="title is-4">{{ products.undergradLifetime.label }}</h4>
                        </div>
                    </div>
                    <div class="level-right">
                        <div class="level-item">
                            <button @click="pay(products.undergradLifetime)" class="button is-medium is-primary is-outlined">
                                ${{ products.undergradLifetime.amount }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <h4 class="title is-4">{{ products.lifetime.label }}</h4>
                        </div>
                    </div>
                    <div class="level-right">
                        <div class="level-item">
                            <button @click="pay(products.lifetime)" class="button is-primary is-medium is-outlined">
                                ${{ products.lifetime.amount }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <h4 class="title is-4">{{ products.annual.label }}</h4>
                        </div>
                    </div>
                    <div class="level-right">
                        <div class="level-item">
                            <button @click="pay(products.annual)" class="button is-primary is-medium is-outlined">
                                ${{ products.annual.amount }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="current === 'donate'" key="donate">
                <div class="field has-addons">
                    <p class="control is-expanded has-icon">
                        <input
                            @keyup.enter="pay(products.donation)"
                            class="input is-large"
                            type="text"
                            placeholder="10.00"
                            v-model="products.donation.amount"
                        >
                        <span class="icon">
                            <i class="fa fa-dollar"></i>
                        </span>
                    </p>
                    <p class="control">
                        <button
                            @click="pay(products.donation)"
                            class="button is-primary is-large"
                            :disabled="!donationValid"
                        >
                            Donate
                        </button>
                    </p>
                </div>
            </div>
            <div v-if="current === 'pay'" key="pay">
                <stripe @stripePaid="current = 'paid'" :cents="payment" :product-label="productLabel"></stripe>
            </div>
            <div class="notification is-success" v-if="current === 'paid'" key="paid">
                Thank you!  Your payment has been successfully submitted and you should receive a receipt by email shortly.
            </div>
        </transition>
    </div>
</template>

<script>
import stripe from './stripe'

export default {
    components: {
        stripe
    },
    computed: {
        donationValid () {
            if (
                !isNaN(parseFloat(this.products.donation.amount))
                && isFinite(this.products.donation.amount
                && this.products.donation.amount > 0)
            ) return true

            return false
        }
    },
    data () {
        return {
            current: 'payment',
            products: {
                annual: { label: 'Annual Dues', amount: 30 },
                donation: { label: 'Donation', amount: '' },
                lifetime: { label: 'Lifetime Membership', amount: 300 },
                undergradLifetime: { label: 'Undergraduate Lifetime Membership', amount: 250 }
            },
            payment: 0,
            productLabel: ''
        }
    },
    methods: {
        pay (p) {
            this.payment = p.amount * 100
            this.productLabel = p.label
            this.current = 'pay'            
        }        
    },
    name: 'Payment'
}
</script>