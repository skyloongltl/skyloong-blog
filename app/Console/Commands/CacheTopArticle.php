<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class CacheTopArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skyloong:cache-top-article';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成置顶用户缓存';

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
    public function handle(Article $article)
    {
        $this->info('开始生成');

        $article->cacheTopArticle();

        $this->info('生成成功');
    }
}
