<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IRepository;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements IRepository
{
    protected $model;

    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $result = $this->model->find($id);
        $result->update($data);

        return $result;
    }

    public function delete(int $id): bool
    {
        $result = $this->model->find($id);
        if (!$result) return false;
        return $result->delete();
    }

    public function getDataById(int $id): Model
    {
        $model = $this->model->find($id);
        if (!$model) return $this->model;

        return $model;
    }
}
