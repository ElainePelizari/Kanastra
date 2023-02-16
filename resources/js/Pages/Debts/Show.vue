<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import moment from 'moment';

defineProps({
    debtsResponses: Array
});

const convertTicket = (status_ticket) => {
    if (status_ticket === 0) {
        return status_ticket = 'Boleto não gerado'
    } else {
        return status_ticket = 'Boleto gerado';
    }
};

const convertStatusPayment = (paid) => {
    if (paid === 0) {
        return paid = 'Dívida em aberto'
    } else {
        return paid = 'Dívida paga';
    }
};

const converToDate = (debtDueDate) => {
    moment.locale('pt-br');
    var newData = moment(debtDueDate).format('DD-MM-YYYY')
    return newData;
};

</script>

<template>
    <AppLayout title="History">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dívidas importadas
            </h2>

            <div class="mt-6 text-gray-500">
                Dívidas que já foram importadas para o sistema.
            </div>
        </template>

        <div class="mt-10">
            <div class="bg-white border-b border-gray-200" style="padding: 44px 332px; align-items: center;">
                <table v-if="debtsResponses.length" class="items-center bg-white w-full border-collapse">
                    <thead style="">
                        <tr class="px-6 py-3 text-xs uppercase text-center">
                            <th> Id </th>
                            <th> Número da Dívida </th>
                            <th> Nome </th>
                            <th> CPF </th>
                            <th> E-mail </th>
                            <th> Valor da dívida </th>
                            <th> Data da dívida </th>
                            <th> Status do boleto </th>
                            <th> Boleto pago </th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center">
                        <tr v-for="response in debtsResponses" :key="response.id">
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{response.id}}
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{response.debtId}}
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{response.name}}
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{response.cpf}}
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{response.email}}
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{response.debtAmount}}
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{converToDate(response.debtDueDate)}}
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{convertTicket(response.status_ticket)}}
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{convertStatusPayment(response.paid)}}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else class="mt-6 text-gray-500">
                    <p>Nenhuma divida importada no sistema, acesse o menu importar arquivo!</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>