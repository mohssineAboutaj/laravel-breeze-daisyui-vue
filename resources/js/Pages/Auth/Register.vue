<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";

// data
const title = "Register";
const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("register.store"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <GuestLayout :title="title" :full-flex="true">
    <div class="card w-96 bg-neutral text-neutral-content mx-auto">
      <div class="card-body items-center text-center">
        <h2 class="card-title">{{ title }}</h2>
      </div>
      <form class="card-body" @submit.prevent="submit">
        <!-- name -->
        <div class="form-control w-full">
          <label class="label" for="name">
            <span class="label-text">Type your name</span>
          </label>
          <input
            autofocus
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

        <!-- password -->
        <div class="form-control w-full">
          <label class="label" for="password">
            <span class="label-text">Type your password</span>
          </label>
          <input
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

        <div class="form-control w-full">
          <label class="label" for="password_confirmation">
            <span class="label-text">Confirm your password</span>
          </label>
          <input
            id="password_confirmation"
            type="password"
            placeholder="Confirm your password"
            class="input input-bordered w-full"
            v-model="form.password_confirmation"
          />
          <label class="label">
            <span class="label-text-alt">
              {{ form.errors.password_confirmation }}
            </span>
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
            Already registered?
          </Link>
        </div>
      </form>
    </div>
  </GuestLayout>
</template>
