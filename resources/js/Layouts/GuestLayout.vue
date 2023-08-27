<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { computed } from "vue";

// props
defineProps({
  title: { type: String, default: "Laravel" },
  container: { type: Boolean, default: true },
  fullFlex: { type: Boolean, default: false },
});

const page = usePage();

// computed
const canLogin = computed(() => page.props.can.login);
const canRegister = computed(() => page.props.can.register);
</script>

<template>
  <Head :title="title" />

  <nav class="navbar bg-base-100 fixed">
    <div class="flex-1">
      <Link
        :href="route('welcome')"
        class="flex items-center gap-x-2 normal-case text-xl"
      >
        <ApplicationLogo />
        <span>{{ title }}</span>
      </Link>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal px-1">
        <li v-if="$page.props.auth.user">
          <Link :href="route('dashboard')">Dashboard</Link>
        </li>

        <template v-else>
          <li v-if="canLogin">
            <Link :href="route('login')">Login</Link>
          </li>

          <li v-if="canRegister">
            <Link v-if="canRegister" :href="route('register')">Register</Link>
          </li>
        </template>
      </ul>
    </div>
  </nav>

  <main
    :class="{
      container,
      'flex items-center min-h-screen': fullFlex,
    }"
  >
    <slot />
  </main>
</template>
