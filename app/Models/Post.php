<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //Forzar el nombre de la tabla Post en singular
    protected $table = 'post';
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
    //Creamos la relacion de un Post pertenece a un User (Relacion inversa)
    public function user(){
        return $this->belongsTo(User::class)->selected(['name','username']);
    }
}