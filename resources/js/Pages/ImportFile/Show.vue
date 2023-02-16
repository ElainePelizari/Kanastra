<script setup>
import { useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import InputError from '@/Components/InputError.vue';

const form = useForm({
    file: null,
})

const uploadFile = () => {
    form.post('/upload'), {        
        onSuccess: () => {
            file = null
            form.reset();
            form.clearErrors();
        },
        onError: () => (errors) => {
            window.Toast.error(errors.create)
        }
    }
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

            <form @submit.prevent="uploadFile">
                <div class="mt-10">
                    <input 
                        enctype="multipart/form-data"
                        type="file"
                        ref="file"
                        @input="form.file = $event.target.files[0]"
                    >
                    <InputError v-if="form.errors" :message="form.errors.create" class="mt-2" />
                </div>

                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>

                <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                    Arquivo enviado, logo os dados da dívida estarão disponíveis.
                </ActionMessage>

                <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Enviar
                </PrimaryButton>
            </form>
        </div>
    </div>
</template>
