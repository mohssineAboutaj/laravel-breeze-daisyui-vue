<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";

defineProps({
  status: { type: String },
  canResetPassword: { type: Boolean },
});

// data
const title = "Log in";
const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <GuestLayout :title="title" :fullFlex="true">
    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <div class="card w-96 bg-neutral text-neutral-content mx-auto">
      <div class="card-body items-center text-center">
        <h2 class="card-title">{{ title }}</h2>
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

        <!-- remember me -->
        <div class="form-control">
          <label class="label cursor-pointer">
            <span class="label-text">Remember me</span>
            <input
              name="remember"
              v-model="form.remember"
              type="checkbox"
              checked="checked"
              class="checkbox checkbox-primary"
            />
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

          <Link
            v-if="canResetPassword"
            :href="route('password.request')"
            class="btn btn-link btn-block"
          >
            Forgot your password?
          </Link>

          <Link :href="route('register')" class="btn btn-link btn-block">
            don't have an account?
          </Link>
        </div>
      </form>
    </div>
  </GuestLayout>
</template>
