<template>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div
                            class="col-xl-4 col-md-6 d-flex flex-column mx-auto"
                        >
                            <div class="card card-plain mt-8">
                                <div
                                    class="alert blur shadow border-radius-md alert-secondary text-center me-2 d-flex align-items-center justify-content-center"
                                    role="alert"
                                    v-if="
                                        data.errors.hasOwnProperty(
                                            'login_error'
                                        )
                                    "
                                >
                                    <strong class="text-danger opacity-7">
                                        <i
                                            class="fa fa-ban opacity-10 text-danger me-1"
                                        ></i>
                                        {{ data.errors.login_error }}!
                                    </strong>
                                </div>
                                <div
                                    class="card-header pb-0 text-left bg-transparent"
                                >
                                    <h3
                                        class="font-weight-black text-dark display-6"
                                    >
                                        Welcome back
                                    </h3>
                                    <p class="mb-0">
                                        Welcome back! Please enter your details.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <label>Email Or Phone Number</label>
                                    <div class="mb-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Enter your email or Phone Number"
                                            aria-label="Email Or Phone Number"
                                            aria-describedby="name-addon"
                                            v-model="
                                                data.formData.email_phonenumber
                                            "
                                            :class="
                                                data.errors.hasOwnProperty(
                                                    'email_phonenumber'
                                                )
                                                    ? 'is-invalid'
                                                    : ''
                                            "
                                        />
                                        <div
                                            id="validationServer03Feedback"
                                            class="invalid-feedback"
                                            v-if="
                                                data.errors.hasOwnProperty(
                                                    'email_phonenumber'
                                                )
                                            "
                                        >
                                            {{
                                                data.errors.email_phonenumber[0]
                                            }}
                                        </div>
                                    </div>
                                    <label>Password</label>
                                    <div class="mb-3">
                                        <input
                                            type="password"
                                            class="form-control"
                                            placeholder="Enter password"
                                            aria-label="Password"
                                            aria-describedby="password-addon"
                                            v-model="data.formData.password"
                                            :class="
                                                data.errors.hasOwnProperty(
                                                    'password'
                                                )
                                                    ? 'is-invalid'
                                                    : ''
                                            "
                                        />
                                        <div
                                            id="validationServer03Feedback"
                                            class="invalid-feedback"
                                            v-if="
                                                data.errors.hasOwnProperty(
                                                    'password'
                                                )
                                            "
                                        >
                                            {{ data.errors.password[0] }}
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="form-check form-check-info text-left mb-0"
                                        >
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="flexCheckDefault"
                                            />
                                            <label
                                                class="font-weight-normal text-dark mb-0"
                                                for="flexCheckDefault"
                                            >
                                                Remember Me
                                            </label>
                                        </div>
                                        <a
                                            href="javascript:;"
                                            class="text-xs font-weight-bold ms-auto"
                                            >Forgot password</a
                                        >
                                    </div>
                                    <div class="text-center">
                                        <button
                                            type="button"
                                            class="btn btn-dark w-100 mt-4 mb-3"
                                            @click="submitForm"
                                        >
                                            Sign in
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="card-footer text-center pt-0 px-lg-2 px-1"
                                >
                                    <p class="mb-4 text-xs mx-auto">
                                        Don't have an account?
                                        <router-link
                                            href="javascript:;"
                                            class="text-dark font-weight-bold"
                                            to="/register"
                                            >Sign up</router-link
                                        >
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div
                                class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none"
                            >
                                <div
                                    class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8"
                                    style="
                                        background-image: url('../assets/img/image-sign-in.jpg');
                                    "
                                >
                                    <div
                                        class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4"
                                    >
                                        <h6 class="text-dark text-sm mt-5">
                                            Copyright © 2022 Corporate UI Design
                                            System by Creative Tim.
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script setup>
import { reactive } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();

const data = reactive({
    formData: {
        email_phonenumber: "1111111111",
        password: "12345678",
    },
    errors: {},
});

function submitForm() {
    axios
        .post("api/loginUser", data.formData)
        .then(function (response) {
            response.data.login_error ? (data.errors = response.data) : null;
            if (response.data.success) {
                data.errors = {};
                localStorage.setItem("token", response.data.token.token);
                sessionStorage.setItem("token", response.data.token.token);
                sessionStorage.setItem(
                    "user_permissions",
                    JSON.stringify(response.data.user_permissions)
                );
                // Call dashboard Router
                router.push("/dashboard");
            }
        })
        .catch(function (error) {
            data.errors = error.response.data.errors;
        });
}
</script>
