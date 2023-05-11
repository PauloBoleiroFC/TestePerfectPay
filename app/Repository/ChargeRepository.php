<?php

namespace App\Repository;

use App\Models\Charge;
use Illuminate\Support\Facades\Auth;

class ChargeRepository
{

    protected $model;

    /**
     * @param Charge $model
     */
    public function __construct(Charge $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->where('user_id', Auth::user()->id)->get();
    }

    /**
     * @param Int $id
     * @param Int $asaas_id
     * @return mixed
     */
    public function updateCharge(Int $id, String $asaas_id)
    {
        return $this->model
            ->find($id)
            ->update(['asaas_id' => $asaas_id]);
    }

    /**
     * @param Int $id
     * @return mixed
     */
    public function getCharge(Int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @return mixed
     */
    public function newCharge()
    {

        $data = [
            'user_id' => Auth::user()->id,
            'value'   => rand(100, 999),
            'status'  => 'PENDING',
            'dueDate' => date('Y-m-d', strtotime('+5 days', strtotime(date('Y-m-d'))))
        ];

        return $this->model->create($data);
    }

}
