<?

class ArticleModel extends Entity
{
	private $bdd;
	private static $relation = ['comments' => 'has many', 'tag' => 'has many'];


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
		$req = $this->bdd->prepare("INSERT INTO article SET nom = :nom");
		$req->bindParam(':nom', $this->nom, PDO::PARAM_STR);
		$req->execute();
	}

	public function setNom($nom)
	{
		$this->nom = $nom;
	}

	public function getRelation()
	{
		return self::$relation;
	}
}