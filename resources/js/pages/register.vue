<template>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div
                                class="position-absolute w-40 top-0 start-0 h-100 d-md-block d-none"
                            >
                                <div
                                    class="oblique-image position-absolute d-flex fixed-top ms-auto h-100 z-index-0 bg-cover me-n8"
                                    style="
                                        background-image: url('../assets/img/image-sign-up.jpg');
                                    "
                                >
                                    <div
                                        class="my-auto text-start max-width-350 ms-7"
                                    >
                                        <h1
                                            class="mt-3 text-white font-weight-bolder"
                                        >
                                            Start your <br />
                                            new journey.
                                        </h1>
                                        <p class="text-white text-lg mt-4 mb-4">
                                            Use these awesome forms to login or
                                            create new account in your project
                                            for free.
                                        </p>
                                    </div>
                                    <div
                                        class="text-start position-absolute fixed-bottom ms-7"
                                    >
                                        <h6 class="text-white text-sm mb-5">
                                            Copyright © 2023 GoStock.
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div
                                    class="card-header pb-0 text-left bg-transparent"
                                >
                                    <h3
                                        class="font-weight-black text-dark display-6"
                                    >
                                        Sign up
                                    </h3>
                                    <p class="mb-0">
                                        Nice to meet you! Please enter your
                                        details.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>First Name</label>
                                            <div class="mb-3">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter your First name"
                                                    aria-label="First Name"
                                                    aria-describedby="name-addon"
                                                    v-model="
                                                        data.formData.first_name
                                                    "
                                                    :class="
                                                        data.errors.hasOwnProperty(
                                                            'first_name'
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
                                                            'first_name'
                                                        )
                                                    "
                                                >
                                                    {{
                                                        data.errors
                                                            .first_name[0]
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label>Last Name</label>
                                            <div class="mb-3">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter your Last name"
                                                    aria-label="Last Name"
                                                    aria-describedby="name-addon"
                                                    v-model="
                                                        data.formData.last_name
                                                    "
                                                    :class="
                                                        data.errors.hasOwnProperty(
                                                            'last_name'
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
                                                            'last_name'
                                                        )
                                                    "
                                                >
                                                    {{
                                                        data.errors.last_name[0]
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Email Address</label>
                                            <div class="mb-3">
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    placeholder="Enter your email address"
                                                    aria-label="Email"
                                                    aria-describedby="email-addon"
                                                    v-model="
                                                        data.formData.email
                                                    "
                                                    :class="
                                                        data.errors.hasOwnProperty(
                                                            'email'
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
                                                            'email'
                                                        )
                                                    "
                                                >
                                                    {{ data.errors.email[0] }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label>Phone Number</label>
                                            <div class="mb-3">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter your Phone Number"
                                                    aria-label="Phone Number"
                                                    aria-describedby="name-addon"
                                                    v-model="
                                                        data.formData
                                                            .phone_number
                                                    "
                                                    :class="
                                                        data.errors.hasOwnProperty(
                                                            'phone_number'
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
                                                            'phone_number'
                                                        )
                                                    "
                                                >
                                                    phone nummber
                                                    {{
                                                        data.errors
                                                            .phone_number[0]
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Password</label>
                                            <div class="mb-3">
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    placeholder="Create a password"
                                                    aria-label="Password"
                                                    aria-describedby="password-addon"
                                                    v-model="
                                                        data.formData.password
                                                    "
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
                                                    {{
                                                        data.errors.password[0]
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label>Password</label>
                                            <div class="mb-3">
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    placeholder="Create a Confirm password"
                                                    aria-label="confirm Password"
                                                    aria-describedby="password-addon"
                                                    v-model="
                                                        data.formData
                                                            .confirm_password
                                                    "
                                                    :class="
                                                        data.errors.hasOwnProperty(
                                                            'confirm_password'
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
                                                            'confirm_password'
                                                        )
                                                    "
                                                >
                                                    {{
                                                        data.errors
                                                            .confirm_password[0]
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="form-check form-check-info text-left mb-0"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value="1"
                                            id="flexCheckDefault"
                                            v-model="
                                                data.formData.accept_privacy
                                            "
                                            :class="
                                                data.errors.hasOwnProperty(
                                                    'accept_privacy'
                                                )
                                                    ? 'is-invalid'
                                                    : ''
                                            "
                                        />
                                        <label
                                            class="font-weight-normal text-dark mb-0"
                                            for="flexCheckDefault"
                                        >
                                            I agree the
                                            <a
                                                href="javascript:;"
                                                class="text-dark font-weight-bold"
                                                >Terms and Conditions</a
                                            >.
                                        </label>
                                        <div
                                            id="validationServer03Feedback"
                                            class="invalid-feedback"
                                            v-if="
                                                data.errors.hasOwnProperty(
                                                    'accept_privacy'
                                                )
                                            "
                                        >
                                            {{ data.errors.accept_privacy[0] }}
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button
                                            type="button"
                                            class="btn btn-dark w-100 mt-4 mb-3"
                                            @click="submitForm"
                                        >
                                            Sign up
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="card-footer text-center pt-0 px-lg-2 px-1"
                                >
                                    <p class="mb-4 text-xs mx-auto">
                                        Already have an account?
                                        <router-link
                                            class="text-dark font-weight-bold"
                                            to="/login"
                                            >Sign in</router-link
                                        >
                                    </p>
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

const data = reactive({
    formData: {
        first_name: "Majeed",
        last_name: "Godhrawala",
        email: "majeed@gmail.com",
        phone_number: "1234567890",
        password: "12345678",
        confirm_password: "12345678",
        accept_privacy: "",
    },
    errors: {},
});

function submitForm() {
    axios
        .post("api/create-user", data.formData)
        .then(function (response) {
            if (response.data.success) {
                data.errors = {};
                window.location.href = "/";
            }
        })
        .catch(function (error) {
            data.errors = error.response.data.errors;
        });
}
</script>
