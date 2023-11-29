<template>
    <model :name="'Role'" :id="'form-model'" ref="model">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"
                        >Name</label
                    >
                    <input
                        class="form-control"
                        type="text"
                        v-model="data.formData.name"
                        :class="
                            data.errors.hasOwnProperty('name')
                                ? 'is-invalid'
                                : ''
                        "
                    />
                    <div
                        id="validationServer03Feedback"
                        class="invalid-feedback"
                        v-if="data.errors.hasOwnProperty('name')"
                    >
                        {{ data.errors.name[0] }}
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"
                        >display Name</label
                    >
                    <input
                        class="form-control"
                        type="text"
                        v-model="data.formData.display_name"
                        :class="
                            data.errors.hasOwnProperty('display_name')
                                ? 'is-invalid'
                                : ''
                        "
                    />
                    <div
                        id="validationServer03Feedback"
                        class="invalid-feedback"
                        v-if="data.errors.hasOwnProperty('display_name')"
                    >
                        {{ data.errors.display_name[0] }}
                    </div>
                </div>
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
import { reactive, onMounted, ref } from "vue";
import Model from "../../../components/Model.vue";
const data = reactive({
    formData: {
        id: "",
        name: "",
        display_name: "",
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
        .post(`api/roles/${url}`, data.formData, config)
        .then(function (response) {
            if (response.data.success) {
                model.value.hideModel();
                emit("RolesData");
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

function form(role) {
    data.errors = {};
    data.formData = role;
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
const emit = defineEmits(["RolesData"]);
</script>
