<template>
    <Head title="Modifier un livre" />

    <breeze-authenticated-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Modifier un livre
            </h2>
        </template>

        <Link :href="route('books.index')" class="btn btn-primary mb-2">Retour</Link>

        <form @submit.prevent="form.put(route('books.update', book))">
            <div class="row">
                <div class="col-12 col-lg-6 offset-0 offset-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <InputLabel
                                        v-model="form.title"
                                        :inputId="'inputTitle'"
                                        :labelText="'Titre'"
                                        :formError="form.errors.title"
                                    />
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-6">
                                        <InputLabel
                                            v-model="form.pages"
                                            :inputId="'inputPages'"
                                            :labelText="'Nombre de pages'"
                                            :formError="form.errors.pages"
                                        />
                                    </div>
                                    <div class="form-group col-6">
                                        <InputLabel
                                            v-model="form.quantity"
                                            :inputId="'inputQuantity'"
                                            :labelText="'Quantité'"
                                            :formError="form.errors.quantity"
                                        />
                                    </div>
                                </div>
                                <div class="form-group col-12 mt-3">
                                    <label for="exampleFormControlSelect1">Auteur</label>
                                    <select v-model="form.author_id" class="form-control" id="exampleFormControlSelect1">
                                        <option :value="null" selected>Auteur inconnu...</option>
                                        <option v-for="author in authors" :key="author.id" :value="author.id">
                                            {{ author.name}}
                                        </option>
                                    </select>
                                    <div v-if="form.errors.author_id">{{ form.errors.author_id}}</div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3" :disabled="form.processing">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, useForm, Link } from '@inertiajs/inertia-vue3'
import InputLabel from '@/Components/Form/InputLabel.vue'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        InputLabel,
    },

    props: ['book', 'authors'],

    data() {
        return {
            form: useForm({
                title: this.book.title,
                pages: this.book.pages,
                quantity: this.book.quantity,
                author_id: this.book.author_id,
            })
        }
    }
}
</script>
