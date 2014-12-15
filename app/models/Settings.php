<?php
/**
 * Article Categories
 */
class Settings extends BaseModel
{
    /**
     * Database table names (not including the prefix)
     * @var string
     */
    protected $table = 'settings';

    /**
     * Soft delete
     * @var boolean
     */
    protected $softDelete = true;

}