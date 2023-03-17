<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Container;

class Movimentacao extends Model
{
    use HasFactory;

    protected $table = 'movimentacao';

    protected $fillable = [
        'container_id',
        'tipo',
        'data_hora_inicio',
        'data_hora_fim'
    ];

    public function container()
    {
        return $this->belongsTo(Container::class);
    }
}
