<?php

namespace frontend\models\forms;

use Yii;
use common\models\Order;
use common\models\Services;
use yii\base\Model;
use yii\helpers\Json;
use yii\httpclient\Client as Http;


class PPForm extends Model 
{

    public $api;
    public $service_id;
    public $link;
    public $likes_total;
    public $group_id;
    
    public $email;
    
    // -- цена заказа
    protected $_order_cost = 0;

    /**
     * @return array the validation rules.
     */
    public function rules() 
    {

        return [
            [['api', 'service_id', 'link', 'likes_total'], 'required'],
            
            [['link'], 'trim'],
            [['link'], 'url'],
            
            [['likes_total'], 'filter', 'filter' => function($value){
                if (is_array($value)) return $value[0];
                return $value;
            }],
                    
            [['likes_total'], 'number', 'min' => Yii::$app->options['minOrder']],
            [['likes_total'], 'checkBalance']
                    
        ];
    }

    public function run() {

        if ( $this->validate() ) {

            $order = new Order();
            
            $order->service_id = $this->service_id;
            $order->user_id = 0;
            $order->likes_total = $this->likes_total;
            $order->likes_ready = 0;
            $order->link = $this->link;
            $order->price = $this->_order_cost;
            $service = Services::find()->where(['id' => $this->service_id])->one();
            $order->social = Order::groupToSocial()[$service->group_id];
            $order->status = Order::STATUS_ACTIVE;
            $order->service_text = '';
            $order->api = $this->api;

            if (!$order->save(false)) {
                return false;
            } else {
                Yii::$app->session->set('orderId', $order->id);                
                return true;                
            }
            
        } else {
            return false;
        }

        return true;
        
    }

    /**
     * Валидатор проверяющий хватит ли бабок у пользователя на заказ
     */
    public function checkBalance() {
        $service = Services::find()->where(['id' => $this->service_id])->one();
        $total = ($service->price / 1000) * $this->likes_total;
        
        $this->_order_cost = $total;
    }
    
    public function attributeLabels()
    {
        return [
            'link' => Yii::t('app', 'Link'),
            'likes_total' => Yii::t('app', 'Quantity')
        ];
    }

}
