<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 07/13/2018
 * Time: 23:44
 */

namespace App\Models\Traits;

/**
 * Trait ModelBootTrait
 * @package App\Models\Traits
 */
trait ModelBootTrait
{
	public static function boot() {
		parent::boot();

		self::creating(function($model) {
			// ... code here
		});

		self::created(function($model) {
			// ... code here
		});

		self::updating(function($model) {
			// ... code here
		});

		self::updated(function($model) {
			// ... code here
		});

		self::deleting(function($model) {
			// ... code here
		});

		self::deleted(function($model) {
			// ... code here
		});

		self::saving(function($model) {
			/** @var ModelTrait|ModelUploadTrait $model */
			if (!$model->beforeSave()) {
				return $model->beforeSave();
			}
			if (method_exists($model, 'uploadImage') && $model->isAutoUploadImage()) {
				$model->uploadImage();
			}
		});

		self::saved(function($model) {
			/** @var ModelTrait|ModelUploadTrait $model */
			if (!$model) {
				if (method_exists($model, 'removeImage') && $model->isAutoUploadImage()) {
					$model->removeImage();
				}

				return false;
			}
			$model->afterSave();
		});
	}
}