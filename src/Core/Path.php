<?php namespace Ambitia\Core;

use Ambitia\Interfaces\Core\PathInterface;

class Path implements PathInterface
{
    /**
     * @inheritDoc
     */
    public function basePath(): string
    {
        return ROOT_DIR;
    }
}