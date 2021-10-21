<template>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li v-for="(link, k) in links" :key="k" class="page-item" :class="[link.url ? '' : 'disabled', link.active ? 'active' : '']">
                <Link class="page-link" :href="link.url" v-html="link.label"></Link>
            </li>
        </ul>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link,
    },

    props: {
        links: Array,
    },
}
</script>
