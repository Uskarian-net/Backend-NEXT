<?php

namespace ATLauncher\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $version
 * @property array $json
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\ATLauncher\Models\PackVersion[] $packVersions
 */
class MinecraftVersion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'version',
        'json'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'version' => 'string',
        'json' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * The pack versions that use this Miencraft version.
     */
    public function packVersions()
    {
        return $this->hasMany('ATLauncher\Models\PackVersion');
    }
}
