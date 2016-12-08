<?php

namespace Ambitia\Interfaces\Core;


interface PathInterface
{
    /**
     * Get the fully qualified base path to the application
     *
     * @return string
     */
    public function basePath(): string;
}