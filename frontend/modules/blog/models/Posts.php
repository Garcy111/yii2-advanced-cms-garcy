<?php
namespace frontend\modules\blog\models;

use yii\db\ActiveRecord;
use common\components\SearchClass;
use Yii;

class Posts extends ActiveRecord {

	public static function tableName()
	{
		return '{{%posts}}';
	}

    public function getDataSearch() {
        $query = Yii::$app->request->get('query');
        if ( !empty($query) ) {
            $searchObj  = new SearchClass();
            $indexQuery = ( $searchObj -> make_index($query) );

            $data = self::find()->asArray()->all();
            $count = count($data);
            $range = 0;
            for ( $i=0; $count > $i; $i++ ) {
                $index = json_decode($data[$i]["title_index"]);
                if ( !empty($index) ) {
                    $range = $searchObj->search($indexQuery, $index);
                }

                if ( $range > 0 ) {
                    // $result[ $data[$i][ 'id' ] ] = $range;
                    $result[] = $data[$i];
                }
            }
        }

        // Если что-нибудь нашлось //
        if ( isset( $result ) ) {
            // Сортировка по убыванию //
            arsort( $result );
            
            return $result;
        }
        else {
            return false;
        }
    }

	public function getCategory()
    {
        return $this->hasOne(PostCategory::className(), ['id' => 'category_id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tags::className(), ['id' => 'tag_id'])->viaTable('{{%tag_post}}', ['post_id' => 'id']);
    }
}