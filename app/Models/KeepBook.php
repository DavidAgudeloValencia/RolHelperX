<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeepBook extends Model
{
    use HasFactory;

    protected $table = 'keepbook';

    protected $fillable = [
        'title',
        'description'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
