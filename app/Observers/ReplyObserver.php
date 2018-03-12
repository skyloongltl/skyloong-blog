<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_article_body');
        $reply->content = strip_tags(preg_replace_callback("|@[\w\x{4e00}-\x{9fa5}]+|u", 'replace', $reply->content), '<em>');
    }
}