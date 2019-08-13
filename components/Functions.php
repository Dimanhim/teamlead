<?php

namespace app\components;
use app\models\Tarif;
use app\models\Users;
use app\models\Orders;
class Functions
{
	public function getDate($date)
	{
		return explode('.', $date);
	}
	public function getTarifDays($date)
	{
		return explode(',', Tarif::findOne($date)->days);
	}
	public function isTarifDays($selected_date, $tarif_days)
	{
		$timestamp = mktime(1, 1, 1, $selected_date['1'], $selected_date['0'], $selected_date['2']);
		$date = date('N', $timestamp);
		foreach($tarif_days as $s_d)
		{
			if($s_d == $date) return false;
		}
		return true;
	}
	public function valData($phone, $adress, $date)
	{
		if($phone == null) return false;
		if($adress == null) return false;
		if($date == null) return false;
		return true;
	}
	public function isClient($phone)
	{
		$client = Users::find()->where(['phone' => $phone]);
		if($client->exists()) return true;
		else return false;
	}
	public function getClientId($phone)
	{
		return Users::find()->where(['phone' => $phone])->one()->id;
	}
	public function getTimestamp($date)
	{
		return mktime(1, 1, 1, $date['1'], $date['0'], $date['2']);
	}


	public function getClientOrders($id)
	{
		$tarifs = Tarif::find()->where('price < 1000')->asArray()->all();
		$arr = array();
		foreach($tarifs as $tarif)
		{
			$arr[] = $tarif['id'];
		}
		return Orders::find()->where(['client' => $id])->andWhere(['tarif' => $arr])->count();
	}


	public function getClientThreeOrder($id)
	{
		$orders = Orders::find()->where(['client' => $id])->all();
		return $orders[2];
	}
	public function getClientThreeOrderThousand($id)
	{
		$orders = Orders::find()->where(['client' => $id])->all();
		$count = 0;
		foreach($orders as $order)
		{
			if($count == 0)
			{
				if($this->getPrice($order->tarif) > 1000) continue;
				else $count++;
			}
			else
			{
				$count++;
				if($count == 4) return $order;
			}
		}

		
	}
	public function getPrice($id)
	{
		$tarif = Orders::findOne($id)->tarif;
		return Tarif::findOne($tarif)->price;
	}
}