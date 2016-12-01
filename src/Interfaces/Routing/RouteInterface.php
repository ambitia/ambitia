<?php namespace Ambitia\Interfaces\Routing;


interface RouteInterface
{
    function getMethod() : string;

    function getName() : string;

    function getUri() : string;

    function getCallback() : array;
}