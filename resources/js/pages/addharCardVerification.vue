<template>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label"
                    >Adhaar Number</label
                >
                <input
                    class="form-control"
                    type="text"
                    v-model="data.formData.addhaarNumber"
                />
            </div>
        </div>
        <div class="col-4">
            <input
                type="radio"
                name="gender"
                value="Male"
                v-model="data.formData.gender"
                id="radiobutton"
            />
            <label for="radiobutton">Male</label>
            <br />
            <input
                type="radio"
                name="gender"
                value="Female"
                v-model="data.formData.gender"
                id="radiobutton1"
            />
            <label for="radiobutton1">Female</label>
        </div>
        <div class="col-4">
            <div class="mb-3">
                <label for="formFile" class="form-label">Adhaar Card</label>
                <input
                    class="form-control"
                    id="fileInput"
                    type="file"
                    v-on:change="getFileInputValue"
                />
            </div>
        </div>
    </div>
    <button class="btn btn-primary" @click="verify">Verify</button>
</template>
<script setup>
import { reactive } from "vue";
import { createWorker } from "tesseract.js";

const data = reactive({
    formData: {
        addhaarNumber: "233469361311",
        gender: "",
        adhaar_card_img: "",
    },
    errors: {},
});

const config = {
    headers: {
        Authorization: `Bearer ${localStorage.token}`,
        "Content-Type": "multipart/form-data",
    },
};

function verify() {
    (async () => {
        const worker = await createWorker("eng");
        const ret = await worker.recognize(data.formData.adhaar_card_img);
        console.log(ret.data.text);
        await worker.terminate();
    })();

    // axios
    //     .post(`api/verify`, data.formData, config)
    //     .then(function (response) {
    //         if (response.data.success) {
    //             Swal.fire({
    //                 position: "top-end",
    //                 icon: "success",
    //                 title: response.data.success,
    //                 showConfirmButton: false,
    //                 timer: 900,
    //             });
    //         }
    //     })
    //     .catch(function (error) {
    //         errorAlert(error.message);
    //     });
}

const getFileInputValue = (event) => {
    const file = event.target.files[0];
    data.formData.adhaar_card_img = file;
};
</script>
