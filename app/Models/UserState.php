<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserState extends Model
{
    use HasFactory;
    protected $table = 'user_state';

    protected $fillable = [
        'life',
        'main_magic',
        'secondary_magic',
        'tertiary_magic',
        'dice_4',
        'dice_5',
        'dice_6'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
