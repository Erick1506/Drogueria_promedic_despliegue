<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTransaccion extends Model
{
    protected $table = 'tipo_transaccion';
    protected $primaryKey = 'Id_Tipo_Transaccion';
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

    protected $fillable = ['Tipo_Transaccion'];

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'Id_Tipo_Transaccion');
    }
}
