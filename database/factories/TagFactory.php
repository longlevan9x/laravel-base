<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Tag::class, function (Faker $faker) {
    return [
	    'name'             => $faker->text(rand(30, 70)),
	    'slug'              => $faker->slug,
	    'is_active'         => 1,
	    'description'           => $faker->text,
    ];
});
