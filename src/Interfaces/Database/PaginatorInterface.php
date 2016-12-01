<?php

namespace Ambitia\Interfaces\Database;


interface PaginatorInterface
{
    /**
     * Paginate internal list of records. Passing in $dataModelClass will map records onto
     * instance of such class by setters or direct property assignment
     *
     * @param string $dataModelClass
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function paginate(string $dataModelClass = null, int $page = 1, int $perPage = 20): array;
}