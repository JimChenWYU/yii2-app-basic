<?php

namespace app\behaviors\core;

use app\support\helpers\Params;
use Ramsey\Uuid\Uuid;
use yii\base\Application;
use yii\base\Behavior;
use yii\web\Request;

class ApplicationBehavior extends Behavior
{
	/**
	 * @var Application
	 */
	public $owner;

	public function events()
	{
		return [
			Application::EVENT_BEFORE_REQUEST => 'beforeRequest',
			Application::EVENT_AFTER_REQUEST  => 'afterRequest',
		];
	}

	public function beforeRequest()
	{
		$request = $this->owner->getRequest();
		$idName = Params::get('noun.trace_id_header_name');
		if ($request->getIsConsoleRequest()) {
			$_id = Uuid::uuid4()->toString();
		} else {
			$_id = $request->getHeaders()->get($idName);
			if ($_id === null) {
				$_id = Uuid::uuid4()->toString();
			}
		}

		Params::set($idName, $_id);
	}

	public function afterRequest()
	{
		$request = $this->owner->getRequest();
		$response = $this->owner->getResponse();

		if ($request instanceof Request) {
			$response->getHeaders()->setDefault(
				Params::get('noun.trace_id_header_name'),
				$request->getHeaders()->get(Params::get('noun.trace_id_header_name'))
			);
		}
	}
}
