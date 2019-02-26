<?php

return [
	'menu' => [
		'name' => [
			'post'             => "Tin tức",
			'product'          => "Sản phẩm",
			'recruitment'      => "Tuyển dụng",
			'service'          => "Dịch vụ",
			'introduce'        => "Giới thiệu",
			'customer_reviews' => "Ý kiến khách hàng"
		],
		'url'  => [
			'post'             => "tin-tuc",
			'product'          => "san-pham",
			'introduce'        => "gioi-thieu",
			'service'          => "dich-vu",
			'recruitment'      => "tuyen-dung",
			'customer_reviews' => "y-kien-khach-hang"
		],
		'type' => [
			"tin-tuc"           => 'post',
			"san-pham"          => 'product',
			"gioi-thieu"        => 'introduce',
			"dich-vu"           => 'service',
			"tuyen-dung"        => 'recruitment',
			"y-kien-khach-hang" => 'customer_reviews',
		]
	],

	'category' => [
		'type' => []
	],

	'post' => [
		'type' => []
	],

	'cache' => [
		'life_time' => 60, // 1h
		'keys'      => [
			'settings' => 'settings',
			'website'  => [
				'menus' => 'menusWebsite'
			],
			'products' => []
		],
	],

	'role' => [
		'levels' => [2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6]
	],

	'language' => [
		'locales' => [
			'vi' => 'Tiếng Việt',
			'en' => "English",
		],
		'locale'  => 'vi',
		'type'    => 'square'
	],

	'paginate' => [
		'post'    => 5,
		'product' => 9
	],
	'settings' => [
		'keys'           => [
			'_background_login' => '_background_login',
			'_v_login'          => '_v_login'
		],
		'login_versions' => [
			'v1' => 'v1',
			'v2' => 'v2',
			'v3' => 'v3',
			'v4' => 'v4',
			'v5' => 'v5',
			'v6' => 'v6',
		]
	]
];