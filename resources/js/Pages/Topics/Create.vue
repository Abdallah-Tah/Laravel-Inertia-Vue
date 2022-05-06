<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
      name: null,
      description: null,
      images: null,
    })

    function StoreTopic() {
      form.post('/topics')
    }
</script>



<template>
  <Head title="Create" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end m-2 p-2">
          <Link
            href="/topics"
            class="
              px-4
              py-2
              bg-indigo-500
              hover:bg-indigo-600
              text-white
              rounded
            "
            >Back</Link
          >
        </div>
        <form @submit.prevent="StoreTopic">
          <div>
            <label for="title">Title</label>
            <input
              type="text"
              name="name"
              v-model="form.name"
              class="
                w-full
                px-4
                py-2
                mt-2
                border
                rounded-md
                focus:outline-none focus:ring-1 focus:ring-blue-600
              "
            />
          </div>
          <div class="mt-4">
            <label for="title">Description</label>
            <textarea
              name="description"
              type="text"
              v-model="form.description"
              class="
                w-full
                px-4
                py-2
                mt-2
                border
                rounded-md
                focus:outline-none focus:ring-1 focus:ring-blue-600
              "
            >
            </textarea>
          </div>

          <div>
            <label for="title">Image</label>
             <input type="file" @input="form.images = $event.target.files[0]" />
          </div>

          <!-- submit -->
          <div class="flex items-center mt-4">
            <button class="px-6 py-2 text-white bg-gray-900 rounded">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

