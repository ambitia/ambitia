<?php

namespace Ambitia\Contracts\Database;


interface PaginableContract
{
    public function paginate(int $page = 1, int $perPage = 20, array $columns = ['*']);
}