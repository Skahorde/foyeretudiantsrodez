<?php

namespace App\Repositories;

use App\Converters\StringConverter;
use App\Models\Model;

/**
 * Classe de base pour tous les entrepôts de données.
 *
 * @author Thomas SAYER <thomas.sayer@edf.fr>
 */
abstract class Repository
{
	/**
	 * Instance de PDO qui permet d'effectuer les requêtes SQL.
	 * 
	 * @var PDO
	 */
	protected static $pdo;

	/**
	 * Nom du modèle associé à l'entrepôt de données.
	 * 
	 * @var string
	 */
	protected $model;

	/**
	 * Nom de la table de la base de données à manipuler dans le repository.
	 * 
	 * @var string
	 */
	protected $table;

	/**
	 * Nom du / des champs représentant la clé primaire dans la table (par
	 * défaut "id").
	 * 
	 * @var string|array
	 */
	protected $primaryKey = 'id';

	/**
	 * Construit l'instance statique PDO si elle n'existe pas, génère le nom
	 * de la table par défaut et définie le nom du modèle associé s'il ne sont
	 * pas renseignés.
	 */
	protected function __construct()
	{
		if (!isset(self::$pdo))
		{
			self::$pdo = self::getPdoInstance();
		}

		if (empty($this->table))
		{
			$this->table = $this->getDefaultTableName();
		}

		if (empty($this->model))
		{
			$this->model = $this->getDefaultModelName();
		}
	}

	/**
	 * Crée une ligne dans la base de données, représentative du modèle en
	 * paramètre.
	 * 
	 * @param App\Models\Model $object
	 * @return boolean
	 */
	public function create(Model $object)
	{
		if (!$object instanceof $this->model)
		{
			throw new \Exception("L'objet spécifié n'est pas une instance de $this->model !");
		}

		$values = $object->toArray(false);

		$fieldsName = array_keys($values);
		$valuesName = implode(',', array_map(function($f) { return ":$f"; }, $fieldsName));
		$fieldsName = implode(',', $fieldsName);

		$st = self::$pdo->prepare(
			"INSERT INTO $this->table
			 ($fieldsName) VALUES ($valuesName);"
		);

		foreach ($values as $key => $value)
		{
			$values[":$key"] = $value;
			unset($values[$key]);
		}

		$st->execute($values) || die(print_r($st->errorInfo()));

		$result = $st->rowCount() > 0;

		if ($result)
		{
			$result = $this->find(self::$pdo->lastInsertId());
		}

		$st->closeCursor();

		return $result;
	}

	/**
	 * Modifie un modèle dans la base de données.
	 * 
	 * @param mixed $id
	 * @param array $attributes
	 */
	public function update($id, array $attributes)
	{
		$fieldsExp = '';
		$values = [];

		foreach ($attributes as $name => $value)
		{
			$fieldsExp .= "$name = :$name,";
			$values[":$name"] = $value;
		}

		$fieldsExp = substr_replace($fieldsExp, '', -1);

		$data = $values;
		$primaryKeyWhere = $this->getPrimaryKeyWhere($id, $data);

		$st = self::$pdo->prepare(
			"UPDATE $this->table
			 SET $fieldsExp
			 WHERE $primaryKeyWhere;"
		);

		$st->execute($data) || die(print_r($st->errorInfo()));

		$st->closeCursor();
	}

	/**
	 * Récupère le modèle qui a l'id spécifié en paramètre dans la base de
	 * données.
	 * 
	 * @param mixed $id
	 * @return App\Models\Model
	 */
	public function find($id)
	{
		$data = [];
		$primaryKeyWhere = $this->getPrimaryKeyWhere($id, $data);

		$st = self::$pdo->prepare(
			"SELECT *
			 FROM $this->table
			 WHERE $primaryKeyWhere;"
		);

		$st->execute($data) || die(print_r($st->errorInfo()));

		$modelName = $this->model;

		$result = $st->fetch(\PDO::FETCH_ASSOC);

		if ($result !== false)
		{
			$result = new $modelName($result);
		}
		else
		{
			$result = null;
		}

		$st->closeCursor();

		return $result;
	}

