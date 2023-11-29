<style>
.file_class {
    display: none;
}

.avatar:hover .profilepic__content {
    opacity: 1;
}

.avatar:hover .profilepic__image {
    opacity: 0.5;
}

.profilepic__image {
    object-fit: cover;
    opacity: 1;
    transition: opacity 0.2s ease-in-out;
}

.profilepic__content {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    opacity: 0;
    transition: opacity 0.2s ease-in-out;
}

.profilepic__icon {
    color: white;
    padding-bottom: 8px;
}

.fas {
    font-size: 20px;
}

.profilepic__text {
    text-transform: uppercase;
    font-size: 9px;
    width: 50%;
    text-align: center;
}
</style>
<template>
    <section>
        <div class="container-fluid px-2 px-md-4">
            <div
                class="page-header min-height-300 border-radius-xl mt-4"
                style="
                    background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
                "
            >
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div
                            class="avatar avatar-xl position-relative"
                            @click="uploadProfileImg"
                        >
                            <img
                                :src="data.userData.profile_img"
                                alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm profilepic__image"
                            />
                            <div class="avatar avatar-xl profilepic__content">
                                <span class="profilepic__icon"
                                    ><i class="fas fa-camera"></i
                                ></span>
                                <input
                                    id="fileInput"
                                    type="file"
                                    class="position-absolute file_class"
                                    v-on:change="getFileInputValue"
                                />
                                <span class="profilepic__text"
                                    >Edit Profile</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{
                                    data.userData.first_name +
                                    " " +
                                    data.userData.last_name
                                }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ data.userData.email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0 text-bold text-info">
                                    Edit Profile
                                </p>
                                <button
                                    v-if="has_permission('edit_profile')"
                                    @click="editProfile"
                                    class="btn btn-info btn-sm ms-auto"
                                >
                                    Save Profile
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm text-normal">
                                User Information
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="example-text-input"
                                            class="form-control-label"
                                            >First Name</label
                                        >
                                        <input
                                            class="form-control"
                                            type="text"
                                            v-model="data.userData.first_name"
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
                                            {{ data.errors.first_name[0] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="example-text-input"
                                            class="form-control-label"
                                            >Last Name</label
                                        >
                                        <input
                                            class="form-control"
                                            type="email"
                                            v-model="data.userData.last_name"
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
                                            {{ data.errors.last_name[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark" />
                            <p class="text-uppercase text-sm text-normal">
                                Contact Information
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="example-text-input"
                                            class="form-control-label"
                                            >Email</label
                                        >
                                        <input
                                            class="form-control"
                                            type="email"
                                            v-model="data.userData.email"
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="example-text-input"
                                            class="form-control-label"
                                            >Phone Number</label
                                        >
                                        <input
                                            class="form-control"
                                            type="text"
                                            v-model="data.userData.phone_number"
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
                                            {{ data.errors.phone_number[0] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="example-text-input"
                                            class="form-control-label"
                                            >Country</label
                                        >
                                        <input
                                            class="form-control"
                                            type="text"
                                            v-model="data.userData.country"
                                            :class="
                                                data.errors.hasOwnProperty(
                                                    'country'
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
                                                    'country'
                                                )
                                            "
                                        >
                                            {{ data.errors.country[0] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="example-text-input"
                                            class="form-control-label"
                                            >State</label
                                        >
                                        <input
                                            class="form-control"
                                            type="text"
                                            v-model="data.userData.state"
                                            :class="
                                                data.errors.hasOwnProperty(
                                                    'state'
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
                                                    'state'
                                                )
                                            "
                                        >
                                            {{ data.errors.state[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark" />
                            <p class="text-uppercase text-sm text-normal">
                                Change Password
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="example-text-input"
                                            class="form-control-label"
                                            >Password</label
                                        >
                                        <input
                                            class="form-control"
                                            type="password"
                                            v-model="data.userData.password"
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="example-text-input"
                                            class="form-control-label"
                                            >Confirm Password</label
                                        >
                                        <input
                                            class="form-control"
                                            type="password"
                                            v-model="
                                                data.userData.confirm_password
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
                                                data.errors.confirm_password[0]
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { reactive, onMounted } from "vue";
import { has_permission } from "../authPermissions";

const data = reactive({
    userData: {},
    profile_img: "",
    errors: {},
});

onMounted(() => {
    getUser();
});

function getUser() {
    axios
        .get("api/user", {
            headers: { Authorization: `Bearer ${localStorage.token}` },
        })
        .then(function (response) {
            if (response) {
                data.userData = response.data;
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

function editProfile() {
    data.errors = {};
    data.userData.profile_img = data.profile_img;
    axios
        .post("api/profile/edit-profile", data.userData, {
            headers: {
                Authorization: `Bearer ${localStorage.token}`,
                "Content-Type": "multipart/form-data",
            },
        })
        .then(function (response) {
            if (response.data.updated) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.data.updated,
                    showConfirmButton: false,
                    timer: 900,
                });

                data.userData = response.data.updated_data;
            }
        })
        .catch(function (error) {
            // handle error
            data.errors = error.response.data.errors;
        });
}

function uploadProfileImg() {
    document.getElementById("fileInput").click();
}

const getFileInputValue = (event) => {
    const file = event.target.files[0];
    data.profile_img = file;
};
</script>
