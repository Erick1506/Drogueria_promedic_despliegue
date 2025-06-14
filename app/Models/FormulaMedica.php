<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormulaMedica extends Model
{
    protected $table = 'promedicch.formula_medica';
    protected $primaryKey = 'Id_Formula';
    public $timestamps = true;

    protected $fullTableName = null;

   

    protected $fillable = [
        'Nombre_Paciente',
        'Identificacion_Paciente',
        'Fecha_Insercion',
        'Id_Administrador',
        'Imagen'
    ];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'Id_Administrador');
    }
}
