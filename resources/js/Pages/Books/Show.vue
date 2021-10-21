<template>
    <Head title="Afficher un livre" />

    <breeze-authenticated-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Afficher un livre
            </h2>
        </template>

        <Link :href="route('books.index')" class="btn btn-primary mb-2">Retour</Link>

        <div class="row">
            <div class="col-12 col-lg-6 offset-0 offset-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <strong>Titre :</strong>
                                {{ book.title }}
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-6">
                                    <strong>Nombre de pages :</strong>
                                    {{ book.pages }}
                                </div>
                                <div class="form-group col-6">
                                    <strong>Quantité :</strong>
                                    {{ book.quantity }}
                                </div>
                            </div>
                            <div class="form-group col-12 mt-3">
                                <strong>Auteur :</strong>
                                {{ book.author?.name ?? 'Auteur manquant...' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },

    props: ['book']
}
</script>
