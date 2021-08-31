<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getMarginAttribute()
    {
        if ($this->isReply())
            if ($this->isReplyToReply())
                return 'ml60';
            else
                return 'ml30';
        else
            return 'ml4';
    }

    public function getParent()
    {
        $parent = Comment::where('parent_id', $this->parent_id)->get();
        return $parent;
    }

    public function getReplies()
    {
        $replies = Comment::where('parent_id', $this->id)->get();

        if ($replies) {

            foreach ($replies as $reply) {
                $replies->concat($reply->getReplies());
            }
            return $replies;
        }
        return $replies;
    }

    public function scopeApproved($query)
    {
        return $query->where('approved_at', '<=', now());
    }

    public function isApproved(): bool
    {
        return $this->approved_at != NULL;
    }

    public function isReply()
    {
        return $this->parent_id != NULL;
    }

    public function isReplyToReply()
    {
        $parent = Comment::findOrFail($this->parent_id);
        return $parent->parent_id != NULL;
    }
}
