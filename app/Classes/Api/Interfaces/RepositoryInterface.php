<?php

namespace App\Classes\Api\Interfaces;

interface RepositoryInterface
{
    public function get($id);
    public function all(array $data);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}