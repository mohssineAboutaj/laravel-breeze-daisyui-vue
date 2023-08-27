<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { useForm } from "@inertiajs/vue3";

// data
const title = "Reset Password";
const props = defineProps({
  email: { type: String, required: true },
  token: { type: String, required: true },
});
const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("password.store"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <GuestLayout :title="title" :fullFlex="true">
    <div class="card w-96 bg-neutral text-neutral-content mx-auto">
      <div class="card-body items-center text-center">
        <h2 class="card-title">{{ title }}</h2>
      </div>
      <form class="card-body" @submit.prevent="submit">
        <!-- email -->
        <div class="form-control w-full">
          <label class="label" for="email">
            <span class="label-text">Email</span>
          </label>
          <input
            autofocus
            id="email"
            type="email"
            placeholder="Email"
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
            <span class="label-text">Password</span>
          </label>
          <input
            id="password"
            type="password"
            placeholder="Password"
            class="input input-bordered w-full"
            v-model="form.password"
          />
          <label class="label">
            <span class="label-text-alt">{{ form.errors.password }}</span>
          </label>
        </div>

        <!-- password_confirmation -->
        <div class="form-control w-full">
          <label class="label" for="password_confirmation">
            <span class="label-text">Confirm Password</span>
          </label>
          <input
            id="password_confirmation"
            type="password"
            placeholder="Confirm Password"
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
    </div>
  </GuestLayout>
</template>
