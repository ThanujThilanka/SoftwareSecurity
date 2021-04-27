<?php

namespace App\Services;

use App\Services\Interfaces\IService;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService implements IService
{
    // protected $repo;

    public function checkAuthenticate($id): Model
    {
        $model = $this->repo->getDataById($id);

        if (!$model->exists) abort(404, "Not Found");
        if ($model->user_id != request()->user()->id) abort(403, "Unauthorized action");

        return $model;
    }

    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
