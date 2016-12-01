<?php

namespace Ambitia\Interfaces\Database;


interface ResourceInterface
{
    public function all(array $columns = ['*']);

    public function find(int $id, array $columns = ['*']);

    public function findBy(array $conditions, array $columns = ['*']);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}