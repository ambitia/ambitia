<?php namespace Ambitia\Example\Test;

use Ambitia\Output\Response;

class IndexEntry
{
    public function index()
    {
        $response = new Response();
        $response->setData('Hello world');

        return $response->send();
    }
}