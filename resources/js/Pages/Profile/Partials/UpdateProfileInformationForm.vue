<script setup>
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
  mustVerifyEmail: { type: Boolean },
  status: { type: String },
});

const user = usePage().props.auth.user;

const title = "Profile Information";

const form = useForm({
  name: user.name,
  email: user.email,
});
</script>

<template>
  <h1 class="card-title">{{ title }}</h1>

  <p>Update your account's profile information and email address.</p>

  <form @submit.prevent="form.patch(route('profile.update'))">
    <!-- name -->
    <div class="form-control w-full">
      <label class="label" for="name">
        <span class="label-text">Type your name</span>
      </label>
      <input
        id="name"
        type="text"
        placeholder="Type your name"
        class="input input-bordered w-full"
        v-model="form.name"
      />
      <label class="label">
        <span class="label-text-alt">{{ form.errors.name }}</span>
      </label>
    </div>

    <!-- email -->
    <div class="form-control w-full">
      <label class="label" for="email">
        <span class="label-text">Type your email</span>
      </label>
      <input
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
        :class="{ 'btn-disabled': form.processing || form.recentlySuccessful }"
      >
        <span
          v-if="form.processing || form.recentlySuccessful"
          class="loading loading-spinner"
        ></span>
        <span v-else>Save</span>
      </button>
    </div>
  </form>
</template>
