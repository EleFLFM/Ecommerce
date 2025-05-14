<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Product;

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
        return $this->belongsTo(User::class,'user_id');
    }

    // 🔁 Relación con los detalles del pedido
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
    public function getTotalFormateado()
    {
        return number_format($this->total, 2);
    }
}
