<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = 'promedicch.promocion';
    protected $primaryKey = 'Id_Promocion';
    public $timestamps = true;

     protected $fullTableName = null;

    public function getTable()
    {
        if ($this->fullTableName === null) {
            $table = parent::getTable();
            if (strpos($table, 'promedicch.') === 0) {
                $this->fullTableName = $table;
            } else {
                $this->fullTableName = 'promedicch.' . $table;
            }
        }
        return $this->fullTableName;
    }

    protected $fillable = [
        'Id_Administrador', 'Id_Producto', 'Id_Tipo_Promocion', 
        'Fecha_Inicio', 'Fecha_Fin', 'Descuento'
    ];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'Id_Administrador');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_Producto', 'Id_Producto');
    }

    public function tipoPromocion()
    {
        return $this->belongsTo(TipoPromocion::class, 'Id_Tipo_Promocion');
    }
}
