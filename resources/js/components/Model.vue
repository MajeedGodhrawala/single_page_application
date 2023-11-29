<template>
    <div
        class="modal fade"
        :id="id"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalLabel"
        aria-hidden="true"
    >
        <div
            class="modal-dialog modal-dialog-centered"
            :class="data.model_size[size]"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">{{ name }}</h5>
                    <button
                        type="button"
                        class="btn-close text-dark"
                        @click="hideModel"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-white"
                        @click="hideModel"
                    >
                        Close
                    </button>
                    <slot name="submit-btn"></slot>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { reactive, onMounted } from "vue";

const data = reactive({
    errors: {},
    myModal: null,
    model_size: {
        default: "",
        small: "modal-sm",
        large: "modal-lg",
        extra_large: "modal-xl",
    },
});
const props = defineProps({
    name: {
        default: "Model",
        type: String,
    },
    id: {
        default: "Model",
        type: String,
    },
    size: {
        default: "default",
        type: String,
    },
});
onMounted(() => {
    // console.log(`#${props.id}`);
    data.myModal = new bootstrap.Modal(document.getElementById(props.id));
});

function openModel() {
    data.myModal.show();
}

function hideModel() {
    data.myModal.hide();
}
defineExpose({
    openModel,
    hideModel,
});
</script>
