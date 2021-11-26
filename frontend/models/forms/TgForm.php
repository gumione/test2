<?php

namespace frontend\models\forms;

use Yii;
use common\models\Order;
use yii\base\Model;
use yii\helpers\Json;
use yii\httpclient\Client as Http;

class TgForm extends Model {

    public $type;
    public $speed;
    public $link;
    public $age;
    public $likes_total;
    public $location;
    public $gender;
    public $insurance;
    public $social = Order::SOCIAL_TG;
    // -- цена заказа
    private $_order_cost = 0;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['type', 'speed', 'link', 'location', 'gender', 'likes_total', 'insurance'], 'required'],
            ['age', 'default', 'value' => Order::AGE_ANY],
            ['location', 'default', 'value' => Order::LOCATION_ANY],
            ['gender', 'default', 'value' => Order::GENDER_ANY],
            ['type', 'in', 'range' => array_keys(Order::typeLabelsTg())],
            ['speed', 'in', 'range' => array_keys(Order::speedLabels())],
            ['location', 'in', 'range' => array_keys(Order::locationLabels())],
            ['gender', 'in', 'range' => array_keys(Order::genderLabels())],
            ['insurance', 'in', 'range' => array_keys(Order::insuranceLabels())],
            [['link'], 'trim'],
            [['link'], 'url'],
            [['link'], 'match', 
                'pattern' => '/(?:t|telegram)\.me\/([a-z0-9\_]{5,32})|telegram\.org.+p=@([a-z0-9\_]{5,32})/i',
                'message' => Yii::t('app', 'Please enter Telegram URL')
            ],
            //['age', 'in', 'range' => array_keys(Order::ageLabels()), 'message' => Yii::t('app', 'Некорректный возрастной диапазон')],
            [['likes_total'], 'filter', 'filter' => function($value) {
                    if (is_array($value))
                        return $value[0];
                    return $value;
                }],
            [['likes_total'], 'number', 'min' => Yii::$app->options['minOrder']],
            [['likes_total'], 'checkBalance']
        ];
    }

    public function run() {

        if ($this->validate()) {

            $order = new Order();

            $order->social = Order::SOCIAL_TG;
            $order->type = $this->type;
            $order->speed = $this->speed;
            //$order->age = $this->age;
            $order->user_id = 0;
            $order->likes_total = $this->likes_total;
            $order->likes_ready = 0;
            $order->link = $this->link;
            $order->price = $this->_order_cost;
            $order->location = $this->location;
            $order->gender = $this->gender;

            $order->status = Order::STATUS_NEW;
            $order->service_text = '';
            $order->insurance = $this->insurance;
            $order->api = Order::API_BESTLIKER;

            if (!$order->save()) {
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
        $total = 0;
        
        $prices = \common\models\Services::getPrices();
        
        $total += $prices['tg'][$this->type] / 1000;

        $total += ( $this->speed == Order::SPEED_MIN ) ? (Yii::$app->options['marginSpeedMin'] / 1000) : 0;
        $total += ( $this->speed == Order::SPEED_SLOW ) ? (Yii::$app->options['marginSpeedSlow'] / 1000) : 0;
        $total += ( $this->speed == Order::SPEED_STND ) ? (Yii::$app->options['marginSpeedStnd'] / 1000) : 0;
        $total += ( $this->speed == Order::SPEED_FAST ) ? (Yii::$app->options['marginSpeedFast'] / 1000) : 0;
        $total += ( $this->speed == Order::SPEED_VIP ) ? (Yii::$app->options['marginSpeedVip'] / 1000) : 0;

        //$total += ( $this->age == Order::AGE_BEFORE18 )   ? (Yii::$app->options['margin.' . Yii::$app->session['currency']]/1000) : 0;
        //$total += ( $this->age == Order::AGE_AFTER18  )   ? (Yii::$app->options['margin.' . Yii::$app->session['currency']]/1000) : 0;

        $total += ( $this->location == Order::LOCATION_ANY ) ? 0 : (Yii::$app->options['margin'] / 1000);
        $total += ( $this->gender == Order::GENDER_ANY ) ? 0 : (Yii::$app->options['margin'] / 1000);

        $total = $total * $this->likes_total;

        //$coins = Yii::$app->user->identity->cbalance + Yii::$app->user->identity->bbalance;
        // -- страхуйка
        if($this->insurance != Order::INSURANCE_MINIMUM) {
            $rates = [Yii::$app->options['insuranceMin'], Yii::$app->options['insuranceEco'], Yii::$app->options['insuranceStnd'], Yii::$app->options['insuranceVip']];
            $total += round($total/100*$rates[$this->insurance], 2);
        }
//        
//        if ( $coins < $total ) {
//            $this->addError('likes_total', Yii::t('app', 'Не хватает монет для такого объема заказа'));
//        } else {
            $this->_order_cost = $total;
        //}
    }

    public function attributeLabels() {
        return [
            'type' => Yii::t('app', 'Order type'),
            'speed' => Yii::t('app', 'Speed'),
            'age' => Yii::t('app', 'Age'),
            'link' => Yii::t('app', 'Link'),
            'location' => Yii::t('app', 'Country'),
            'gender' => Yii::t('app', 'Gender'),
            'likes_total' => Yii::t('app', 'Quantity'),
            'insurance' => Yii::t('app', 'Insurance')
        ];
    }

    public function getOrderCost() {
        return $this->_order_cost;
    }

}
