<template>
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">
                                Permission
                            </h6>
                        </div>
                        <div class="ms-auto d-flex">
                            <button
                                v-if="!data.update_permission"
                                type="button"
                                class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                @click="
                                    data.update_permission =
                                        !data.update_permission
                                "
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
                                <span class="btn-inner--text">Update</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="text-secondary text-xs font-weight-bold"
                                    >
                                        Permissions
                                    </th>
                                    <th
                                        class="text-secondary text-xs font-weight-bold"
                                        v-for="(role, index) in data.roles"
                                        :key="role.id"
                                    >
                                        {{ role.display_name }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(
                                        permissions, index
                                    ) in data.role_permissions"
                                    :key="index"
                                >
                                    <td>
                                        <div
                                            class="d-flex px-2 py-1"
                                            v-for="(
                                                permission, index
                                            ) in permissions"
                                            :key="index"
                                        >
                                            <div
                                                class="d-flex flex-column justify-content-center ms-1"
                                            >
                                                <h6
                                                    class="mb-0 text-sm font-weight-semibold"
                                                >
                                                    {{
                                                        permission.display_name
                                                    }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        v-for="(role, index) in data.roles"
                                        :key="role.id"
                                    >
                                        <template
                                            v-for="(
                                                permission, index
                                            ) in permissions"
                                            :key="index"
                                        >
                                            <template
                                                v-for="(
                                                    permission_role, index
                                                ) in permission.roles"
                                                :key="index"
                                            >
                                                <div
                                                    v-if="
                                                        permission_role.id ==
                                                        role.id
                                                    "
                                                >
                                                    <template
                                                        v-if="
                                                            data.update_permission
                                                        "
                                                    >
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input"
                                                                name="permission_checkbox"
                                                                type="checkbox"
                                                                :value="
                                                                    permission.name
                                                                "
                                                                :id="
                                                                    permission_role.id
                                                                "
                                                                :checked="
                                                                    permission_role.has_permission
                                                                "
                                                            />
                                                        </div>
                                                    </template>
                                                    <template v-else>
                                                        <template
                                                            v-if="
                                                                permission_role.has_permission
                                                            "
                                                        >
                                                            <i
                                                                class="fa-solid fa-check text-success"
                                                            ></i>
                                                        </template>
                                                        <template v-else>
                                                            <i
                                                                class="fa-solid fa-xmark text-danger"
                                                            ></i>
                                                        </template>
                                                    </template>
                                                </div>
                                            </template>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top py-3 px-3 d-flex align-items-center">
                        <div class="ms-auto">
                            <button
                                class="btn btn-sm btn-white mb-0"
                                v-if="data.update_permission"
                                @click="saveChangePermissions"
                            >
                                Save
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
const data = reactive({
    roles: Object,
    role_permissions: Object,
    update_permission: false,
});

onMounted(() => {
    allPermissionsWithRoles();
});
const config = {
    headers: { Authorization: `Bearer ${localStorage.token}` },
};

function allPermissionsWithRoles() {
    axios
        .get("api/permissions/data-table", config)
        .then(function (response) {
            if (response.data.roles && response.data.role_permissions) {
                data.roles = response.data.roles;
                data.role_permissions = response.data.role_permissions;
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

function errorAlert(error) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: error,
    });
}

function saveChangePermissions() {
    data.update_permission = !data.update_permission;
    let update_array = {};
    var permissions = document.getElementsByName("permission_checkbox");

    Object.entries(data.roles).forEach(([key, role]) => {
        let permission_name_array = [];
        Object.entries(permissions).forEach(([key, element]) => {
            if (element.checked && element.id == role.id) {
                permission_name_array.push(element.value);
            }
        });
        update_array[role.id] = permission_name_array;
    });
    axios
        .post(
            "api/permissions/update-role_permissions",
            { role_permission: update_array },
            config
        )
        .then(function (response) {
            if (response.data.updated) {
                allPermissionsWithRoles();
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.data.updated,
                    showConfirmButton: false,
                    timer: 900,
                });
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}
</script>
