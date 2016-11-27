<?php namespace Ambitia\Http\Input\Symfony;

use Ambitia\Contracts\Input\HttpRequestContract;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest implements HttpRequestContract
{

    /**
     * @inheritDoc
     */
    public function input() : array
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
    public function getPathInfo() : string
    {
        $pathInfo = parent::getPathInfo();

        return substr($pathInfo, 1);
    }

    /**
     * Get HTTP method called
     * @return string
     */
    public function getMethod() : string
    {
        return parent::getMethod();
    }
}