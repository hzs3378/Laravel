<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //任务最大尝试次数
    public $tries = 3;

    //任务运行的超时时间
    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
//        DB::update('update users set ord=? where id = ?', ['队列延时修改', 4]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::update('update users set ord=? where id = ?', ['双任务2', 2]);
//        for($i=1;$i<=500;$i++){
//            DB::update('update users set ord=? where id = ?', ['队列延时修改'.$i, $i]);
//        }
    }

    public function failed(Exception $exception)
    {
        Log::info('任务失败');
    }
}
