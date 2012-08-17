<?php
class Rates
{
	private static $rates;

	private static function calcRates() {
		$rates_config = Yii::app()->params['rates'];
		$date_start = $rates_config['date_start'];
		$buy = $rates_config['buy'];
		$sell = $rates_config['sell'];
		$percent = $rates_config['percent'];
		$period = $rates_config['period'];

		self::$rates = array();
		self::$rates[$date_start]['buy'] = $buy;
		self::$rates[$date_start]['sell'] = $sell;
		while ($date_start <= mktime(0, 0, 0, 12, 31)) {
			$date_start+= $period;
			self::$rates[$date_start]['buy'] = self::$rates[$date_start]['sell'];
			self::$rates[$date_start]['sell'] = 1 + $percent / 100;
		}
	}

    public static function getCurrentRates()
    {
	    if (empty(self::$rates)) self::calcRates();
        $current_rates = self::$rates[mktime(0,0,0)];
        return array('buy' => round($current_rates['buy'], 3), 'sell' => round($current_rates['sell'], 3));
    }

    public static function renderTable()
    {
	    if (empty(self::$rates)) self::calcRates();
        $html = '
        <style type="text/css">
        table.rates {
            border-width: 0px;
            border-spacing: 0px;
            border-style: solid;
            border-color: gray;
            border-collapse: collapse;
            background-color: white;
        }
        table.rates th {
            border-width: 1px;
            padding: 1px;
            border-style: outset;
            border-color: gray;
            background-color: white;
            -moz-border-radius: ;
            padding:3px;
        }
        table.rates td {
            border-width: 1px;
            padding: 1px;
            border-style: outset;
            border-color: gray;
            background-color: white;
            -moz-border-radius: ;
            padding:3px;
        }
        </style>
        <table class="rates">
            <tr class="first">
                <th>' . Yii::t('global', 'Date') . '</th>
                <th>' . Yii::t('gloabl', 'Buy') . '</th>
                <th>' . Yii::t('gloabl', 'Sell') . '</th>
            </tr>';
	    foreach (self::$rates as $date_start => $rates) {
		    $html .= '
            <tr>
                <th>'.date('Y-m-d', $date_start).'</th>
                <td>'.number_format($rates['buy'], 3).'</td>
                <td>'.number_format($rates['sell'], 3).'</td>
            </tr>';
	    }
        $html.= '</table>';
        return $html;
    }


}
