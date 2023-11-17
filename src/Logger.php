<?php
	/** @noinspection PhpPossiblePolymorphicInvocationInspection */

	namespace src;

    /**
     * Clase para escribir mensajes de log en un archivo de texto.
     *
     * Logger es una clase que implementa el patrón Singleton.<br>
     * Esto es, solo se puede crear una instancia de esta clase.
     * Para ello, se utiliza el método estático getInstance().
     *
     * @see     Singleton
     * @link     https://es.wikipedia.org/wiki/Singleton
     *           https://www.php.net/manual/es/language.oop5.patterns.php
     *
     * @access public
     * @author Daniel Alonso Lázaro <dalonsolaz@gmail.com>
     * @package src
     */

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
            echo
			$this->logFile = fopen(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'logs/log.txt', "a");
		}

		/**
		 * Función que busca crear o recuperar el objeto Logger y escribir en el archivo de texto el mensaje de log con
         * el formato [fecha] [ARCHIVO ⇒ path del archivo qu genera el log] [Tipo de log] ⇒ mensaje.
		 *
		 * @see Singleton::getInstance()
		 */
		public static function log(string $message, string $from, ?LogLevels $type = NULL): void
		{
			$type = $type??LogLevels::INFO;
			$logger = self::getInstance();
			$logger->writeLog($type, $from, $message);
		}

        /**
         * Función que escribe en el archivo de texto el mensaje de log.
         * @param LogLevels $type Tipo de mensaje de log.
         * @param $from
         * @param string $message Mensaje de log.
         * @return void
         * @see LogLevels
         */
		protected function writeLog(LogLevels $type, $from, string $message): void
		{
			$now = date("d/m/Y H:i:s");
			fwrite($this->logFile, "[$now] [ARCHIVO ⇒ $from] [$type->value] ⇒ $message.\n");
		}
	}