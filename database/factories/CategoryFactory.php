<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function(Faker $faker) {
	return [
		'parent_id'         => 0,
		'name'             => $faker->text(rand(30, 70)),
		'slug'              => $faker->slug,
		'image'             => $faker->imageUrl(),
		'is_active'         => 1,
		'type'              => 'category',
		'description'           => $faker->text,
		'status'            => '',
		'seo_title'         => '',
		'seo_keyword'       => '',
		'seo_description'   => '',
		'path'              => ''
	];
});