	/**
	 * Retourne toutes les instances contenues dans la table de la base de
	 * données.
	 * 
	 * @return array
	 */
	public function all()
	{
		$st = self::$pdo->prepare(
			"SELECT *
			 FROM $this->table;"
		);

		$st->execute() || die(print_r($st->errorInfo()));

		$modelName = $this->model;

		$objects = $st->fetchAll(\PDO::FETCH_ASSOC);

		foreach ($objects as &$object)
		{
			$object = new $modelName($object);
		}

		$st->closeCursor();

		return $objects;
	}

	/**
	 * Détruit la ligne d'id en paramètre dans la table de la base de données.
	 * 
	 * @param mixed $id
	 * 
	 * @return boolean
	 */
	public function destroy($id)
	{
		$data = [];
		$primaryKeyWhere = $this->getPrimaryKeyWhere($id, $data);

		$st = self::$pdo->prepare(
			"DELETE FROM $this->table
			 WHERE $primaryKeyWhere"
		);

		$st->execute($data) || die(print_r($st->errorInfo()));

		$count = $st->rowCount();

		$st->closeCursor();

		return $count > 0;
	}

	/**
	 * Détermine et retourne la requête WHERE associée à la clé primaire.
	 * 
	 * @param mixed $id
	 * @param array &$data
	 * @return string
	 */
	private function getPrimaryKeyWhere($id, &$data)
	{
		if (is_array($this->primaryKey))
		{
			$primaryKeyWhere = '';
			foreach ($this->primaryKey as $i => $field)
			{
				if ($i > 0)
				{
					$primaryKeyWhere .= ' AND ';
				}

				$primaryKeyWhere .= "$field = :$field";
				$data[":$field"] = $id[$field];
			}
		}
		else
		{
			$primaryKeyWhere = "$this->primaryKey = :id";
			$data[':id'] = $id;
		}

		return $primaryKeyWhere;
	}

	/**
	 * Retourne le nom de la table sur laquelle travaille l'entrepôt de données.
	 * 
	 * @return string
	 */
	public function getTable()
	{
		return $this->table;
	}

	/**
	 * Retourne le nom de la table par défaut en fonction du nom du repository
	 * (en snake_case et au pluriel).
	 * 
	 * @return string
	 */
	private function getDefaultTableName()
	{
		return StringConverter::plural(
			StringConverter::pascalToSnake(
				str_replace('Repository', '', (new \ReflectionClass($this))->getShortName())
			)
		);
	}

	/**
	 * Retourne le(s) nom(s) de(s) clé(s) primaire(s) de la table associée au
	 * repository.
	 * 
	 * @return string|array
	 */
	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

	/**
	 * Retourne le nom du modèle par défaut en fonction du nom du repository.
	 * 
	 * @return string
	 */
	protected function getDefaultModelName()
	{
		return 'App\\Models\\' . str_replace('Repository', '', (new \ReflectionClass($this))->getShortName());
	}

	/**
	 * Construit et retourne une instance de PDO pour communiquer avec la base
	 * de données dont les informations de connexion sont situées dans le
	 * fichier "/config/database.ini".
	 *
	 * @return \PDO
	 */
	public static function getPdoInstance()
	{
		$app = parse_ini_file(__DIR__ . '/../../config/app.ini');

		$db = parse_ini_file(__DIR__ . '/../../config/database.ini', true)[$app['env']];

		try
		{
			$pdo = new \PDO(
				"{$db['driver']}:dbname={$db['database']};host={$db['host']};port={$db['port']}",
				$db['username'],
				base64_decode($db['password'])
			);
		}
		catch (\PDOException $e)
		{
			die ("Hu hu ! Une erreur s'est produite lors de la connexion à la base de données : " . $e->getMessage());
		}

		return $pdo;
	}
}
