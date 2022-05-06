<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
  topics: Array,
});
</script>



<template>
  <Head title="Topics" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end m-2 p-2">
          <Link
            href="/topics/create"
            class="
              px-4
              py-2
              bg-indigo-500
              hover:bg-indigo-600
              text-white
              rounded
            "
            >Create</Link
          >
        </div>
        <table class="table-auto" border="1">
          <thead class="font-bold bg-gray-300 border-b-2">
            <td class="px-4 py-2">ID</td>
            <td class="px-4 py-2">Name</td>
            <td class="px-4 py-2">Description</td>
            <td class="px-4 py-2">Images</td>
            <td class="px-4 py-2">Edit</td>
            <td class="px-4 py-2">Delete</td>
          </thead>
          <tbody>
            <tr v-for="topic in topics" :key="topic.id">
              <td
                class="
                  px-6
                  py-4
                  whitespace-no-wrap
                  text-sm
                  leading-5
                  text-gray-900
                "
              >
                {{ topic.id }}
              </td>
              <td>{{ topic.name }}</td>
              <td>{{ topic.description }}</td>
              <td>
                <div class="flex flex-wrap justify-center">
                  <div class="w-6/12 sm:w-4/12 px-4">
                    <img
                      :src="topic.images"
                      alt="..."
                      class="
                        shadow
                        rounded-full
                        max-w-full
                        h-auto
                        align-middle
                        border-none
                      "
                    />
                  </div>
                </div>
              </td>
              <td>
                <Link
                  :href="`/topics/${topic.id}/edit`"
                  class="
                    px-4
                    py-2
                    bg-green-500
                    hover:bg-green-600
                    text-white
                    rounded
                  ">
                  Edit
                </Link>
                </td>
                <td>
                <Link
                  :href="`/topics/${topic.id}`" method="delete" as="button" type="button"
                  class="
                    px-4
                    py-2
                    bg-red-500
                    hover:bg-red-600
                    text-white
                    rounded
                  ">Delete</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

