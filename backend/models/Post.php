<?php
namespace backend\models;

use backend\models\PostCategory;
use yii\db\ActiveRecord;
use Yii;

class Post extends ActiveRecord {

	public static function tableName()
	{
		return '{{%posts}}';
	}

	public function rules()
	{
		return [
			[['title', 'link'], 'required', 'message' => 'Поле не должно быть пустым'],
			['link', 'match', 'pattern' => '/^([a-z0-9-._]{3,25})?$/', 'message' => 'Только буквы (a-z), цифры (0-9), не меньше 3 и не больше 25 символов, знаки "-._"'],
			['title', 'string', 'max' => 250, 'tooLong' => 'Поле не должно содержать более 250 символов'],
			['description', 'string', 'max' => 400, 'tooLong' => 'Поле не должно содержать более 400 символов'],
			[['meta_desc', 'meta_keywords'], 'string', 'max' => 250, 'tooLong' => 'Поле не должно содержать более 250 символов'],
			[['title_index', 'content', 'category_id', 'access', 'miniature', 'date'], 'safe'],
		];
	}

    public function getCategory()
    {
        return $this->hasOne(PostCategory::className(), ['id' => 'category_id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tags::className(), ['id' => 'tag_id'])->viaTable('{{%tag_post}}', ['post_id' => 'id']);
    }

    public function getShortText($text, $maxchar = 250)
    {
		if(iconv_strlen($text, 'utf-8') < $maxchar)
			return $text;
		$text = iconv_substr( $text, 0, $maxchar, 'utf-8' );
		$text = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ...', $text);
			return $text;
	}
}