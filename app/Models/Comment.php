<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(
    'user_id',
    'post_id',
    'body'
)]
class Comment extends Model
{
    //
}
