<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movimentacao;

class Container extends Model
{
    use HasFactory;

    protected $table = 'container';

    protected $fillable = [
        'cliente',
        'numero_container',
        'tipo',
        'status',
        'categoria',
    ];

    public function cliente()
    {
        return $this->belongsTo(Movimentacao::class);
    }
}
