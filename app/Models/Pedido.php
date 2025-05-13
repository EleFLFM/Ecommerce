<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'user_id',
        'total',
        'estado',
    ];

    // 🔁 Relación con el usuario (cliente que hizo el pedido)
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    // 🔁 Relación con los detalles del pedido
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
}
