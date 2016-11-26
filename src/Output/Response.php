<?php namespace Ambitia\Output;

use Ambitia\Contracts\Output\ResponseContract;

class Response implements ResponseContract
{

    protected $data;

    /**
     * @inheritDoc
     */
    public function send()
    {
        echo $this->data;
    }

    /**
     * @inheritDoc
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}