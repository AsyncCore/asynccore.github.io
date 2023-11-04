<?php

	namespace src;

	use Exception;

	/**
	 * Singleton es una clase que implementa el patrón Singleton.<br>
	 * Esto es, solo se puede crear una instancia de esta clase o de sus subclases.
	 * Para ello, se utiliza el método estático getInstance().
	 * No permite ni la creación ni la clonación de objetos Singleton.
	 * Además, si se intenta deserializar un objeto Singleton, se lanza una excepción que se escribe en el log como
	 * EXCEPTION.
	 *
	 * @see     Logger
	 * @link     https://es.wikipedia.org/wiki/Singleton
	 * @author  Daniel Alonso Lázaro <dalonsolaz@gmail.com>
	 * @access  public
	 * @package src
	 */
	class Singleton
	{
		/**
		 * @var array $instancias Array donde se almacenarán las instancias de la clase o de las subclases.
		 */
		private static array $instancias = [];

		/**
		 * Constructor vacío que impide que se cree una instancia de Singleton con el operador new.
		 *
		 * @return void
		 */
		protected function __construct(){}

		/**
		 * Función que devuelve una instancia de esta clase o de sus subclases.
		 * Si no existe la instancia, la crea y la devuelve.
		 * Si ya existe, la devuelve.
		 *
		 * @return Singleton
		 */
		public static function getInstance(): Singleton
		{
			$subclase = static::class;
			if(!isset(self::$instancias[$subclase])){
				self::$instancias[$subclase] = new static();
			}
			return self::$instancias[$subclase];
		}

		/**
		 * Función que se ejecuta cuando se intenta deserializar el objeto Singleton y que lanza una excepción para
		 * impedirlo. Además, escribe un mensaje de error en el log.
		 *
		 * @throws Exception
		 */
		public function __wakeup()
		{
			throw new Exception("No se puede deserializar un objeto singleton.");
		}

		/**
		 * Función vacía que impide que se clone el objeto Singleton.
		 *
		 * @return void
		 */
		protected function __clone(): void{}
	}

