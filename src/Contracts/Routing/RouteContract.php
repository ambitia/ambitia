<?php namespace Ambitia\Contracts\Routing;


interface RouteContract
{
    function getMethod() : string;

    function getName() : string;

    function getUri() : string;

    function getCallback() : array;
}