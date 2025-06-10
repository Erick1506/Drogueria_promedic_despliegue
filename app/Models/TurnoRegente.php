<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurnoRegente extends Model
{
    protected $table = 'turno_regente';
    protected $primaryKey = 'Id_Turno';
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

    protected $fillable = ['turno'];

    public function regentes()
    {
        return $this->hasMany(Regente::class, 'Id_Turno');
    }
}
