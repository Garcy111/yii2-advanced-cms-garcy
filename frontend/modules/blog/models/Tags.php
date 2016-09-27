<?php

namespace frontend\modules\blog\models;

use Yii;

/**
 * This is the model class for table "{{%tags}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property TagPost[] $tagPosts
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
        ];
    }

     public function findPosts()
    {
        return $this->hasMany(Posts::className(), ['id' => 'post_id'])->viaTable('{{%tag_post}}', ['tag_id' => 'id']);
    }
}
