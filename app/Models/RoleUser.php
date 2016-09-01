<?php

namespace ATLauncher\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $role_id
 * @property integer $user_id
 * @property integer $created_by
 * @property \Carbon\Carbon $created_at
 * @property-read \ATLauncher\Models\User $creator
 * @property-read \ATLauncher\Models\Role $role
 * @property-read \ATLauncher\Models\User $user
 */
class RoleUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_by'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_user';

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
        'user_id' => 'integer',
        'role_id' => 'integer',
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

    /**
     * The role applied to the user.
     */
    public function role()
    {
        return $this->belongsTo('ATLauncher\Models\Role');
    }

    /**
     * The user this role applies to.
     */
    public function user()
    {
        return $this->belongsTo('ATLauncher\Models\User');
    }
}
