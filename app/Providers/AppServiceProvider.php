<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            // application details
            $APP_data = (object)[];
            $APP_data->APP__name = 'Wevouch Admin';
            $APP_data->EMP_ID_PREFIX = 'PFSL';
            $APP_data->genderList = ['Male', 'Female', 'Transgender', 'Rather not say'];
            $APP_data->namePrefix = ['Mr', 'Miss', 'Mrs', 'Prof', 'Dr', 'CA'];
            $APP_data->maritalStatus = ['Married', 'Unmarried', 'Single', 'Divorced', 'Widowed'];

            // notification
            $notification = [];
            $notiTableExists = Schema::hasTable('notifications');

            if ($notiTableExists) {
                if ($user = Auth::user()) {
                    $notification = Notification::where('receiver_id', $user->id)->latest()->get();
                    $unreadCount = 0;
                    foreach($notification as $index => $noti) {
                        if ($noti->read_flag == 0) {
                            $unreadCount++;
                        }
                    }
                    $notification->unreadCount = $unreadCount;
                }
            }

            view()->share('APP_data', $APP_data);
            view()->share('notification', $notification);
        });

        Paginator::useBootstrap();
    }
}
