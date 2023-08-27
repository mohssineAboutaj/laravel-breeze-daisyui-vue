<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { ref } from "vue";

defineProps({
  mustVerifyEmail: { type: Boolean },
  status: { type: String },
});

const title = "Profile";

const tabs = [
  { label: "Profile Information" },
  { label: "Update Password" },
  { label: "Delete Account" },
];
const activeTab = ref(0);
</script>

<template>
  <AuthenticatedLayout :title="title">
    <div class="card bg-neutral text-neutral-content mx-auto max-w-lg">
      <div class="card-body">
        <div class="tabs flex">
          <a
            v-for="(tab, index) in tabs"
            :key="index"
            class="tab flex-1 tab-bordered pb-16"
            :class="{ 'tab-active': activeTab == index }"
            @click="activeTab = index"
          >
            {{ tab.label }}
          </a>
        </div>
      </div>
      <div class="card-body flex gap-y-8">
        <UpdateProfileInformationForm
          v-if="activeTab == 0"
          :must-verify-email="mustVerifyEmail"
          :status="status"
        />
        <UpdatePasswordForm v-if="activeTab == 1" />
        <DeleteUserForm v-if="activeTab == 2" />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
