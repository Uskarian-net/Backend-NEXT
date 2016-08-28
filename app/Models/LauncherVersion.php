<?php

namespace ATLauncher\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $version
 * @property integer $created_by
 * @property \Carbon\Carbon $created_at
 * @property-read \ATLauncher\Models\User $creator
 */
class LauncherVersion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'version',
        'created_by'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'version' => 'string',
        'created_by' => 'integer',
        'created_at' => 'datetime'
    ];

    /**
     * This will disable the updated_at value from being filled since we don't need/use it.
     *
     * @param mixed $value
     * @return $this
     */
    public function setUpdatedAt($value)
    {
        return $this;
    }

    /**
     * The user who created this role association.
     */
    public function creator()
    {
        return $this->belongsTo('ATLauncher\Models\User', 'created_by');
    }
}
