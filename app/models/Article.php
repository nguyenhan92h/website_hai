<?php


/**
 * Article
 */
class Article extends BaseModel
{
    /**
     * Database table names (not including the prefix)
     * @var string
     */
    protected $table = 'article';

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
        return $this->belongsTo('Category', 'category_id');
    }

    /**
     * The article's author
      * Reverse-many
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * Article Comments
      * Many
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function comments()
    {
        return $this->hasMany('Comment', 'article_id');
    }
}