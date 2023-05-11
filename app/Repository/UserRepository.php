<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param Int $id
     * @return mixed
     */
    public function updateAsaasId(Int $id)
    {
        return $this->model
            ->where('id', Auth::user()->id)
            ->update(['asaas_id' => $id]);
    }

}
