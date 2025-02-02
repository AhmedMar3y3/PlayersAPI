<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Player extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        "player_id",
        "name",
        "player_num",
        "player_position",
    ];
    public function user(){
        return $this->belongsTo(User::class);
     }
}
