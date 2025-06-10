<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoProducto extends Model
{
    protected $table = 'estado_producto';
    protected $primaryKey = 'Id_Estado_Producto';
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

    protected $fillable = ['Tipo_Estado_Producto'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'Id_Estado_Producto');
    }
}
