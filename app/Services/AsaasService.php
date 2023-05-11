<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AsaasService
{

    /**
     * @param String $id
     * @return array|null
     */
    public function getCustomer(String $id)
    {
        return $this->APIcurl([], 'customers/'.$id);
    }

    /**
     * @return array|null
     */
    public function getCharges()
    {
        return $this->APIcurl([],'payments');
    }

    /**
     * @param array $payload
     * @return array|null
     */
    public function newCharge(Array $payload)
    {

        return $this->APIcurl($payload, 'payments', "post");
    }

    /**
     * @return array|null
     */
    public function newCustomer()
    {

        $params = [
            'name' => Auth::user()->name,
            'cpfCnpj' => Auth::user()->cpf
        ];

        return $this->APIcurl($params, 'customers', "post");
    }

    /**
     * @param String $id
     * @return array|null
     */
    public function getBarCode(String $id)
    {

        return $this->APIcurl([],"payments/$id/identificationField");
    }

    /**
     * @param String $id
     * @return array|null
     */
    public function pixQrCode(String $id)
    {

        return $this->APIcurl([],"payments/$id/pixQrCode");
    }






    /**
     * @param array $params
     * @param String $endpiont
     * @param $type
     * @return void
     */
    public function APIcurl(Array $params, String $endpiont, $type = "get")
    {

        $ch = curl_init('https://sandbox.asaas.com/api/v3/'.$endpiont);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'access_token: ' . env('ASAAS_ACCESS_TOKEN'),
            'wallet_id: ' . env('ASAAS_WALLET_ID')
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $ch , CURLOPT_FOLLOWLOCATION , 1 );

        if($type == "post") {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ['response' => $response, 'code' => $httpcode, 'message' => $this->httpResponse($httpcode)];
    }

    /**
     * @param Int $code
     * @return string|void
     */
    protected function httpResponse(Int $code)
    {
        switch ($code){
            case 200 :
                return "OK	Sua requisição foi bem sucedida.";
                break;
            case 400 :
                return "Bad Request	Algum parâmetro obrigatório não foi enviado ou é inválido. Neste caso a própria resposta indicará qual é o problema.";
                break;
            case 401 :
                return "Unauthorized	Não foi enviada API Key ou ela é inválida.";
                break;
            case 404 :
                return "Not Found	O endpoint ou o objeto solicitado não existe.";
                break;
            case 403 :
                return "Forbidden	Requisição não autorizada. Abuso da API ou uso de parâmetros não permitidos podem gerar este código.";
                break;
            case 429 :
                return "Too Many Requests	Muitos pedidos em um determinado período de tempo. Mais em nossa seção sobre Rate Limiting.";
                break;
            case 500 :
                return "Internal Server Error	Algo deu errado no servidor do Asaas.";
                break;
            default:
                return "Erro interno";
        }

    }

}
