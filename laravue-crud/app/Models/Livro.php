<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Livro extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'ano_publicacao',
        'descricao',
        'quantidade',
        'user_id',
    ];


     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
