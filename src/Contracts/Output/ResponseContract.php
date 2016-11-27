<?php

namespace Ambitia\Contracts\Output;


interface ResponseContract
{
    /**
     * Send response to the application consumer
     *
     * @return void
     */
    public function send();

    /**
     * Set data to be used in construction of the response
     *
     * @param mixed $data
     * @return void
     */
    public function setData($data);
}