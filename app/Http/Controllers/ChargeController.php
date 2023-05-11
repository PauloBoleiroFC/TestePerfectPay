<?php

namespace App\Http\Controllers;

use App\Services\AsaasService;
use App\Services\ChargeService;

class ChargeController extends Controller
{

    /**
     * @var AsaasService
     */
    protected $chargeService;

    /**
     * @param ChargeService $chargeService
     */
    public function __construct(ChargeService $chargeService)
    {
        $this->chargeService = $chargeService;
    }

    /**
     * @return mixed
     */
    public function newCharge()
    {
        return $this->chargeService->newCharge();
    }
}
