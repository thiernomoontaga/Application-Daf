<?php

namespace App\Core\Abstract;

interface IRepository
{
    public function findAll(array $filters): array;
    public function insert($entity): ?int;
    // public function update(int $id, array $data): bool;
    // public function delete(int $id): bool;
}
