<?php

namespace App\Services;

use App\Repository\UserRepository;

class UserService
{

    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        return $this->userRepository = $userRepository;
    }

    /**
     * @param Int $id
     * @return mixed
     */
    public function updateAsaasId(Int $id)
    {
        return $this->userRepository->updateAsaasId($id);
    }


}
