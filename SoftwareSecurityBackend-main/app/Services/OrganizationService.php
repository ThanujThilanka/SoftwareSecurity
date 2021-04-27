<?php

namespace App\Services;

use App\Repositories\OrganizationRepository;

class OrganizationService
{

    protected $repo;

    public function __construct(OrganizationRepository $repo)
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

    public function search($id)
    {
        $json = $this->repo->search($id);
        return response()->json($json);

    }

}
