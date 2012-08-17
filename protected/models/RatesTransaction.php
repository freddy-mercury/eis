<?php

/**
 * This is the model class for table "rates_transactions".
 *
 * The followings are the available columns in table 'rates_transactions':
 * @property integer $id
 * @property integer $member_id
 * @property integer $time
 * @property string $type
 * @property double $rate
 * @property double $quantity
 * @property integer $status
 * @property string $batch
 *
 * The followings are the available model relations:
 * @property Members $member
 */
class RatesTransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RatesTransaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rates_transactions';
	}

	public static function  getTypes()
	{
		return array(
			'buy' => Yii::t('global', 'Buy'),
			'sell' => Yii::t('global', 'Sell'),
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, time, status', 'numerical', 'integerOnly'=>true),
			array('rate, quantity', 'numerical'),
			array('type', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, member_id, time, type, rate, quantity, status, batch', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'member' => array(self::BELONGS_TO, 'Members', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'member_id' => 'Member',
			'time' => 'Time',
			'type' => 'Type',
			'rate' => 'Rate',
			'quantity' => 'Quantity',
			'status' => 'Status',
			'batch' => 'Batch',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('time',$this->time);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('status',$this->status);
		$criteria->compare('batch',$this->batch);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}