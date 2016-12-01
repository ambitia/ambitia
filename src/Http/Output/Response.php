<?php namespace Ambitia\Http\Output;

use Ambitia\Interfaces\Output\ResponseInterface;

class Response implements ResponseInterface
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