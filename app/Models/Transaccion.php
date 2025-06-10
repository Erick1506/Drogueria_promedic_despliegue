<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'promedicch.transacciones';

    // Elimina el método getTable()
    protected $primaryKey = 'Id_Transacciones';
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
        'Fecha_Transaccion',
        'Cantidad',
        'Id_Administrador',
        'Id_Producto',
        'Id_Tipo_Transaccion'
    ];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'Id_Administrador');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_Producto');
    }

    public function tipoTransaccion()
    {
        return $this->belongsTo(TipoTransaccion::class, 'Id_Tipo_Transaccion');
    }
}
