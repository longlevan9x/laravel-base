<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 11/22/2018
 * Time: 18:32
 */

return [
	'title' => [
		'title'   => "Tiêu đề",
		'index'   => 'Danh sách',
		'show'    => "Chi tiết",
		'create'  => 'Tạo mới',
		'store'   => 'Tạo mới',
		'edit'    => 'Chỉnh sửa',
		'update'  => "Cập nhật",
		'destroy' => 'Xóa',
		'read'    => 'xem',
		'config'  => "Cấu hình",
		'setting' => "Cài đặt"
	],

	'permission' => 'Quyền hạn',

	'user' => [
		'name'     => 'Thành viên',
		'roles'    => 'Danh sách vai trò',
		'resource' => [
			'index'  => 'Danh sách thành viên',
			'create' => 'Tạo mới thành viên',
			'edit'   => 'Cập nhật thành viên',
			'show'   => 'Thông tin thành viên',
		]
	],

	'role' => [
		'name'     => 'Vai trò',
		'resource' => [
			'index'  => 'Danh sách vai trò',
			'create' => 'Tạo mới vai trò',
			'edit'   => 'Cập nhật vai trò',
			'delete' => 'Xóa vai trò'
		]
	],

	'category' => [
		'name'   => 'Danh mục',
		'banner' => 'Ảnh nền',
		'image'  => 'Ảnh đại diện ',
		'icon'   => 'Ảnh menu ',
		'avatar' => "Ảnh đại diện"
	],

	'menu' => [
		'name'     => 'Danh sách',
		'resource' => [
			'index'  => 'Danh sách menu',
			'create' => 'Tạo menu',
			'edit'   => 'Sửa menu',
			'delete' => 'Xóa menu',
		]
	],

	'admin' => [
		'name'     => 'Quản trị viên',
		'resource' => [
			'index'  => 'Danh sách quản trị viên',
			'create' => 'Tạo mới quản trị viên',
			'edit'   => 'Cập nhật quản trị viên',
		]
	],

	'config' => [
		'name'     => 'Cài đặt',
		'resource' => [
			'index' => 'Cài đặt tổng thể',
		]
	],

	'website'          => [
		'name' => "Website"
	],

	'translation-manager' => 'Dịch đa ngữ'
	//can remove
];