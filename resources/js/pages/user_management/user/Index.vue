<template>
    <user_From ref="form" @userData="userData"></user_From>
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">
                                Users
                            </h6>
                        </div>
                        <div class="ms-auto d-flex">
                            <button
                                v-if="has_permission('add_user')"
                                type="button"
                                class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                @click="userForm"
                            >
                                <span class="btn-inner--icon">
                                    <svg
                                        width="16"
                                        height="16"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        class="d-block me-2"
                                    >
                                        <path
                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"
                                        />
                                    </svg>
                                </span>
                                <span class="btn-inner--text">Add User</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 py-0">
                    <div
                        class="border-bottom py-3 px-3 d-sm-flex align-items-center"
                    >
                        <div
                            class="btn-group"
                            role="group"
                            aria-label="Basic radio toggle button group"
                        >
                            <select
                                class="btn btn-white px-3 mb-0"
                                id="slct"
                                required="required"
                                v-model="data.per_page"
                                @change="changePerpage"
                            >
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <input
                                type="radio"
                                class="btn-check"
                                name="btnradiotable"
                                id="btnradiotable2"
                                autocomplete="off"
                            />
                            <label
                                class="btn btn-white px-3 mb-0"
                                for="btnradiotable2"
                                >Monitored</label
                            >
                            <input
                                type="radio"
                                class="btn-check"
                                name="btnradiotable"
                                id="btnradiotable3"
                                autocomplete="off"
                            />
                            <label
                                class="btn btn-white px-3 mb-0"
                                for="btnradiotable3"
                                >Unmonitored</label
                            >
                        </div>
                        <div class="input-group w-sm-25 ms-auto">
                            <span class="input-group-text text-body">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16px"
                                    height="16px"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                                    ></path>
                                </svg>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search"
                                @input="searchData($event.target.value)"
                            />
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="text-secondary text-xs font-weight-bold"
                                    >
                                        Index
                                    </th>
                                    <th
                                        class="text-secondary text-xs font-weight-bold"
                                    >
                                        Name
                                    </th>
                                    <th
                                        class="text-secondary text-xs font-weight-bold"
                                    >
                                        Email
                                    </th>
                                    <th
                                        class="text-secondary text-xs font-weight-bold"
                                    >
                                        Phone Number
                                    </th>
                                    <th
                                        class="text-secondary text-xs font-weight-bold"
                                    >
                                        Country
                                    </th>
                                    <th
                                        class="text-secondary text-xs font-weight-bold"
                                    >
                                        State
                                    </th>
                                    <th
                                        class="text-secondary text-xs font-weight-bold"
                                    >
                                        Is Active
                                    </th>
                                    <th
                                        v-if="
                                            has_permission('edit_user') ||
                                            has_permission('delete_user')
                                        "
                                        class="text-secondary text-xs font-weight-bold"
                                    >
                                        Option
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(user, index) in data.users"
                                    :key="index"
                                >
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div
                                                class="d-flex flex-column justify-content-center ms-1"
                                            >
                                                <h6
                                                    class="mb-0 text-sm font-weight-semibold"
                                                >
                                                    {{ index + 1 }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div
                                                class="d-flex align-items-center"
                                            >
                                                <img
                                                    :src="user.profile_img"
                                                    class="avatar avatar-sm rounded-circle me-2"
                                                    alt="user1"
                                                />
                                            </div>
                                            <div
                                                class="d-flex flex-column justify-content-center ms-1"
                                            >
                                                <h6
                                                    class="mb-0 text-sm font-weight-semibold"
                                                >
                                                    {{ user.first_name }}
                                                    {{ user.last_name }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div
                                                class="d-flex flex-column justify-content-center ms-1"
                                            >
                                                <h6
                                                    class="mb-0 text-sm font-weight-semibold"
                                                >
                                                    {{ user.email }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div
                                                class="d-flex flex-column justify-content-center ms-1"
                                            >
                                                <h6
                                                    class="mb-0 text-sm font-weight-semibold"
                                                >
                                                    {{ user.phone_number }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div
                                                class="d-flex flex-column justify-content-center ms-1"
                                            >
                                                <h6
                                                    class="mb-0 text-sm font-weight-semibold"
                                                >
                                                    {{ user.country }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div
                                                class="d-flex flex-column justify-content-center ms-1"
                                            >
                                                <h6
                                                    class="mb-0 text-sm font-weight-semibold"
                                                >
                                                    {{ user.state }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div
                                                class="d-flex flex-column justify-content-center ms-1"
                                            >
                                                <span
                                                    class="badge badge-sm border"
                                                    :class="
                                                        user.isactive
                                                            ? ' border-success text-success bg-success'
                                                            : 'border-danger text-danger bg-danger'
                                                    "
                                                    >{{
                                                        user.isactive
                                                            ? "Active"
                                                            : "InActive"
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <a
                                            v-if="has_permission('edit_user')"
                                            href="javascript:;"
                                            class="text-secondary font-weight-bold text-xs m-3"
                                            @click="userForm(user)"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a
                                            v-if="has_permission('delete_user')"
                                            href="javascript:;"
                                            class="text-secondary font-weight-bold text-xs m-3"
                                            @click="destroy(user)"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top py-3 px-3 d-flex align-items-center">
                        <p class="font-weight-semibold mb-0 text-dark text-sm">
                            Page 1 of 10
                        </p>
                        <div class="ms-auto">
                            <button class="btn btn-sm btn-white mb-0">
                                Previous
                            </button>
                            <button class="btn btn-sm btn-white mb-0">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { reactive, onMounted, ref } from "vue";
import user_From from "./Form.vue";
import { has_permission } from "../../../authPermissions";
const data = reactive({
    users: {},
    current_page: 1,
    per_page: 5,
    search: "",
});

const form = ref(null);

onMounted(() => {
    userData();
});

const config = {
    headers: { Authorization: `Bearer ${localStorage.token}` },
};

function userData() {
    let request_data = {
        per_page: data.per_page,
        search: data.search,
    };
    axios
        .post("api/users/data-table", request_data, config)
        .then(function (response) {
            if (response.data.users) {
                data.users = response.data.users;
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

function userForm(user = null) {
    form.value.form(user);
}

function destroy(user) {
    Swal.fire({
        title: "Are you sure?",
        text:
            "Do You Want To Delete " +
            user.first_name +
            " " +
            user.last_name +
            " Record",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .get(`api/users/destroy/${user.id}`, config)
                .then(function (response) {
                    if (response.data.delete) {
                        Swal.fire("Deleted!", response.data.delete, "success");
                        userData();
                    }
                })
                .catch(function (error) {
                    if (error.message) {
                        errorAlert(error.message);
                    }
                });
        }
    });
}

function changePerpage() {
    data.current_page = 1;
    userData();
    console.log(data.per_page);
}

function errorAlert(error) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: error,
    });
}

function searchData(search) {
    if (search) {
        data.search = search;
    } else {
        data.search = "";
    }
    userData();
}
</script>
