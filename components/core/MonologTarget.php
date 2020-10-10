<?php

namespace app\components\core;

use app\support\helpers\Params;
use Exception;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Ramsey\Uuid\Uuid;
use samdark\log\PsrTarget;
use Yii;

class MonologTarget extends PsrTarget
{
	/**
	 * @var string log file path or [path alias](guide:concept-aliases). If not set, it will use the "@runtime/logs/app.log" file.
	 * The directory containing the log files will be automatically created if not existing.
	 */
	public $logFile;

	public $maxLogFiles = 5;

	public $name;

	public $format = "[%datetime%][%channel%][%level_name%][%trace_id%]: %message% %context% %extra%\n";

	public function init()
	{
		if ($this->logger === null) {
			$psrLogger = new Logger($this->name);
			$psrLogger->pushHandler($handler = new RotatingFileHandler(
				$this->logFile = Yii::getAlias($this->logFile),
				$this->maxLogFiles,
				Logger::DEBUG,
				true
			));
			$psrLogger->pushProcessor(function (array $record) {
				try {
					$record['trace_id'] = Params::get(
						Params::get('noun.trace_id_header_name', function () {
							return Uuid::uuid4()->toString();
						})
					);
				} catch (Exception $e) {}

				return $record;
			});
			$formatter = new LineFormatter($this->format, $this->getTimeFormat(), true, true);
			$formatter->includeStacktraces();
			$handler->setFormatter($formatter);
			$this->logger = $psrLogger;
		}
	}

	protected function getTimeFormat()
	{
		return $this->microtime ? 'Y-m-d H:i:s.u' : 'Y-m-d H:i:s';
	}
}
