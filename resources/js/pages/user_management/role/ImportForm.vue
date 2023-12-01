<template>
    <model
        :name="'Import Roles File'"
        :size="'large'"
        :id="'import-form-model'"
        ref="model"
    >
        <div class="form-control border dropzone" id="dropzone">
            <div class="fallback">
                <input
                    name="file"
                    type="file"
                    @change="uploadFile($event)"
                    multiple
                />
            </div>
        </div>
        <div class="text-danger" v-if="data.errors.hasOwnProperty('file')">
            {{ data.errors.file[0] }}
        </div>
        <br />
        <table
            v-if="Object.keys(data.errors).length > 0 && !data.errors.file"
            class="table align-items-center mb-0"
        >
            <thead>
                <tr>
                    <td>Row</td>
                    <td>Field</td>
                    <td>Error</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(error, index) in data.errors" :key="index">
                    <td>
                        {{ index.split(".")[0] }}
                    </td>
                    <td>
                        {{ index.split(".")[1] }}
                    </td>
                    <td class="text-danger">
                        {{ error[0] }}
                    </td>
                </tr>
            </tbody>
        </table>
    </model>
</template>
<script setup>
import { reactive, ref } from "vue";
import Model from "../../../components/Model.vue";

const data = reactive({
    errors: Object,
});
const model = ref(null);

function uploadFile(e) {
    const formData = new FormData();
    const file = e.target.files[0];
    formData.append("file", file);
    axios
        .post("api/roles/upload-csv-file", formData, {
            headers: {
                Authorization: `Bearer ${localStorage.token}`,
                "content-type": "multipart/form-data",
            },
        })
        .then(function (response) {
            if (response.data.file) {
                model.value.hideModel();
                emit("RolesData");
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Upload Success",
                    html: `<ul class="list-group  justify-content-start">
                                <li class="list-group-item"><b>File : </b>${response.data.file}</li>
                                <li class="list-group-item">
                                    <b>Total Records : </b>${response.data.summery.total_records}
                                </li>
                                <li class="list-group-item">
                                    <b>Create : </b>${response.data.summery.create}
                                </li>
                                <li class="list-group-item">
                                    <b>Update : </b>${response.data.summery.update}
                                </li>
                           <ul/>`,
                    showConfirmButton: true,
                    timer: false,
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

function importForm(role) {
    data.errors = {};
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
    importForm,
});
const emit = defineEmits(["RolesData"]);
</script>
