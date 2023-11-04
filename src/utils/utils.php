<?php
	/**
	 * Función que transforma una fecha en formato 'Y-m-d H:i:s' a 'd/m/Y H:i:s'.
	 *
	 * @param string $date Fecha en formato Y-m-d H:i:s.
	 *
	 * @return string Fecha en formato d/m/Y H:i:s.
	 */
	function formatDate(string $date): string
	{
		return date_format(date_create($date), 'd/m/Y H:i:s');
	}

	function getFilePath($filePath): string
	{
		$projectRoot = realpath(__DIR__ . '/../../');
		$fullPath = realpath($filePath);
		return str_replace($projectRoot, '', $fullPath);
	}
