<?php namespace Ambitia\Output;

use Ambitia\Output\Contracts\ResponseContract;

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