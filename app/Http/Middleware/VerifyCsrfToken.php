<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'webhook*',
        'upload-image',
		'update-system-pro',
		'update-company-fins',
		 '/log-visit',
		  'log-visit',
		  '/update-lead',
		  'update-lead',
		 'api/*'
    ];
}
