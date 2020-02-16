<template>
    <div>
        <button class="btn btn-success" @click.prevent="subscribe('monthly')">
            Subscribe to our $9 monthly plan
        </button>
        <button class="btn btn-info" @click.prevent="subscribe('yearly')">
            Subscribe to our $99 yearly plan
        </button>
    </div>
</template>

<script>
export default {
    props: ["email"],
    mounted() {
        this.handler = StripeCheckout.configure({
            key: "pk_test_tThl7BZZa9q0YT4MpuWIT9UF00bTZMYw4z",
            image:
                "https://stripe.com/img/documentation/checkout/marketplace.png",
            locale: "auto",
            token(token) {
                axios
                    .post("/subscribe", {
                        stripeToken: token.id,
                        plan: window.plan
                    })
                    .then(res => {
                        console.log(res);
                    });
            }
        });
    },
    data() {
        return {
            plan: "",
            amount: 0,
            handler: null
        };
    },

    methods: {
        subscribe(plan) {
            if (plan == "monthly") {
                window.plan = "Monthly";
                this.amount = 9;
            } else {
                window.plan = "Yearly";
                this.amount = 99;
            }

            this.handler.open({
                name: "elearn",
                description: "subscription",
                amount: this.amount,
                email: this.email
            });
        }
    }
};
</script>
