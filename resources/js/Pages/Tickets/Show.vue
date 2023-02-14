<script setup>
import { useForm } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    file: null,
})

function submit() {
    form.post('/upload')
}
</script>

<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

            <div class="mt-8 text-2xl">
                Importação de arquivos
            </div>

            <div class="mt-6 text-gray-500">
                Aqui você irá importar seu arquivo CSV para que possamos gerar o seu boleto!
            </div>

            <form @submit.prevent="submit">
                <div class="mt-10">
                    <input
                        type="file"
                        ref="file"
                        @input="form.file = $event.target.files[0]"
                    >
                </div>

                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>

                <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Enviar
                </PrimaryButton>
            </form>
        </div>
    </div>
</template>
