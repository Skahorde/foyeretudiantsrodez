<?php

namespace App\Repositories;

use App\Models\Animation;
use App\Models\File;
use Core\Singleton;

/**
 * Représente un entrepôt de données sur les fichiers stockés sur le serveur.
 *
 * @version 0.1
 */
class StorageRepository implements Singleton
{
	/**
	 * Instance Singleton.
	 * 
	 * @var \App\Repository\StorageRepository
	 */
	private static $instance;

	/**
	 * Retourne l'instance Singleton de la classe ou en crée une nouvelle si
	 * aucune instance n'existe.
	 *
	 * @static
	 * @return \App\Repository\StorageRepository
	 */
	public static function getInstance()
	{
		if (!isset(self::$instance))
		{
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Déplace le fichier vers un dossier spécifié.
	 *
	 * @param \App\Models\File &$from
	 * @param string $to
	 * @return boolean
	 */
	public function move(File &$from, $to)
	{
		$moved = move_uploaded_file($from->filepath, "$to/$from->filename");

		if ($moved)
		{
			$from->filepath = "$to/$from->filename";
		}

		return $moved;
	}

	/**
	 * Supprime un fichier du serveur.
	 * 
	 * @param string $filepath
	 * @return boolean
	 */
	public function destroy($filepath)
	{
		return unlink($filepath);
	}

	/**
	 * Transforme le tableaux des fichiers entrants (variable $_FILES) en un
	 * tableau plus simple à manipuler.
	 *
	 * @see http://php.net/manual/fr/reserved.variables.files.php#121618
	 * 
	 * @param array $files
	 * @return array
	 */
	public function incomingFiles($files)
	{
		$files2 = [];
		foreach ($files as $input => $infoArr)
		{
			$filesByInput = [ ];
			foreach ($infoArr as $key => $valueArr)
			{
				if (is_array($valueArr))
				{
					foreach($valueArr as $i => $value)
					{
						$filesByInput[$i][$key] = $value;
					}
				}
				else
				{
					$filesByInput[] = $infoArr;
					break;
				}
			}
			$files2 = array_merge($files2, $filesByInput);
		}

		$files3 = [];
		foreach($files2 as $file)
		{
			if (!$file['error'])
			{
				$files3[] = $file;
			}
		}

		return $files3;
	}
}
