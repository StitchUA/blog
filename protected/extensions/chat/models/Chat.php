<?php

/**
 * This is the model class for table "tbl_chat".
 *
 * The followings are the available columns in table 'tbl_chat':
 * @property integer $pk_chat_id
 * @property integer $user_id
 * @property string $date_create
 * @property string $message
 */
class Chat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Chat the static model class
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
		return 'tbl_chat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, date_create, message', 'required'),
			array('message', 'length', 'max'=>100, 'message' => 'Too long message!'),
                        array('message', 'length', 'min'=>3, 'message' => 'Too short message!'),
                        array('message', 'length', 'allowEmpty'=>false, 'message' => 'Message can not be empty!' ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pk_chat_id, user_name, date_create, message', 'safe', 'on'=>'search'),
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
			'pk_chat_id' => 'Pk Chat',
			'user_name' => 'User',
			'date_create' => 'Date Create',
			'message' => 'Message',
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

		$criteria->compare('pk_chat_id',$this->pk_chat_id);
		$criteria->compare('user_name',$this->user_name);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}