## Usage
1. Copy this archives to specific folders:
    - News, Tag and Picture models to models folder 
    - Dashboard/NewsController to dashboard controllers folder 
    - create_news_table, create_tags_table, create_news_tags_table, create_pictures_table migrations to migrations folder
    - resources/views/news and forms to resources/views folder
    - app/Http/Requests/NewsFormRequest  to app/Http/Requests folder
3. After:
    - Run: `composer require cviebrock/eloquent-sluggable`
    - Add `Cviebrock\EloquentSluggable\SluggableServiceProvider::class,` to providers array

2. Optional:
    - Add public/img/news to .gitignore for ignore news images on remote repo