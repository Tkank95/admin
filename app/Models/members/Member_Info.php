<?php

namespace App\Models\members;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Member_Info extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'member_info';

    protected $fillable = ['user_id', 'gender', 'phone', 'birthday', 'address', 'facebook', 'team'];

    protected $casts = [
        'user_id' => 'integer',
        'gender' => 'integer',
        'phone' => 'integer',
        'birthday' => 'date',
        'address' => 'string',
        'facebook' => 'string',
        'team' => 'string'
    ];

    public function infoUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
