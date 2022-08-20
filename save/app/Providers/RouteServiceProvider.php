<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * If specified, this namespace is automatically applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = null;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/default.php'));

            Route::middleware('web')
                ->group(base_path('routes/email.php'));

            Route::middleware('web')
                ->group(base_path('routes/campaign.php'));

            Route::middleware('web')
                ->group(base_path('routes/group.php'));

            Route::middleware('web')
                ->group(base_path('routes/builder.php'));

            Route::middleware('web')
                ->group(base_path('routes/queue.php'));

            Route::middleware('web')
                ->group(base_path('routes/log.php'));

            Route::middleware('web')
                ->group(base_path('routes/report.php'));

            Route::middleware('web')
                ->group(base_path('routes/sms.php'));

            Route::middleware('web')
                ->group(base_path('routes/subscription.php'));

            Route::middleware('web')
                ->group(base_path('routes/paypal.php'));

            Route::middleware('web')
                ->group(base_path('routes/stripe.php'));

            Route::middleware('web')
                ->group(base_path('routes/limit.php'));

            Route::middleware('web')
                ->group(base_path('routes/notes.php'));

            Route::middleware('web')
                ->group(base_path('routes/currency.php'));

            Route::middleware('web')
                ->group(base_path('routes/bounce.php'));

            Route::middleware('web')
                ->group(base_path('routes/campaignlog.php'));

            Route::middleware('web')
                ->group(base_path('routes/notify.php'));

            Route::middleware('web')
                ->group(base_path('routes/frontend.php'));

            Route::middleware('web')
                ->group(base_path('routes/install.php'));

            Route::middleware('web')
                ->group(base_path('routes/tracker.php'));

            Route::middleware('web')
                ->group(base_path('routes/voice.php'));

            Route::middleware('web')
                ->group(base_path('routes/autoresponder.php'));

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }
}
