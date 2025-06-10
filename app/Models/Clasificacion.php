<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    protected $table = 'promedicch.clasificacion';
    protected $primaryKey = 'Id_Clasificacion';
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
        'Nombre_Clasificacion',
        'Descripcion_Clasificacion',
        'Id_Categoria'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'Id_Categoria');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'Id_Clasificacion');
    }
}
