<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Booking\CreateBookingEvent' => [
            'App\Listeners\CreateBookingListener',
        ],
        'App\Events\Booking\SendInvoiceBookingEvent' => [
            'App\Listeners\SendInvoiceBookingListener',
        ],
        'App\Events\Booking\SendVoucherBookingEvent' => [
            'App\Listeners\SendVoucherBookingListener',
        ],
        'App\Events\PayPal\PayPalNotificationSuccessPaymantEvent' => [
            'App\Listeners\PayPal\SendNotificationSuccessAdminListener',
            'App\Listeners\PayPal\SendNotificationSuccessCustomerListener',
        ],
        'App\Events\Contact\SendContactEvent' => [
            'App\Listeners\Contact\SendContactAdminListener',
            'App\Listeners\Contact\SendContactMemberListener',
        ],
        'App\Events\Bandung\PayoutEvent' => [
            'App\Listeners\Bandung\SendInvoiceAdminListener',
            'App\Listeners\Bandung\SendInvoiceTeamBandungListener',
        ],
        'App\Events\Bandung\VerificationEvent' => [
            'App\Listeners\Bandung\SendInvoicePaidAdminListener'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
