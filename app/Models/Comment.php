<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    use HasFactory;
    public function post(){
       return $this->belongsTo(Post::class);
    }
    public function user()
    {
       return $this->belongsTo(User::class);
    }

    protected $fillable =[
        'name',
        'email',
        'comment',
        'user_id',
        'post_id'
    ];

    public function getCommentDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F, Y');
    }
}
