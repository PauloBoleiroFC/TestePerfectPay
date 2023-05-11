<?php

function status($status)
{

    switch ($status){
        case 'PENDING' : return "Aguardando pagamento";break;
        case 'RECEIVED' : return "Recebida";break;
        case 'CONFIRMED' : return "Pagamento confirmado";break;
        case 'OVERDUE' : return "Vencida";break;
        case 'REFUNDED' : return "Estornada";break;
        case 'RECEIVED_IN_CASH' : return "Recebida em dinheiro";break;
        case 'REFUND_REQUESTED' : return "Estorno Solicitado";break;
        case 'REFUND_IN_PROGRESS' : return "Estorno em processamento";break;
        case 'CHARGEBACK_REQUESTED' : return "Recebido chargeback";break;
        case 'CHARGEBACK_DISPUTE' : return "Em disputa de chargeback";break;
        case 'AWAITING_CHARGEBACK_REVERSAL' : return "Disputa vencida, aguardando repasse da adquirente";break;
        case 'DUNNING_REQUESTED' : return "Em processo de negativação";break;
        case 'DUNNING_RECEIVED' : return "Recuperada";break;
        case 'AWAITING_RISK_ANALYSIS' : return "Pagamento em análise";break;
        default: return "Erro interno";
    }

}

function credidCardReturn($status)
{

    switch ($status){
        case 'PENDING' :
        return "Cobrança aguardando pagamento";break;

        case 'CONFIRMED' :
        return "Cobrança Confirmada (Somente para cartão de crédito)";break;

        case 'RECEIVED' :
        return "Cobrança Recebida";break;

        case 'RECEIVED_IN_CASH' :
        return "Cobrança Recebida em Dinheiro (não gera saldo)";break;

        case 'OVERDUE' :
        return "Cobrança Atrasada";break;

        case 'REFUND_REQUESTED' :
        return "Estorno Solicitado";break;

        case 'REFUND_IN_PROGRESS' :
        return "Estorno em processamento (liquidação já está agendada, cobrança será estornada após executar a liquidação)";break;

        case 'REFUNDED' :
        return "Cobrança Estornada";break;

        case 'CHARGEBACK_REQUESTED' :
        return "Recebido chargeback";break;

        case 'CHARGEBACK_DISPUTE' :
        return "Em disputa de chargeback (caso sejam apresentados documentos para contestação)";break;

        case 'AWAITING_CHARGEBACK_REVERSAL' :
        return "Disputa vencida, aguardando repasse da adquirente";break;

        case 'DUNNING_REQUESTED' :
        return "Em processo de negativação";break;

        case 'DUNNING_RECEIVED' :
        return "Recuperada";break;

        case 'AWAITING_RISK_ANALYSIS' :
        return "Pagamento em análise";break;

        default: return "Erro interno";
    }
}
