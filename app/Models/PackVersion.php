<?php

namespace ATLauncher\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $version
 * @property integer $pack_id
 * @property integer $minecraft_version_id
 * @property boolean $is_development
 * @property string $changelog
 * @property string $xml
 * @property array $json
 * @property integer $created_by
 * @property null|integer $published_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property null|\Carbon\Carbon $published_at
 *
 * @property-read \ATLauncher\Models\User $creator
 * @property-read \ATLauncher\Models\MinecraftVersion $minecraftVersion
 * @property-read \ATLauncher\Models\Pack $pack
 * @property-read \ATLauncher\Models\User $publisher
 */
class PackVersion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'version',
        'created_by',
        'is_development',
        'changelog',
        'xml',
        'json',
        'published_by',
        'published_at'
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
        'version' => 'string',
        'pack_id' => 'integer',
        'minecraft_version_id' => 'integer',
        'is_development' => 'boolean',
        'changelog' => 'string',
        'xml' => 'string',
        'json' => 'array',
        'created_by' => 'integer',
        'published_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'published_at' => 'datetime'
    ];

    /**
     * The user who created this version.
     */
    public function creator()
    {
        return $this->belongsTo('ATLauncher\Models\User', 'created_by');
    }

    /**
     * The pack that this version belongs to.
     */
    public function pack()
    {
        return $this->belongsTo('ATLauncher\Models\Pack');
    }

    /**
     * The Minecraft version this version users.
     */
    public function minecraftVersion()
    {
        return $this->belongsTo('ATLauncher\Models\MinecraftVersion');
    }

    /**
     * The user who published this version.
     */
    public function publisher()
    {
        return $this->belongsTo('ATLauncher\Models\User', 'published_by');
    }
}
