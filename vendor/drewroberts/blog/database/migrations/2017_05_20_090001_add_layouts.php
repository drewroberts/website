<?php

declare(strict_types=1);

use DrewRoberts\Blog\Models\Layout;
use Illuminate\Database\Migrations\Migration;
use Tipoff\Support\Enums\LayoutType;

class AddLayouts extends Migration
{
    public function up()
    {
        foreach ([
            [
                'name'          => 'Base Page',
                'layout_type'   => LayoutType::PAGE,
                'view'          => 'blog::page.base',
                'note'          => 'Base HTML Structure',
                'created_at'    => '2021-04-09 10:00:00',
                'updated_at'    => '2021-04-09 10:00:00',
            ],
            [
                'name'          => 'AMP Page',
                'layout_type'   => LayoutType::PAGE,
                'view'          => 'blog::page.amp',
                'note'          => 'AMP Structure',
                'created_at'    => '2021-04-09 10:00:00',
                'updated_at'    => '2021-04-09 10:00:00',
            ],
            [
                'name'          => 'Base Post',
                'layout_type'   => LayoutType::POST,
                'view'          => 'blog::post.base',
                'note'          => 'Base HTML Structure',
                'created_at'    => '2021-04-09 10:00:00',
                'updated_at'    => '2021-04-09 10:00:00',
            ],
            [
                'name'          => 'AMP Post',
                'layout_type'   => LayoutType::POST,
                'view'          => 'blog::post.amp',
                'note'          => 'AMP Structure',
                'created_at'    => '2021-04-09 10:00:00',
                'updated_at'    => '2021-04-09 10:00:00',
            ],
            [
                'name'          => 'Base Topic',
                'layout_type'   => LayoutType::TOPIC,
                'view'          => 'blog::topic.base',
                'note'          => 'Base HTML Structure',
                'created_at'    => '2021-04-09 10:00:00',
                'updated_at'    => '2021-04-09 10:00:00',
            ],
            [
                'name'          => 'AMP Topic',
                'layout_type'   => LayoutType::TOPIC,
                'view'          => 'blog::topic.amp',
                'note'          => 'AMP Structure',
                'created_at'    => '2021-04-09 10:00:00',
                'updated_at'    => '2021-04-09 10:00:00',
            ],
            [
                'name'          => 'Base Series',
                'layout_type'   => LayoutType::SERIES,
                'view'          => 'blog::series.base',
                'note'          => 'Base HTML Structure',
                'created_at'    => '2021-04-09 10:00:00',
                'updated_at'    => '2021-04-09 10:00:00',
            ],
            [
                'name'          => 'AMP Series',
                'layout_type'   => LayoutType::SERIES,
                'view'          => 'blog::series.amp',
                'note'          => 'AMP Structure',
                'created_at'    => '2021-04-09 10:00:00',
                'updated_at'    => '2021-04-09 10:00:00',
            ]
        ] as $layout) {
            Layout::firstOrCreate($layout);
        }
    }
}
