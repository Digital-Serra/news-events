<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class News extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    protected $fillable = [
        'title',
        'body',
        'published',
    ];


    public function getTagsAttribute()
    {
        foreach ($this->tags()->get()->toArray() as $key => $value) {
            $array[$key] = $value['name'];
        }
        $tags = implode(',',$array);

        return $tags;
    }


    /**
     * Reltionship between news and tags
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'news_tag', 'news_id', 'tag_id');
    }

    /**
     * A news has many pictures
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }
}
