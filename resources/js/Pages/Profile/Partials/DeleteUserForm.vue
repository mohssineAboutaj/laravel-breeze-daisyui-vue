<script setup>
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const title = "Delete Account";

const form = useForm({
  password: "",
});

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true;

  nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
  form.delete(route("profile.destroy"), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  confirmingUserDeletion.value = false;

  form.reset();
};
</script>

<template>
  <h1 class="card-title">{{ title }}</h1>

  <p>
    Once your account is deleted, all of its resources and data will be
    permanently deleted. Before deleting your account, please download any data
    or information that you wish to retain.
  </p>

  <button class="btn btn-error btn-block" onclick="my_modal_1.showModal()">
    Delete Account
  </button>

  <dialog id="my_modal_1" class="modal">
    <form method="dialog" class="modal-box">
      <h3 class="font-bold text-lg">
        Are you sure you want to delete your account? s
      </h3>
      <p class="py-4">
        Once your account is deleted, all of its resources and data will be
        permanently deleted. Please enter your password to confirm you would
        like to permanently delete your account.
      </p>

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
          ref="passwordInput"
          @keyup.enter="deleteUser"
        />
        <label class="label">
          <span class="label-text-alt">{{ form.errors.password }}</span>
        </label>
      </div>

      <div class="modal-action justify-between flex">
        <button
          class="btn btn-error"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="deleteUser"
        >
          Delete
        </button>

        <button class="btn btn-warning btn-outline">Close</button>
      </div>
    </form>
  </dialog>
</template>
