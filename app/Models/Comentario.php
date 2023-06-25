<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable=[
        'comentario',
        'user_id',
        'post_id'
    ];

    //Crear una relacion donde un comentario pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}