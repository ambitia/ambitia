<?php namespace Ambitia\Http\Routing;

use Ambitia\Http\Routing\Contracts\DispatcherResult;
use Ambitia\Http\Routing\Contracts\RouteMatcher;
use Ambitia\Http\Routing\Exceptions\ClassNotFound;
use Ambitia\Http\Routing\Exceptions\HttpMethodNotAllowed;
use Ambitia\Http\Routing\Exceptions\HttpNotFound;
use Ambitia\Http\Routing\Exceptions\MethodNotFound;
use Ambitia\Output\Contracts\ResponseContract;

class MatchRoute implements RouteMatcher
{

    /**
     * @inheritDoc
     */
    public function match(DispatcherResult $result, ResponseContract $response) : ResponseContract
    {
        switch ($result->getStatus()) {
            case $result::METHOD_NOT_ALLOWED:
                throw new HttpMethodNotAllowed($result->getMethod());

            case $result::FOUND:
                $handler = $result->getHandler();

                $class = $this->checkClassExistance($handler[0]);
                $entry = new $class();
                $method = $this->checkMethodExistance($entry, $handler[1], $class);

                $data = call_user_func_array([$entry, $method], $result->getParams());
                $response->setData($data);

                return $response;

            case $result::NOT_FOUND:
            default:
                throw new HttpNotFound();
        }
    }

    /**
     * Check if class exists
     * @param string $class
     * @return string
     * @throws ClassNotFound
     */
    protected function checkClassExistance(string $class) : string
    {
        if (empty($class) || !class_exists($class)) {
            throw new ClassNotFound($class);
        }

        return $class;
    }

    /**
     * Check if method exists
     * @param object $entry
     * @param string $method
     * @param string $class
     * @return string
     * @throws MethodNotFound
     */
    protected function checkMethodExistance(object $entry, string $method, string $class) : string
    {
        if (empty($method) || !method_exists($entry, $method)) {
            throw new MethodNotFound($class, $method);
        }

        return $method;
    }
}
