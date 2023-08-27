<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const title = "Update Password";

const form = useForm({
  current_password: "",
  password: "",
  password_confirmation: "",
});

const updatePassword = () => {
  form.put(route("password.update"), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.password) {
        form.reset("password", "password_confirmation");
        passwordInput.value.focus();
      }
      if (form.errors.current_password) {
        form.reset("current_password");
        currentPasswordInput.value.focus();
      }
    },
  });
};
</script>

<template>
  <h1 class="card-title">{{ title }}</h1>

  <p>Ensure your account is using a long, random password to stay secure.</p>

  <section>
    <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
      <!-- current password -->
      <div class="form-control w-full">
        <label class="label" for="current_password">
          <span class="label-text">Type your current password</span>
        </label>
        <input
          id="current_password"
          type="password"
          placeholder="Type your current password"
          class="input input-bordered w-full"
          v-model="form.current_password"
        />
        <label class="label">
          <span class="label-text-alt">{{ form.errors.current_password }}</span>
        </label>
      </div>

      <div class="form-control w-full">
        <label class="label" for="password">
          <span class="label-text">New Password</span>
        </label>

        <input
          id="password"
          type="password"
          class="input input-bordered w-full"
          v-model="form.password"
        />

        <label class="label">
          <span class="label-text-alt">{{ form.errors.password }}</span>
        </label>
      </div>

      <div class="form-control w-full">
        <label class="label" for="password_confirmation">
          <span class="label-text">Confirm Password</span>
        </label>

        <input
          id="password_confirmation"
          type="password"
          class="input input-bordered w-full"
          v-model="form.password_confirmation"
        />

        <label class="label">
          <span class="label-text-alt">{{
            form.errors.password_confirmation
          }}</span>
        </label>
      </div>

      <div class="card-actions">
        <button
          type="submit"
          class="btn btn-primary btn-block"
          :class="{
            'btn-disabled': form.processing || form.recentlySuccessful,
          }"
        >
          <span
            v-if="form.processing || form.recentlySuccessful"
            class="loading loading-spinner"
          ></span>
          <span v-else>Save</span>
        </button>
      </div>
    </form>
  </section>
</template>
