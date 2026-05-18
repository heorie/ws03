<?php

namespace App\Controllers;

class ErrorController
{
    public static function notFound(string $message = 'The page you requested could not be found.'): void
    {
        http_response_code(404);
        loadView('error', [
            'status'  => '404 — Not Found',
            'message' => $message,
        ]);
    }

    public static function notAuthorized(string $message = 'You are not authorized to access this resource.'): void
    {
        http_response_code(403);
        loadView('error', [
            'status'  => '403 — Forbidden',
            'message' => $message,
        ]);
    }
}
