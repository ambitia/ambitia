<?php

namespace Ambitia\Contracts\Output;


interface ResponseContract
{
    /**
     * Send response to the application consumer
     * @return void
     */
    public function send();

    /**
     * @param mixed $data
     * @return void
     */
    public function setData($data);
}