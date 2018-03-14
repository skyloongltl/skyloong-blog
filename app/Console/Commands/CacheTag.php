<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tag;
use Cache;

class CacheTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skyloong:cache-tag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成标签缓存';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Tag $tag)
    {
        $this->info('开始生成');
        $tags = $tag->all();
        Cache::put('tags', $tags, 43200);
        $this->info('生成完毕');
    }
}
