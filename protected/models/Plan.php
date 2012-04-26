<?php

/**
 * This is the model class for table "plans".
 *
 * The followings are the available columns in table 'plans':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property double $min
 * @property double $max
 * @property double $percent
 * @property string $percent_per
 * @property integer $periodicity
 * @property integer $term
 * @property boolean $compounding
 * @property integer $type
 * @property boolean $monfri
 * @property boolean $principal_back
 */
class Plan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Plan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getPercentPerOptions() {
        return array(
            'term' => Yii::t('global', 'Term'),
            'periodicity' => Yii::t('global', 'Periodicity'),
        );
    }

    public static function getTypesOptions() {
        return array(
            'public' => Yii::t('global', 'Public'),
            'user' => Yii::t('global', 'User'),
            'monitor' => Yii::t('global', 'Monitor'),
        );
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, min, max, percent', 'required'),
			array('periodicity, term, compounding, monfri, principal_back', 'numerical', 'integerOnly'=>true),
			array('min, max, percent', 'numerical'),
			array('name', 'length', 'max'=>255),
			array('percent_per', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, min, max, percent, percent_per, periodicity, term, compounding, type, monfri, principal_back', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('global', 'ID'),
			'name' => Yii::t('global', 'Name'),
			'description' => Yii::t('global', 'Description'),
			'min' => Yii::t('global', 'Min'),
			'max' => Yii::t('global', 'Max'),
			'percent' => Yii::t('global', 'Percent'),
			'percent_per' => Yii::t('global', 'Percent Per'),
			'periodicity' => Yii::t('global', 'Periodicity'),
			'term' => Yii::t('global', 'Term'),
			'compounding' => Yii::t('global', 'Compounding'),
			'type' => Yii::t('global', 'Type'),
			'monfri' => Yii::t('global', 'Monfri'),
			'principal_back' => Yii::t('global', 'Principal Back'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('min',$this->min);
		$criteria->compare('max',$this->max);
		$criteria->compare('percent',$this->percent);
		$criteria->compare('percent_per',$this->percent_per,true);
		$criteria->compare('periodicity',$this->periodicity);
		$criteria->compare('term',$this->term);
		$criteria->compare('compounding',$this->compounding);
		$criteria->compare('type',$this->type);
		$criteria->compare('monfri',$this->monfri);
		$criteria->compare('principal_back',$this->principal_back);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}