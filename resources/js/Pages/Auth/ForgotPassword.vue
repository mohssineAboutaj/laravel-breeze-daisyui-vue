<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";

defineProps({
  status: { type: String },
});

// data
const title = "Forgot Password";
const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"), {
    onFinish: () => form.reset("email"),
  });
};
</script>

<template>
  <GuestLayout :title="title" :fullFlex="true">
    <div class="card w-96 bg-neutral text-neutral-content mx-auto">
      <div class="card-body items-center text-center">
        <h2 class="card-title">{{ title }}</h2>
        <p class="mb-4">
          Forgot your password? No problem. Just let us know your email address
          and we will email you a password reset link that will allow you to
          choose a new one.
        </p>
      </div>
      <form class="card-body" @submit.prevent="submit">
        <!-- email -->
        <div class="form-control w-full">
          <label class="label" for="email">
            <span class="label-text">Type your email</span>
          </label>
          <input
            autofocus
            id="email"
            type="email"
            placeholder="Type your email"
            class="input input-bordered w-full"
            v-model="form.email"
          />
          <label class="label">
            <span class="label-text-alt">{{ form.errors.email }}</span>
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
