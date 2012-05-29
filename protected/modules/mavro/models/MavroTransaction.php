<?php

/**
 * This is the model class for table "mavro_transactions".
 *
 * The followings are the available columns in table 'mavro_transactions':
 * @property integer $id
 * @property integer $member_id
 * @property string $type
 * @property double $amount
 * @property double $sum
 * @property integer $time
 * @property integer $status
 */
class MavroTransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MavroTransaction the static model class
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
		return 'mavro_transactions';
	}

	public static function getTypes() {
		return array(
			'buy' => Yii::t('mavro', 'Buy'),
			'sell' => Yii::t('mavro', 'Sell'),
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
			array('member_id, type, amount, sum, time, status', 'required'),
			array('member_id, time, status', 'numerical', 'integerOnly'=>true),
			array('amount, sum', 'numerical'),
			array('type', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, member_id, type, amount, sum, time, status', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('mavro', 'ID'),
			'member_id' => Yii::t('mavro', 'Member'),
			'type' => Yii::t('mavro', 'Type'),
			'amount' => Yii::t('mavro', 'Amount'),
			'time' => Yii::t('mavro', 'Time'),
			'status' => Yii::t('mavro', 'Status'),
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('time',$this->amount);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}