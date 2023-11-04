<?php
	/**
	 * Este es un archivo de configuración de ejemplo para la base de datos.
	 * Debe ser renombrado a dbConfig.php para que funcione.
	 *
	 * @return array - Array con los datos de configuración de la base de datos.
	 */
	return [
		'prod' => [
			'host'     => 'productionHost',
			'username' => 'productionUsername',
			'password' => 'productionPassword',
			'database' => 'prouctionDatabase'
		],
		'dev'  => [
			'host'     => 'developmentHost',
			'username' => 'developmentUsername',
			'password' => 'developmentPassword',
			'database' => 'developmentDatabase'
		]
	];