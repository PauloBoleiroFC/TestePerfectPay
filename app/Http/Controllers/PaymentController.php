<?php

namespace App\Http\Controllers;

use App\Services\AsaasService;
use App\Services\ChargeService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    //
    protected $asaasService;
    protected $chargeService;

    /**
     * @param AsaasService $asaasService
     */
    public function __construct(AsaasService $asaasService, ChargeService $chargeService)
    {
        $this->asaasService = $asaasService;
        $this->chargeService = $chargeService;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getBarCode($id)
    {

        $id = Crypt::decryptString($id);
        $charge = $this->chargeService->getCharge($id);

        // Gera novo boleto
        $payload = [
            'customer'    => Auth::user()->asaas_id,
            'billingType' => 'BOLETO',
            'value'       => $charge->value,
            'dueDate'     => $charge->dueDate
        ];
        $charge_asaas = $this->asaasService->newCharge($payload);
        $charge_asaas = json_decode($charge_asaas['response']);
        $charge_asaas_id = $charge_asaas->id;

        // Salva o id asaas no banco
        $this->chargeService->updateCharge($id, $charge_asaas->id);

        // Resgata código de barras
        $charge_asaas = $this->asaasService->getBarCode($charge_asaas_id);

        if($charge_asaas['code'] == 200){
            $barCode = json_decode($charge_asaas['response']);
            $barCode = $barCode->identificationField;

            $barCode_1 = substr($barCode, 0, 5);
            $barCode_2 = substr($barCode, 5, 5);
            $barCode_3 = substr($barCode, 10, 5);
            $barCode_4 = substr($barCode, 15, 6);
            $barCode_5 = substr($barCode, 21, 5);
            $barCode_6 = substr($barCode, 27, 6);
            $barCode_7 = substr($barCode, 28, 1);
            $barCode_8 = substr($barCode, 42, 14);

            $data['barCode'] = $barCode_1.'.'.$barCode_2.' '.$barCode_3.'.'.$barCode_4.' '.$barCode_5.'.'.$barCode_6.' '.$barCode_7.' '.$barCode_8;

        }else{
            $data['barCode'] = [];
        }

        return view('payments.bar_code', $data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function pix($id)
    {

        $id = Crypt::decryptString($id);
        $charge = $this->chargeService->getCharge($id);

        // Gera novo pix
        $payload = [
            'customer'    => Auth::user()->asaas_id,
            'billingType' => 'PIX',
            'value'       => $charge->value,
            'dueDate'     => $charge->dueDate
        ];
        $charge_asaas = $this->asaasService->newCharge($payload);
        $charge_asaas = json_decode($charge_asaas['response']);
        $charge_asaas_id = $charge_asaas->id;

        // Salva o id asaas no banco
        $this->chargeService->updateCharge($id, $charge_asaas->id);

        // Resgata QRCode
        $charge_asaas = $this->asaasService->pixQrCode($charge_asaas_id);

        if($charge_asaas['code'] == 200){
            $data['pixQrCode'] = json_decode($charge_asaas['response']);
        }else{
            $data['pixQrCode'] = [];
        }

        return view('payments.pix', $data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function creditCard($id)
    {
        $data['id'] = $id;
        return view('payments.credit_card', $data);
    }

    public function pay(Request $request)
    {

        // Recupera cobrança
        $id = Crypt::decryptString($request->id);
        $charge = $this->chargeService->getCharge($id);

        $expire = explode('/', $request->expiry);

        $payload = [
            'customer'    => Auth::user()->asaas_id,
            'billingType' => 'CREDIT_CARD',
            'value'       => $charge->value,
            'dueDate'     => $charge->dueDate,

            'creditCard' => array(
                'holderName'  => $request->holderName,
                'number'      => $request->number,
                'expiryMonth' => $expire[0],
                'expiryYear'  => $expire[1],
                'ccv'         => $request->ccv,
            ),

            'creditCardHolderInfo' => array(
                'name'              => $request->ccv,
                'email'             => $request->email,
                'cpfCnpj'           => $request->cpfCnpj,
                'postalCode'        => $request->postalCode,
                'addressNumber'     => $request->addressNumber,
                'addressComplement' => '',
                'phone'             => $request->phone,
                'mobilePhone'       => '',
            ),

            'remoteIp' => $_SERVER['REMOTE_ADDR']
        ];

        // Gera novo Cartão de crédito
        $charge_asaas = $this->asaasService->newCharge($payload);
        if($charge_asaas['code'] == 200){
            $charge_asaas = json_decode($charge_asaas['response']);

            // Salva o id asaas no banco
            $this->chargeService->updateCharge($id, $charge_asaas->id);

            return json_encode(credidCardReturn($charge_asaas->status));

        }else{
            $charge_asaas = json_decode($charge_asaas['response']);

            return json_encode(credidCardReturn($charge_asaas->errors[0]->description));
        }


    }


}
