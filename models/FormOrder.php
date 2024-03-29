<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class FormOrder extends Model
{
    public $phone;
    public $tarif;
    public $date;
    public $adress;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['phone', 'tarif', 'adress', 'date'], 'string'],
        ];
    }


}
