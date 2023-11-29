<template>
    <model :name="'User'" :id="'form-model'" :size="'large'" ref="model">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"
                        >First Name</label
                    >
                    <input
                        class="form-control"
                        type="text"
                        v-model="data.formData.first_name"
                        :class="
                            data.errors.hasOwnProperty('first_name')
                                ? 'is-invalid'
                                : ''
                        "
                    />
                    <div
                        id="validationServer03Feedback"
                        class="invalid-feedback"
                        v-if="data.errors.hasOwnProperty('first_name')"
                    >
                        {{ data.errors.first_name[0] }}
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"
                        >Last Name</label
                    >
                    <input
                        class="form-control"
                        type="text"
                        v-model="data.formData.last_name"
                        :class="
                            data.errors.hasOwnProperty('last_name')
                                ? 'is-invalid'
                                : ''
                        "
                    />
                    <div
                        id="validationServer03Feedback"
                        class="invalid-feedback"
                        v-if="data.errors.hasOwnProperty('last_name')"
                    >
                        {{ data.errors.last_name[0] }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"
                        >Email</label
                    >
                    <input
                        class="form-control"
                        type="text"
                        v-model="data.formData.email"
                        :class="
                            data.errors.hasOwnProperty('email')
                                ? 'is-invalid'
                                : ''
                        "
                    />
                    <div
                        id="validationServer03Feedback"
                        class="invalid-feedback"
                        v-if="data.errors.hasOwnProperty('email')"
                    >
                        {{ data.errors.email[0] }}
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"
                        >Phone Number</label
                    >
                    <input
                        class="form-control"
                        type="text"
                        v-model="data.formData.phone_number"
                        :class="
                            data.errors.hasOwnProperty('phone_number')
                                ? 'is-invalid'
                                : ''
                        "
                    />
                    <div
                        id="validationServer03Feedback"
                        class="invalid-feedback"
                        v-if="data.errors.hasOwnProperty('phone_number')"
                    >
                        {{ data.errors.phone_number[0] }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"
                        >Country</label
                    >
                    <input
                        class="form-control"
                        type="text"
                        v-model="data.formData.country"
                        :class="
                            data.errors.hasOwnProperty('country')
                                ? 'is-invalid'
                                : ''
                        "
                    />
                    <div
                        id="validationServer03Feedback"
                        class="invalid-feedback"
                        v-if="data.errors.hasOwnProperty('country')"
                    >
                        {{ data.errors.country[0] }}
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"
                        >State</label
                    >
                    <input
                        class="form-control"
                        type="text"
                        v-model="data.formData.state"
                        :class="
                            data.errors.hasOwnProperty('state')
                                ? 'is-invalid'
                                : ''
                        "
                    />
                    <div
                        id="validationServer03Feedback"
                        class="invalid-feedback"
                        v-if="data.errors.hasOwnProperty('state')"
                    >
                        {{ data.errors.state[0] }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"
                        >PassWord</label
                    >
                    <input
                        class="form-control"
                        type="text"
                        v-model="data.formData.password"
                        :class="
                            data.errors.hasOwnProperty('password')
                                ? 'is-invalid'
                                : ''
                        "
                    />
                    <div
                        id="validationServer03Feedback"
                        class="invalid-feedback"
                        v-if="data.errors.hasOwnProperty('password')"
                    >
                        {{ data.errors.password[0] }}
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"
                        >Confirm Password</label
                    >
                    <input
                        class="form-control"
                        type="text"
                        v-model="data.formData.confirm_password"
                        :class="
                            data.errors.hasOwnProperty('confirm_password')
                                ? 'is-invalid'
                                : ''
                        "
                    />
                    <div
                        id="validationServer03Feedback"
                        class="invalid-feedback"
                        v-if="data.errors.hasOwnProperty('confirm_password')"
                    >
                        {{ data.errors.confirm_password[0] }}
                    </div>
                </div>
            </div>
        </div>
        <div v-if="!data.formData.id" class="form-check form-check-info text-left mb-0">
            <input
                class="form-check-input"
                type="checkbox"
                value="1"
                id="flexCheckDefault"
                v-model="data.formData.accept_privacy"
                :class="
                    data.errors.hasOwnProperty('accept_privacy')
                        ? 'is-invalid'
                        : ''
                "
            />
            <label
                class="font-weight-normal text-dark mb-0"
                for="flexCheckDefault"
            >
                I agree the
                <a href="javascript:;" class="text-dark font-weight-bold"
                    >Terms and Conditions</a
                >.
            </label>
            <div
                id="validationServer03Feedback"
                class="invalid-feedback"
                v-if="data.errors.hasOwnProperty('accept_privacy')"
            >
                {{ data.errors.accept_privacy[0] }}
            </div>
        </div>
        <template v-slot:submit-btn>
            <button type="button" class="btn btn-dark" @click="submitForm">
                Save
            </button>
        </template>
    </model>
</template>
<script setup>
import { reactive, ref } from "vue";
import Model from "../../../components/Model.vue";
const data = reactive({
    formData: {
        id: "",
        first_name: "",
        last_name: "",
        email: "",
        phone_number: "",
        country: "",
        state: "",
        accept_privacy: "",
        isactive: "",
        profile_img: "",
    },
    errors: {},
});
const model = ref(null);

const config = {
    headers: { Authorization: `Bearer ${localStorage.token}` },
};

function submitForm() {
    let url = data.formData.id
        ? "create-or-update/" + data.formData.id
        : "create-or-update";

    axios
        .post(`api/users/${url}`, data.formData, config)
        .then(function (response) {
            if (response.data.success) {
                model.value.hideModel();
                emit("userData");
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.data.success,
                    showConfirmButton: false,
                    timer: 900,
                });
            }
        })
        .catch(function (error) {
            if (error.response.data.errors) {
                data.errors = error.response.data.errors;
            } else if (error.message) {
                errorAlert(error.message);
            }
        });
}

function form(user) {
    data.errors = {};
    data.formData = user;
    model.value.openModel();
}

function errorAlert(error) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: error,
    });
}

defineExpose({
    form,
});
const emit = defineEmits(["userData"]);
</script>
