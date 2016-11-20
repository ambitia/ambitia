<?php namespace Ambitia\Input\Http\Symfony;

use Ambitia\Input\Contracts\RequestContract;
use Ambitia\Input\Http\Contracts\HttpRequest;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest implements RequestContract, HttpRequest
{

    /**
     * @inheritDoc
     */
    function input() : array
    {
        return array_merge(
            $this->query->all(),
            $this->request->all()
        );
    }

    /**
     * Url without domain, beginning slash and query string
     * @return string
     */
    function getPathInfo() : string
    {
        $pathInfo = parent::getPathInfo();

        return substr($pathInfo, 1);
    }

    /**
     * Get HTTP method called
     * @return string
     */
    function getMethod() : string
    {
        return parent::getMethod();
    }
}