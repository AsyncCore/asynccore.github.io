<?php
	/** @noinspection PhpPossiblePolymorphicInvocationInspection */

	namespace src\utils;

	use src\Singleton;

	class Logger extends Singleton
	{
		/**
		 * @var false|resource $logFile Archivo de texto donde se almacenarán los mensajes de log.
		 */
		private $logFile;

		/**
		 * Construye un objeto Logger y abre el archivo de texto donde se almacenarán los mensajes de log.
		 *
		 * @see Singleton
		 */
		protected function __construct()
		{
			parent::__construct();
			$this->logFile = fopen(__DIR__ . "/../../logs/log.txt", "a");
		}

		/**
		 * Función que busca crear o recuperar el objeto Logger y escribir en el archivo de texto el mensaje de log con
		 * el formato [fecha] [archivo que genera el log] mensaje.
		 *
		 * @see Singleton::getInstance()
		 */
		public static function log(string $message, string $from, ?LogLevels $type = NULL): void
		{
			$type = $type??LogLevels::INFO;
			$logger = self::getInstance();
			$logger->writeLog($type, getFilePath($from), $message);
		}

		/**
		 * Función que escribe en el archivo de texto el mensaje de log.
		 *
		 * @param LogLevels $type    Tipo de mensaje de log.
		 *
		 * @param string    $message Mensaje de log.
		 *
		 * @return void
		 * @see LogLevels
		 */
		protected function writeLog(LogLevels $type, $from, string $message): void
		{
			$now = date("d/m/Y H:i:s");
			fwrite($this->logFile, "[$now] [ARCHIVO => $from] [$type->value] => $message.\n");
		}
	}