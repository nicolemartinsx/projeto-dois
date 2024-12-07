<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $timestamps = false;
    use HasFactory;

    // Defina a tabela associada, se o nome não seguir a convenção
    protected $table = 'files';

    // Defina os atributos que podem ser preenchidos em massa
    protected $fillable = [
        'nome_aluno',
        'file_path',
        'user_id',
        'original_name',
        'visualizado',
        'confirmado'
    ];

    // Defina a relação com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
