<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPromocion extends Model
{
    protected $table = 'tipo_promocion';
    protected $primaryKey = 'Id_Tipo_Promocion';
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

    protected $fillable = ['Tipo_Promocion'];

    public function promociones()
    {
        return $this->hasMany(Promocion::class, 'Id_Tipo_Promocion');
    }
}
