<?php
namespace backend\models;

use yii\db\ActiveRecord;
use yii\data\Pagination;

class ImageManager extends ActiveRecord {

	public static function tableName()
	{
		return 'images';
	}

	public function getImages()
	{
		$query = self::find();
	    $countQuery = clone $query;
	    $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 18]);
	    $pages->pageSizeParam = false;
	    $imgs = $query->offset($pages->offset)
	    ->orderBy('id DESC')
        ->limit($pages->limit)
        ->asArray()
        ->all();
        $data['imgs'] = $imgs;
        $data['pages'] = $pages;
		return $data;
	}

	public function getImage($name)
	{
		return self::find()->where(['name' => $name])->asArray()->one();
	}

	public function delImage($dir, $name) {
		$file = $dir . $name;
		$file_min = $dir . "min/" . $name;
		unlink($file);
		unlink($file_min);
		self::deleteAll(['name' => $name]);
	}
}