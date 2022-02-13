<?php

namespace App\Models\Del;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide_Del extends Model
{
    use HasFactory;

    protected $table = 'slides_del';

    protected $fillable = ['old_id', 'user_id_del', 'name', 'content', 'description', 'link', 'image', 'status', 'created_at', 'updated_at', 'create_time'];
}
