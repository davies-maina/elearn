<template>
    <div class="container">
        <div id="loginModal" class="modal fade">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Sign In</h4>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-hidden="true"
                        >
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-if="errors">
                            <div
                                class="alert alert-warning"
                                role="alert"
                                v-for="(error, index) in errors"
                                :key="index"
                            >
                                {{ errors }}
                            </div>
                        </div>
                        <form @submit.prevent="logIn">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"
                                        ><i class="fa fa-envelope"></i
                                    ></span>
                                    <input
                                        type="email"
                                        class="form-control"
                                        v-model="email"
                                        placeholder="Email"
                                        required="required"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"
                                        ><i class="fa fa-lock"></i
                                    ></span>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="password"
                                        placeholder="Password"
                                        required="required"
                                    />
                                </div>
                            </div>

                            <div class="checkbox">
                                <label
                                    ><input
                                        type="checkbox"
                                        v-model="remember"
                                    />
                                    Remember me</label
                                >
                            </div>
                            <div class="form-group">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-block btn-lg"
                                    :disabled="!formValid"
                                >
                                    Sign In
                                </button>
                            </div>
                            <p class="hint-text">
                                <a href="#">Forgot Password?</a>
                            </p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        Don't have an account? <a href="#">Create one</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "LoginModal",
    data() {
        return {
            email: "",
            password: "",
            remember: "",
            loading: false,
            errors: []
        };
    },

    methods: {
        ValidateEmail() {
            if (
                /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)
            ) {
                return true;
            } else {
                return false;
            }
        },
        logIn() {
            this.errors = [];
            this.loading = true;
            axios
                .post("/login", {
                    email: this.email,
                    password: this.password,
                    remember: this.remember
                })
                .then(res => {
                    location.reload();
                })

                .catch(error => {
                    this.loading = false;
                    if (error.response.status == 422) {
                        this.errors.push(
                            "We could not verify your credentials"
                        );
                    } else {
                        this.errors.push(
                            "We could not log you in,refresh and try again"
                        );
                    }
                });
        }
    },

    computed: {
        formValid() {
            return this.ValidateEmail() && this.password && !this.loading;
        }
    }
};
</script>

<style scoped>
.modal-login {
    width: 350px;
}
.modal-login .modal-content {
    padding: 20px;
    border-radius: 5px;
    border: none;
}
.modal-login .modal-header {
    border-bottom: none;
    position: relative;
    justify-content: center;
}
.modal-login .close {
    position: absolute;
    top: -10px;
    right: -10px;
}
.modal-login h4 {
    color: #636363;
    text-align: center;
    font-size: 26px;
    margin-top: 0;
}
.modal-login .modal-content {
    color: #999;
    border-radius: 1px;
    margin-bottom: 15px;
    background: #fff;
    border: 1px solid #f3f3f3;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 25px;
}
.modal-login .form-group {
    margin-bottom: 20px;
}
.modal-login label {
    font-weight: normal;
    font-size: 13px;
}
.modal-login .form-control {
    min-height: 38px;
    padding-left: 5px;
    box-shadow: none !important;
    border-width: 0 0 1px 0;
    border-radius: 0;
}
.modal-login .form-control:focus {
    border-color: #ccc;
}
.modal-login .input-group-addon {
    max-width: 42px;
    text-align: center;
    background: none;
    border-width: 0 0 1px 0;
    padding-left: 5px;
    border-radius: 0;
}
.modal-login .btn {
    font-size: 16px;
    font-weight: bold;
    background: #19aa8d;
    border-radius: 3px;
    border: none;
    min-width: 140px;
    outline: none !important;
}
.modal-login .btn:hover,
.modal-login .btn:focus {
    background: #179b81;
}
.modal-login .hint-text {
    text-align: center;
    padding-top: 5px;
    font-size: 13px;
}
.modal-login .modal-footer {
    color: #999;
    border-color: #dee4e7;
    text-align: center;
    margin: 0 -25px -25px;
    font-size: 13px;
    justify-content: center;
}
.modal-login a {
    color: #fff;
    text-decoration: underline;
}
.modal-login a:hover {
    text-decoration: none;
}
.modal-login a {
    color: #19aa8d;
    text-decoration: none;
}
.modal-login a:hover {
    text-decoration: underline;
}
.modal-login .fa {
    font-size: 21px;
}
.trigger-btn {
    display: inline-block;
    margin: 100px auto;
}
</style>
