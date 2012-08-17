<?php
class Rates
{

    public static function getCurrentRates()
    {
        extract(Yii::app()->params['rates']);
        while ($date_start != mktime(0, 0, 0)) {
            $date_start+= $period;
            $buy = $sell;
            $sell*= 1 + $percent / 100;
        }
        return array('buy' => round($buy, 3), 'sell' => round($sell, 3));
    }

    public static function renderTable()
    {
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
        extract(Yii::app()->params['rates']);
        while ($date_start <= mktime(0, 0, 0, 12, 31)) {
            $style = $target = '';
            if((mktime(0, 0, 0) - $date_start) / $period == 10) {
                $target = '<a name="1"></a>';
            }
            elseif (mktime(0, 0, 0) == $date_start) {
                $style = ' style="color: red"';
            }
            $html .= '
            <tr'.$style.'>
                <th>'.$target.date('Y-m-d', $date_start).'</th>
                <td>'.number_format($buy, 3).'</td>
                <td>'.number_format($sell, 3).'</td>
            </tr>';
            $date_start+= $period;
            $buy = $sell;
            $sell*= 1 + $percent / 100;
        }
        $html.= '</table>';
        return $html;
    }


}
