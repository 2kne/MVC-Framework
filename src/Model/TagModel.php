<?

class TagModel extends Entity
{
	private $bdd;
	private static $relation = ['article' => 'has many'];


	public function __construct($para)
	{
		parent::__construct($para);
		try
		{
			$this->bdd = new PDO("mysql:host=localhost;dbname=PiePHP;charset=utf8", "root", "");
			$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (Erreur $e)
		{
			die("Erreur : " . $e->getMessage());
		}	
	}

	public function save()
	{
		$req = $this->bdd->prepare("INSERT INTO comments SET nom = :nom, id_article = :id_article");
		$req->bindParam(':nom', $this->nom, PDO::PARAM_STR);
		$req->bindParam(':id_article', $this->id_article, PDO::PARAM_INT);
		$req->execute();
	}

	public function getRelation()
	{
		return self::$relation;
	}
}