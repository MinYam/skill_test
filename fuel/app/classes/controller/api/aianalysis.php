<?php
/**
 * 仮想 AI ANALYSIS API
 * successとerrorの2パターンをレスポンスするだけ
 */

use Fuel\Core\Controller_Rest;

class Controller_Api_Aianalysis extends Controller_Rest
{
	public function get_index()
	{
		$this->format = 'json';
		$mode = Input::get('mode');
		$response_data = array();
		switch ($mode) {
			case 'success':
				$response_data['success'] = true;
				$response_data['message'] = 'success';
				$response_data['estimated_data'] = array(
					'class' => 3,
					'confidence' => 0.8683,
				);
				break;

			case 'error':
				$response_data['success'] = false;
				$response_data['msg'] = 'Error:E50012';
				$response_data['estimated_data'] = array();
				break;
			default:
				break;
		}
		return $this->response($response_data, 200);
	}
}
