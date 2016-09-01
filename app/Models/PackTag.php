<?php

namespace ATLauncher\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $pack_id
 * @property string $tag
 * @property string $created_by
 * @property \Carbon\Carbon $created_at
 * @property-read \ATLauncher\Models\User $creator
 * @property-read \ATLauncher\Models\Pack $pack
 */
class PackTag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag',
        'created_by'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pack_tag';

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
        'pack_id' => 'integer',
        'tag' => 'string',
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
     * The user who created this pack tag.
     */
    public function creator()
    {
        return $this->belongsTo('ATLauncher\Models\User', 'created_by');
    }

    /**
     * The pack this tag belongs to.
     */
    public function pack()
    {
        return $this->belongsTo('ATLauncher\Models\Pack');
    }
}
