<template>
    <markdown-editor v-model="form.body" ref="markdownEditor"></markdown-editor>
</template>

<script>
    import markdownEditor from 'vue-simplemde/src/markdown-editor'

    export default {
        components: {
            markdownEditor
        }
    }
</script>

<style>
    @import '~simplemde/dist/simplemde.min.css';
</style>