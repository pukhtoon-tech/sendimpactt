<?php

namespace App\Http;

use App\Http\Middleware\checkApiKey;
use App\Http\Middleware\InstallCheck;
use App\Http\Middleware\Installed;
use App\Http\Middleware\Language;
use App\Http\Middleware\SaasCheck;
use App\Http\Middleware\SaasCheckExpiry; // 5.0.0
use App\Http\Middleware\SaasEmailLimitCheck; // 5.0.0
use App\Http\Middleware\SaasSmsLimitCheck; // 5.0.0
use App\Http\Middleware\SaasUserRestriction; // 5.0.0
use App\Http\Middleware\SetConfigs; // 5.0.0
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            Language::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'loggedin' => \App\Http\Middleware\LoggedIn::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'email.verified' => \App\Http\Middleware\VerificationMiddleware::class,
        'install.check' => InstallCheck::class,
        'installed' => Installed::class,
        'mail.config' => SetConfigs::class,
        'check.api' => checkApiKey::class,
        'check.saas' => SaasCheck::class,
        'saas.user.restriction' => SaasUserRestriction::class,
        'saas.expiry' => SaasCheckExpiry::class,
        'saas.email.limit.check' => SaasEmailLimitCheck::class,
        'saas.sms.limit.check' => SaasSmsLimitCheck::class,
    ];
}
