<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, usePage } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { computed } from "vue";

// data and instance
const title = "Welcome";
const page = usePage();

// computed
const canLogin = computed(() => page.props.can.login);
</script>

<template>
  <GuestLayout :title="title" :container="false">
    <div
      class="hero min-h-screen"
      style="
        background-image: url(https://images.pexels.com/photos/16936915/pexels-photo-16936915/free-photo-of-people-waiting-in-terminal-in-black-and-white.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
      "
    >
      <div class="hero-overlay bg-opacity-80"></div>
      <div class="hero-content text-center text-neutral-content">
        <div class="text-center capitalize">
          <ApplicationLogo classes="w-32 mx-auto" />
          <h1 class="my-8 text-5xl">
            <span>welcome to </span>
            <span class="text-primary font-bold">
              {{ page.props.env.title }}
            </span>
          </h1>
          <div class="flex gap-x-4 justify-center">
            <Link
              v-if="canLogin"
              :href="route('login')"
              class="btn btn-primary"
            >
              Login
            </Link>
            <Link
              v-if="canLogin"
              :href="route('register')"
              class="btn btn-success"
            >
              Register
            </Link>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>
