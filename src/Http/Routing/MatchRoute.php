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
            case $result::NOT_FOUND:
                throw new HttpNotFound();
                break;
            case $result::METHOD_NOT_ALLOWED:
                throw new HttpMethodNotAllowed($result->getMethod());
                break;
            case $result::FOUND:
                $handler = $result->getHandler();
                $class = !empty($handler[0]) ? $handler[0] : '';
                $method = !empty($handler[1]) ? $handler[1] : '';

                if (empty($class) || !class_exists($class)) {
                    throw new ClassNotFound($class);
                }
                $entry = new $class();
                if (empty($method) || !method_exists($entry, $method)) {
                    throw new MethodNotFound($class, $method);
                }

                $data = call_user_func_array([$entry, $method], $result->getParams());
                $response->setData($data);

                return $response;
        }
    }
}