<template>
    <Head title="Liste des livres" />

    <breeze-authenticated-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Liste des livres
            </h2>
        </template>

        <Link :href="route('books.create')" class="btn btn-primary mb-2">Ajouter un livre</Link>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Pages</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Author</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in books.data" :key="book.id">
                    <td>{{book.title}}</td>
                    <td>{{book.pages}}</td>
                    <td>{{book.quantity}}</td>
                    <td>{{book.author?.name ?? "Auteur manquant..."}}</td>
                    <td>
                        <Link :href="route('books.show', book.id)" class="btn btn-info"><i class="bi bi-arrow-right-circle"></i></Link>
                        <Link :href="route('books.edit', book.id)" class="btn btn-primary"><i class="bi bi-pencil"></i></Link>
                        <button @click="destroy(book.id)" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

        <Pagination class="mt-6" :links="books.links" />
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Pagination from '@/Components/Pagination.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Pagination,
        Head,
        Link,
    },
    props: ['books'],
    methods: {
        destroy(id) {
            Inertia.delete(route("books.destroy", id));
        },
    }
}
</script>

<style>

</style>
