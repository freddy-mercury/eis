<?php

/**
 * This is the model class for table "mavro_sell_requests".
 *
 * The followings are the available columns in table 'mavro_sell_requests':
 * @property integer $id
 * @property integer $member_id
 * @property double $amount
 * @property double $rate
 * @property string $payment_info
 * @property integer $time
 * @property integer $status
 */
class MavroSellRequest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MavroSellRequest the static model class
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
		return 'mavro_sell_requests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, transaction_id, amount, rate, payment_info, time, status', 'required'),
			array('member_id, transaction_id, status time', 'numerical', 'integerOnly'=>true),
			array('amount, rate', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, member_id, amount, rate, payment_info, status, time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'member_id' => 'Member #',
			'transaction_id' => 'Transaction #',
			'amount' => 'Amount',
			'rate' => 'Rate',
			'payment_info' => 'Payment Info',
			'status' => 'Status',
			'time' => 'Time',
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
		$criteria->compare('amount',$this->amount);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('payment_info',$this->payment_info,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('time',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}