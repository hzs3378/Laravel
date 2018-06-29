<?php

namespace App\Listeners;

use App\Events\Ordershipped;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Log;
use Carbon\Carbon;
use App\Jobs\TranslateSlug;
use App\Jobs\SendReminderEmail;

class SendShipmentNotification
{
    /**
     * Create the event listener. 创建事件监听器
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event. 处理事件
     *
     * @param  Ordershipped  $event
     * @return void
     */
    public function handle(Ordershipped $event)
    {
        $user = $event->user;
//        DB::update('update users set name=? where id = ?', ['修改参数',10]);
        TranslateSlug::dispatch();
        SendReminderEmail::dispatch();
//        TranslateSlug::dispatch()->delay(Carbon::now()->addMinutes(1));


    }


}
