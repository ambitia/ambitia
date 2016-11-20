<?php namespace Ambitia\Http\Routing\Contracts;


interface RouteContract
{
    function getMethod() : string;

    function getName() : string;

    function getUri() : string;

    function getCallback() : array;
}