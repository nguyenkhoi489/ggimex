<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CachClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CacheConfig:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call("optimize:clear");
        $this->call("event:clear");
        $this->call("config:clear");
        $this->call("view:clear");
        $this->call("route:clear");
        $this->call("config:clear");
        $this->call("cache:clear");
        return Command::SUCCESS;
    }
}
