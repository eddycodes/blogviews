<?php namespace ImpulseTechnologies\BlogViews\Components;

use Cms\Classes\ComponentBase;
use Winter\Blog\Models\Post as BlogPost;
use Db;

class Views extends ComponentBase
{
    /**
     * @var Winter\Blog\Models\Post The post model used for display.
     */
    public $post;

    public function componentDetails()
    {
        return [
            'name'        => 'impulsetechnologies.blogviews::lang.component.views_name',
            'description' => 'impulsetechnologies.blogviews::lang.component.views_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'winter.blog::lang.properties.post_slug',
                'description' => 'winter.blog::lang.properties.post_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ]
        ];
    }

    public function onRun()
    {
        $this->views = $this->page['views'] = $this->getViews();
    }

    protected function loadPost()
    {
        $slug = $this->property('slug');
        $post = BlogPost::isPublished()->where('slug', $slug)->first();

        return $post;
    }

    protected function getViews()
    {
        $out = 0;
        $post = $this->loadPost();

        if(!is_null($post)) {
            $obj = Db::table('impulsetechnologies_blogviews_views')
                ->where('post_id', $post->getKey());

            if ($obj->count() > 0) {
                $out = $obj->first()->views;
            }
        }

        return $out;
    }
}
