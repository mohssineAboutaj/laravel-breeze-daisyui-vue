<script setup>
import { Link, Head } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

// props
defineProps({
  title: { type: String, default: "Laravel" },
  container: { type: Boolean, default: true },
  fullFlex: { type: Boolean, default: false },
});
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
          <Link :href="route('welcome')">Home</Link>
        </li>

        <li v-if="$page.props.auth.user">
          <Link :href="route('dashboard')">Dashboard</Link>
        </li>

        <template v-if="$page.props.auth.user">
          <li>
            <details>
              <summary>{{ $page.props.auth.user.name }}</summary>
              <ul class="p-2 bg-base-100">
                <li>
                  <!-- link to profile.edit -->
                  <Link :href="route('profile.edit')">Profile</Link>
                </li>
                <li>
                  <!-- logout -->
                  <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="text-error"
                  >
                    logout
                  </Link>
                </li>
              </ul>
            </details>
          </li>
        </template>
        <template v-else>
          <li>
            <Link :href="route('welcome')">home</Link>
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
