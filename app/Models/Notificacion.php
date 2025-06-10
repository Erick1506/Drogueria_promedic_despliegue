<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones';
    protected $primaryKey = 'id';
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

    protected $fillable = ['mensaje', 'fecha_creacion'];
}
