<script setup>
import { computed } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
  status: { type: String },
});

const title = "Verify Email";
const form = useForm({});

const submit = () => {
  form.post(route("verification.send"));
};

const verificationLinkSent = computed(
  () => props.status === "verification-link-sent"
);
</script>

<template>
  <GuestLayout>
    <div class="card w-96 bg-neutral text-neutral-content mx-auto">
      <div class="card-body items-center text-center">
        <h2 class="card-title">{{ title }}</h2>
      </div>

      <div class="card-body">
        Thanks for signing up! Before getting started, could you verify your
        email address by clicking on the link we just emailed to you? If you
        didn't receive the email, we will gladly send you another.
      </div>

      <div class="card-body" v-if="verificationLinkSent">
        A new verification link has been sent to the email address you provided
        during registration.
      </div>

      <form class="card-body" @submit.prevent="submit">
        <button
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
          :href="route('logout')"
          method="post"
          as="button"
          class="btn btn-error btn-block"
        >
          Log Out
        </Link>
      </form>
    </div>
  </GuestLayout>
</template>
