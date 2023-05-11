<?php

namespace App\Services;

use App\Repository\ChargeRepository;

class ChargeService
{

    protected $chargeRepository;

    /**
     * @param ChargeRepository $chargeRepository
     */
    public function __construct(ChargeRepository $chargeRepository)
    {
        return $this->chargeRepository = $chargeRepository;
    }

    /**
     * @param Int $id
     * @return mixed
     */
    public function getAll()
    {
        return $this->chargeRepository->getAll();
    }

    /**
     * @param Int $id
     * @param Int $asaas_id
     * @return mixed
     */
    public function updateCharge(Int $id, String $asaas_id)
    {
        return $this->chargeRepository->updateCharge($id, $asaas_id);
    }

    /**
     * @param Int $id
     * @return mixed
     */
    public function getCharge(Int $id)
    {
        return $this->chargeRepository->getCharge($id);
    }

    /**
     * @return mixed
     */
    public function newCharge()
    {
        return $this->chargeRepository->newCharge();
    }



}
