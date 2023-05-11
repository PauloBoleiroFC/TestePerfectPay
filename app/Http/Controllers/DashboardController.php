<?php

namespace App\Http\Controllers;

use App\Services\AsaasService;
use App\Services\ChargeService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    protected $asaasService;
    protected $userService;
    protected $chargeService;
    /**
     * @param AsaasService $asaasService
     */
    public function __construct(AsaasService $asaasService, UserService $userService, ChargeService $chargeService)
    {
        $this->asaasService = $asaasService;
        $this->userService = $userService;
        $this->chargeService = $chargeService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        // Cadastra cliente se não existir
        if(isset(Auth::user()->asaas_id)){
            $customer = $this->asaasService->getCustomer(Auth::user()->asaas_id);
        }else{
            $customer = $this->asaasService->newCustomer();
            $customer_id = str_replace("cus_", "", json_decode($customer['response'])->id);
            $this->userService->updateAsaasId($customer_id);
        }

        $data['charges'] = $this->chargeService->getAll();

        return view('dashboard', $data);
    }

}
