<template>
    <nav aria-label="breadcrumb">
        <ol
            v-for="(crums, index) in breadCrumb.breadcrumbs"
            :key="index"
            class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5"
        >
            <li class="breadcrumb-item text-sm">
                <router-link
                    v-if="crums.to"
                    :to="crums.to"
                    class="opacity-5 text-dark"
                    href="javascript:;"
                    >{{ crums.text }}</router-link
                >
                <span v-else class="opacity-5 text-dark">
                    {{ crums.text }}
                </span>
            </li>
            <li
                class="breadcrumb-item text-sm text-dark active"
                aria-current="page"
            >
                {{ breadCrumb.currentcrumb }}
            </li>
        </ol>
        <h6 class="font-weight-bold mb-0">
            {{ breadCrumb.currentcrumb }}
        </h6>
    </nav>
</template>
<script setup>
import { useRoute } from "vue-router";
import { computed } from "vue";

const route = useRoute();

const breadCrumb = computed(() => {
    const bread_crumbs = route.matched.flatMap(
        (record) => record.meta?.breadCrumb || []
    );
    const current_crumb = bread_crumbs[bread_crumbs.length - 1].text || "";
    return { breadcrumbs: bread_crumbs, currentcrumb: current_crumb };
});
// const currentCrumb = computed(() => {
//     console.log(breadCrumb.value);
//     return breadCrumb.value;
// });
</script>
