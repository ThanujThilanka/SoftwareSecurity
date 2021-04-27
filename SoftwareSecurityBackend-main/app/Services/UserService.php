<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{

    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;

    }

    public function index()
    {
        $json = $this->repo->json();

        return response()->json($json);

    }

    public function searchByOrganizationId($id)
    {
        $json = $this->repo->searchByOrganizationId($id);
        return response()->json($json);

    }

    public function search($name)
    {
        $json = $this->repo->search($name);
        return response()->json($json);

    }

}
