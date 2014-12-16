<?php

use \Admin\PostsModel as PostsModel;

class HomeController extends BaseController {

	protected $pagseguro;
	protected $historico;

	public function __construct(\PagSeguro $pagseguro, \HistoricoPagSeguro $historico)
	{
		$this->pagseguro = $pagseguro;
		$this->history = $historico;
	}

	/**
	 * [showPage description]
	 * @param  [type] $lang [description]
	 * @param  string $slug [description]
	 * @return [type]       [description]
	 */
	public function showPage($lang, $slug = 'index'){
		App::setLocale($lang);

		// Get page by $slug for given $lang
		$dir_path = app_path() . '/pages/' . $lang . '/';
		$page_path = $dir_path . Helpers\I18nHelper::getPageFileNameFromSlug($lang, $slug) . '.php';

		if (!File::exists($dir_path)) {
			Log::error("LANGUAGE {$lang} DOESN'T EXIST");
			App::abort(404);
		}

		if (!File::exists($page_path)) {
			Log::error("PAGE {$slug} DOESN'T EXIST FOR LANGUAGE {$lang}");
			App::abort(404);
		}

		$content = File::get($page_path);

		return View::make("pages.showPage", ['lang' => $lang, 'slug' => $slug, 'content' => $content]);
	}

	/**
	 * [showPost description]
	 * @param  [type] $lang [description]
	 * @param  [type] $slug [description]
	 * @return [type]       [description]
	 */
	public function showPost($lang, $slug){
		App::setLocale($lang);

		// Get page by $slug for given $lang
		$dir_path = app_path() . DIRECTORY_SEPARATOR . "posts" . DIRECTORY_SEPARATOR;
		$page_path = $dir_path . $slug . DIRECTORY_SEPARATOR . $lang . '.php';

		$postModel = new PostsModel($dir_path);

		if (!File::exists($page_path)) {
			Log::error("POST {$slug} DOESN'T EXIST FOR LANGUAGE {$lang}");
			App::abort(404);
		}

		$content = $postModel->get($slug, $lang);

		return View::make("posts.showPost", ['lang' => $lang, 'slug' => $slug, 'content' => $content]);
	}

	/**
	 * [notification description]
	 * @return [type] [description]
	 */
	public function notification()
	{
		$data['transactionType'] = $_POST['notificationType'];
		$data['code'] = $_POST['notificationCode'];

		$transaction = $this->history->checkTransaction(
			$data['transactionType'],
			$this->pagueseguro->credentials(),
			$data['code']);

		// get transaction reference
		$data['reference'] = $this->history->reference($transaction);

		$data['transactionStatus'] = $transaction->getStatus()->getValue();

		$data['date'] = (new DateTime($transaction->getDate()))->format('d-m-Y');

		// if exists throws eception
		$notification = $this->history->getNotificationByCode($data['code']);

		$history = $this->history->create($data);

		$this->contasReceber->updateBilletDueNotification(
			$data['transactionStatus'],
			$data,
			$document);
	}
}