<?php

class Mavro extends CApplicationComponent
{
    public $enabled = true;

    public function getName() {
        return 'MAVRO';
    }

    /**
     * Возвращает массив с текущим курсом МАВРО.
     * Если данные не удалось получить, то возвращает FALSE.
     * @return array|boolean
     */
    public function getTodayRates() {
        $cache_key = 'mavro_today_rates_' . date('d.m.Y');
        if (!($rates = Yii::app()->cache->get($cache_key))) {
            $rates = file_get_contents('http://sergey-mavrodi.com/kurs_new.php#current_day');
            if (false === $rates) {
                return FALSE;
            }
            preg_match_all('/<td style="width:200px;" bgcolor="#FFA602">(\d+\.\d+)<\/td>/i', $rates, $matches);
            $rates = array_map(function($e){return floatval($e);}, $matches[1]);
            Yii::app()->cache->set($cache_key, $rates, 3600*24);
        }
        return $rates;
    }

}
