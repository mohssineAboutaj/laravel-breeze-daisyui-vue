<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";

// data
const title = "Confirm Password";
const form = useForm({
  password: "",
});

const submit = () => {
  form.post(route("password.confirm"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <GuestLayout :title="title" :fullFlex="true">
    <div class="card w-96 bg-neutral text-neutral-content mx-auto">
      <div class="card-body items-center text-center">
        <h2 class="card-title">{{ title }}</h2>
        <div class="mb-4 text-sm text-gray-600">
          This is a secure area of the application. Please confirm your password
          before continuing.
        </div>
      </div>
      <form class="card-body" @submit.prevent="submit">
        <!-- password -->
        <div class="form-control w-full">
          <label class="label" for="password">
            <span class="label-text">Type your password</span>
          </label>
          <input
            autofocus
            id="password"
            type="password"
            placeholder="Type your password"
            class="input input-bordered w-full"
            v-model="form.password"
          />
          <label class="label">
            <span class="label-text-alt">{{ form.errors.password }}</span>
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

          <Link :href="route('login')" class="btn btn-link btn-block">
            Back to login
          </Link>
        </div>
      </form>
    </div>
  </GuestLayout>
</template>
