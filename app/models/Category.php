<?php
/**
 * Article Categories
 */
class Category extends BaseModel
{
    /**
     * Database table names (not including the prefix)
     * @var string
     */
    protected $table = 'category_game';

    /**
     * Soft delete
     * @var boolean
     */
    protected $softDelete = true;

/*
|--------------------------------------------------------------------------
| Object-relational model
|--------------------------------------------------------------------------
*/
    /**
     * Classification under article
      * Many
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function articles()
    {
        return $this->hasMany('Article', 'category_id');
    }



}