<?php

class Controller_Analysis extends Controller_Template
{
	/**
	 * 本当は http://example.com だが動作確認用の仮想APIを一旦定義
	 *
	 * @var string AI_ANALYSIS_URL
	 */
	const AI_ANALYSIS_URL = 'http://localhost/api/aianalysis/index';

	public function before()
	{
		parent::before();
		$this->template->title = 'Klavis 技術テスト';
	}

	public function action_index()
	{
		$post = Input::post();

		// 正常系
		if (isset($post['success'])) {
			$this->ai_analysis($post['image_path'], 'success');

		// 異常系
		} elseif (isset($post['error'])) {
			$this->ai_analysis($post['image_path'], 'error');

		}

		$data['logs'] = Model_AiAnalysisLog::find('all');
		$this->template->content = View::forge('analysis/index', $data);
	}

	/**
	 * 画像分析実施
	 *
	 * @param string $image_path
	 * @param string $mode モックアップ操作切り分け用
	 * @return boolean $body['success']
	 */
	protected function ai_analysis($image_path, $mode)
	{
		$log = Model_AiAnalysisLog::forge();
		$curl = Request::forge(self::AI_ANALYSIS_URL, 'curl');

		$curl->set_method('get');
		$curl->set_params(array('image_path' => $image_path));
		$curl->set_params(array('mode' => $mode)); // モックアップ操作切り分け用

		$log->set('request_timestamp', Date::forge()->get_timestamp());
		$response = $curl->execute()->response();
		sleep(1); // タイムスタンプ動作確認用
		$log->set('response_timestamp', Date::forge()->get_timestamp());

		$body = json_decode($response->body(), true);
		$log->set(array(
			'image_path' => $image_path,
			'success' => $body['success'] ? 'success' : 'failure',
			'message' => $body['success'] ? $body['message'] : $body['msg'],
			'class' => $body['success'] ? $body['estimated_data']['class'] : null,
			'confidence' => $body['success'] ? $body['estimated_data']['confidence'] : null,
		));
		$log->save();

		return $body['success'];
	}
}
