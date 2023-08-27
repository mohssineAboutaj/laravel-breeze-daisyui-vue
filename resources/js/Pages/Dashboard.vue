<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage } from "@inertiajs/vue3";

const title = "Dashboard";
const page = usePage();
</script>

<template>
  <AuthenticatedLayout :title="title" :full-flex="true">
    <div class="flex max-w-xl mx-auto gap-4 flex-wrap">
      <h1 class="my-8 text-5xl mx-auto capitalize">
        <span>welcome to </span>
        <span class="text-primary font-bold">
          {{ page.props.env.title }}
        </span>
      </h1>
      <div class="flex mx-auto">
        <a
          :href="route('profile.edit')"
          class="btn btn-primary btn-lg btn-block"
        >
          edit profile
        </a>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
