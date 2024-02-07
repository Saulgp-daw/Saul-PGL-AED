<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $dni
 * @property string $nombre
 * @property string $apellidos
 * @property integer $fechanacimiento
 * @property string $imagen
 * @property Matricula[] $matriculas
 */
class Alumno extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'dni';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['dni', 'nombre', 'apellidos', 'fechanacimiento', 'imagen'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matriculas()
    {
        return $this->hasMany('App\Models\Matricula', 'dni', 'dni');
    }
}
