<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
//        Log::info('初始化成功！');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        Log::info('判断！');
        DB::update('update users set ord=? where id = ?', ['双任务1', 1]);
//        for($i=1;$i<500;$i++){
//            DB::update('update users set ord=? where id = ?', ['队列修改'.$i, $i]);
//        }
    }

    public function failed()
    {
        Log::info('出错！');
    }
}

