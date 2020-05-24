<?php

namespace App\Middleware;

class ValidationErrorMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {

        $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        $response = $next($request, $response);
        if (empty($_SESSION['errors'])){
            unset($_SESSION['errors']);
        }

        return $response;
    }
}