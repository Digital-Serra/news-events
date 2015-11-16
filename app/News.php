<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
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
