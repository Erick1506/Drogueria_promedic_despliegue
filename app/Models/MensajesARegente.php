<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensajesARegente extends Model
{
    protected $table = 'promedicch.mensajes_a_regente';
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

    protected $fillable = ['mensaje', 'fecha'];
}
