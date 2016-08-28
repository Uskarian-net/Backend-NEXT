<?php

namespace ATLauncher\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $safe_name
 * @property integer $position
 * @property string $type
 * @property boolean $enabled
 * @property boolean $can_publish
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $published_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\ATLauncher\Models\LauncherTag[] $launcherTags
 * @property-read \Illuminate\Database\Eloquent\Collection|\ATLauncher\Models\PackTag[] $tags
 * @property-read \Illuminate\Database\Eloquent\Collection|\ATLauncher\Models\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\ATLauncher\Models\PackVersion[] $versions
 */
class Pack extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'safe_name',
        'position',
        'type',
        'enabled',
        'can_publish'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'safe_name' => 'string',
        'position' => 'integer',
        'type' => 'string',
        'enabled' => 'boolean',
        'can_publish' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'published_at' => 'datetime'
    ];

    /**
     * The launcher tags for this pack.
     */
    public function launcherTags()
    {
        return $this->belongsToMany('ATLauncher\Models\LauncherTag');
    }

    /**
     * The tags for this pack.
     */
    public function tags()
    {
        return $this->belongsToMany('ATLauncher\Models\PackTag');
    }

    /**
     * The users that have access to this pack.
     */
    public function users()
    {
        return $this->belongsToMany('ATLauncher\Models\User');
    }

    /**
     * The versions for this pack.
     */
    public function versions()
    {
        return $this->hasMany('ATLauncher\Models\PackVersion');
    }
}
