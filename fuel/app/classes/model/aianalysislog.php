<?php

class Model_AiAnalysisLog extends \Orm\Model
{
	protected static $_properties = array(
		'id' => array(
			'label' => 'Id',
		),
		'image_path' => array(
			'label' => 'Image path',
			'data_type' => 'varchar',
		),
		'success' => array(
			'label' => 'Success',
			'data_type' => 'varchar',
		),
		'message' => array(
			'label' => 'Message',
			'data_type' => 'varchar',
		),
		'class' => array(
			'label' => 'Class',
			'data_type' => 'int',
			'validation'
		),
		'confidence' => array(
			'label' => 'Confidence',
			'data_type' => 'decimal',
		),
		'request_timestamp' => array(
			'label' => 'Request timestamp',
			'data_type' => 'int',
		),
		'response_timestamp' => array(
			'label' => 'Response timestamp',
			'data_type' => 'int',
		),
	);

	protected static $_table_name = 'ai_analysis_log';

	protected static $_primary_key = array('id');

	protected static $_conditions = array(
		'order_by' => array('id' => 'desc'),
	);
}
