<?php
    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    
    namespace src;
    
    use Exception;
    
    /**
     * Clase para escribir mensajes de log en un archivo de texto.
     *
     * Implementa el patrón Singleton para asegurar una única instancia por archivo de log.
     *
     * @package src
     * @see     Singleton
     * @see     LogLevels
     * @link    https://es.wikipedia.org/wiki/Singleton
     * @author  Daniel Alonso Lázaro <dalonsolaz@gmail.com>
     */
    class Logger extends Singleton
    {
        /**
         * Archivo de texto donde se almacenarán los mensajes de log.
         *
         * @var false|resource $logFile
         */
        private $logFile;
        
        /**
         * Constructor que abre el archivo de texto para almacenar los mensajes de log.
         *
         * @param string $file Nombre del archivo de log.
         *
         * @throws Exception Si falla la apertura del archivo.
         */
        protected function __construct($file)
        {
            parent::__construct();
            $this->logFile = fopen(DIR . DIRECTORY_SEPARATOR . "logs/" . $file, "a");
            if (!$this->logFile) {
                throw new Exception("Error al abrir el archivo de log.");
            }
        }
        
        /**
         * Destructor de la clase Logger.
         *
         * Cierra el archivo de log si está abierto.
         * @access public
         */
        public function __destruct()
        {
            $this->closeLogFile();
        }
        
        /**
         * Cierra el archivo de log si está abierto.
         * @access public
         * @return void
         */
        public function closeLogFile(): void
        {
            if (is_resource($this->logFile)) {
                fclose($this->logFile);
                $this->logFile = null;
            }
        }
        
        /**
         * Escribe un mensaje de log.
         *
         * Crea o recupera el objeto Logger y escribe el mensaje en el archivo de log.<br>
         * <b>[fecha] [ARCHIVO ⇒ path del archivo qu genera el log] [Tipo de log] ⇒ mensaje.</b>
         *
         * @param string         $message Mensaje de log.
         * @param string         $from    Ruta del archivo que genera el log.
         * @param LogLevels|null $type    Tipo de mensaje de log. Por defecto, LogLevels::INFO.
         *
         * @access public
         * @return void
         * @see    Singleton::getInstance()
         * @see    LogLevels
         */
        public static function log(string $message, string $from, ?LogLevels $type = LogLevels::DEFAULT): void
        {
            $logger = self::getInstance($type->value);
            $logger->writeLog($type, $from, $message);
        }
        
        /**
         * Función que escribe el mensaje de log en el archivo de texto.
         *
         * @param LogLevels $type    Tipo de mensaje de log.
         * @param string    $from    Path del archivo que genera el log.
         * @param string    $message Mensaje de log.
         *
         * @access protected
         *
         * @return void
         * @see    LogLevels
         */
        protected function writeLog(LogLevels $type, string $from, string $message): void
        {
            $now = date("d/m/Y H:i:s");
            fwrite($this->logFile, "[$now] [ARCHIVO ⇒ $from] [$type->value] ⇒ $message.\n");
        }
    }