<?php

/**
 * This is the model class for table "transactions".
 *
 * The followings are the available columns in table 'transactions':
 * @property integer $id
 * @property integer $member_id
 * @property integer $parent_id
 * @property string $type
 * @property double $amount
 * @property integer $status
 * @property integer $time
 * @property string $batch
 */
class Transaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Transaction the static model class
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
		return 'transactions';
	}

	public static function getTypes() {
		return array(
			'd' => Yii::t('global', 'Deposit'),
			'i' => Yii::t('global', 'Investment'),
			'w' => Yii::t('global', 'Withdrawal'),
			'e' => Yii::t('global', 'Earning'),
			'b' => Yii::t('global', 'Bonus'),
			'p' => Yii::t('global', 'Penalty'),
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
			array('member_id, parent_id, type, amount, time, batch', 'required'),
			array('member_id, parent_id, status, time', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('type', 'length', 'max'=>1),
			array('batch', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, member_id, parent_id, type, amount, status, time, batch', 'safe', 'on'=>'search'),
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
			'member_id' => 'Member',
			'parent_id' => 'Parent',
			'type' => 'Type',
			'amount' => 'Amount',
			'status' => 'Status',
			'time' => 'Time',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('status',$this->status);
		$criteria->compare('time',$this->time);
		$criteria->compare('batch',$this->batch,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}