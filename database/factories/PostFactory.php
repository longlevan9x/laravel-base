<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function(Faker $faker) {
	return [
		'author_id'         => 1,
		'parent_id'         => 0,
		'category_id'       => 1,
		'title'             => $faker->text(rand(30, 70)),
		'slug'              => $faker->slug,
		'image'             => $faker->imageUrl(),
		'is_active'         => 1,
		'post_time'         => \Illuminate\Support\Carbon::now(),
		'type'              => 'post',
		'overview'          => $faker->text(100),
		'content'           => $faker->text,
		'status'            => '',
		'seo_title'         => '',
		'seo_keyword'       => '',
		'seo_description'   => '',
		'author_updated_id' => 1,
		'path'              => ''
	];
});
