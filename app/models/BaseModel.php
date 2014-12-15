<?php

class BaseModel extends Eloquent
{
    /**
     * Soft delete
     * @var boolean
     */
    protected $softDelete = false;

    /**
     * Auto Maintenance timestamp
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Other fields need to use the date regulator
     * @var array
     */
    protected $dates = array();

    /**
     * Collective assignment whitelist (high priority)
     * @var array
     */
    protected $fillable = array();

    /**
     * Collective assignment blacklist
     * @var array
     */
    protected $guarded = array();

/*
|--------------------------------------------------------------------------
| Accessor
|--------------------------------------------------------------------------
*/
    /**
     * Friendly creation time
     * @return string
     */
    public function getFriendlyCreatedAtAttribute()
    {
        return friendly_date($this->created_at);
    }

    /**
     * Updated friendly
     * @return string
     */
    public function getFriendlyUpdatedAtAttribute()
    {
        return friendly_date($this->updated_at);
    }

    /**
     * Friendly deletion time
     * @return string
     */
    public function getFriendlyDeletedAtAttribute()
    {
        return friendly_date($this->deleted_at);
    }


}