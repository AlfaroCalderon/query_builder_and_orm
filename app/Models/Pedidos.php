<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedidos extends Model
{
    use HasFactory;
    protected $fillable = [
        'producto',
        'cantidad',
        'total',
        'id_usuario'
    ];

    public function usuario(): BelongsTo{
        return $this->belongsTo(Usuarios::class);
    }
}
