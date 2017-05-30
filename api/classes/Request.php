<?php

class Request
{

    public $requestUri = $_SERVER['REQUEST_URI'];
    public $request_method = $_SERVER['REQUEST_METHOD'];

}