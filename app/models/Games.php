<?php


/**
 * Article
 */
class Games extends BaseModel
{
    /**
     * Database table names (not including the prefix)
     * @var string
     */
    protected $table = 'games';

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
     * Categories of articles
      * Reverse-many
     * @return object Category
     */
    public function category()
    {
        return $this->belongsTo('category_game', 'cat_id');
    }
}