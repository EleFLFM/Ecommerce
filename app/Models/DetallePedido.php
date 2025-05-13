<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedidos';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'talla',
        'color',
        'cantidad',
        'precio_unitario',
    ];

    // 🔁 Relación con el pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    // 🔁 Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Product::class);
    }
}
