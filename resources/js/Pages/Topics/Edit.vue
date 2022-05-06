<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
  topic: Object,
  images: String,
  description: String,
  name: String,
});

const form = useForm({
  name: props.topic.name,
  description: props.topic.description,
  images: null,
});

function UpdateTopic() {
  Inertia.post(`/topics/${props.topic.id}`, {
    _method: "put",
    name: form.name,
    description: form.description,
    images: form.images,
  })
}

</script>



<template>
  <Head title="Edit" />

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
        <form @submit.prevent="UpdateTopic">
          <div>
            <label for="title">Title</label>
            <input
              type="text"
              name="name"
              id="name"
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
              id="description"
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
            <div v-bind="form.images">
              <div class="m-2 p-2">
                <img :src="topic.images" class="w-full" />
              </div>
            </div>
            <input id="images" type="file" @input="form.images = $event.target.files[0]" />
          </div>

          <!-- submit -->
          <div class="flex items-center mt-4">
            <button class="px-6 py-2 text-white bg-gray-900 rounded">
              Update
            </button>
          </div>
        </form>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

