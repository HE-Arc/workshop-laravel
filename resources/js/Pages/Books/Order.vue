<template>
    <Head title="Listes des livres à commandés" />

    <breeze-authenticated-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Listes des livres à commandés
            </h2>
        </template>

        <Link :href="route('books.index')" class="btn btn-primary mb-2">Retour</Link>

        <p>Les livres affichés dans cette liste sont à commandés (leur quantité est inférieur ou égale à 0).</p>

        <div v-if="books.data.length > 0" >
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Pages</th>
                        <th scope="col">Auteur</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="book in books.data" :key="book.id">
                        <td>{{book.title}}</td>
                        <td>{{book.pages}}</td>
                        <td>{{book.author?.name ?? "Auteur manquant..."}}</td>
                    </tr>
                </tbody>
            </table>

            <Pagination class="mt-6" :links="books.links" />
        </div>
        <h3 v-else class="text-success">Aucun livre n'a besoin d'être commandés pour l'instant!</h3>

    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Pagination from '@/Components/Pagination.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Pagination,
        Head,
        Link,
    },

    props: ['books']
}
</script>
