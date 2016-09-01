<?php

namespace ATLauncher\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $rate_limit
 * @property integer $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \ATLauncher\Models\LauncherTag $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\ATLauncher\Models\User[] $users
 */
class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'rate_limit',
        'created_by'
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
        'name' => 'string',
        'description' => 'string',
        'rate_limit' => 'integer',
        'created_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * The user who created this role.
     */
    public function creator()
    {
        return $this->belongsTo('ATLauncher\Models\User', 'created_by');
    }

    /**
     * The users that have this role.
     */
    public function users()
    {
        return $this->belongsToMany('ATLauncher\Models\User');
    }
}
