<?php
namespace backend\models\forms;

use Yii;
use yii\base\Model;
use backend\models\forms\UploadForm;
use yii\web\UploadedFile;
use common\components\ContentVersioner;

class ProductForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $oldimage;
    public $image;

    public $id;
    public $title;
    public $price;
    public $description;
    public $date_create;
    public $date_update;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['title', 'image', 'oldimage'], 'string', 'max' => 256]
        ];
    }
    
    public function run() {        
        $uploadForm = new UploadForm();

        $uploadForm->imageFile = UploadedFile::getInstance($this, 'image');
        if(!$uploadForm->imageFile) {
            $this->image = $this->oldimage;
        } else {
            $result = $uploadForm->upload();
            if ($result !== false) {
                $this->image = $result;
            }
        }

        $contentVersioner = new ContentVersioner();
        if ($contentVersioner->setEntityData('products', $this->id, $this->getAttributes(['title', 'image', 'price', 'description'])) ) {
            return true;
        } else {
            return false;
        }
        
    }
}

