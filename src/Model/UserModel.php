<?php

class UserModel extends Entity
{
    private $email;
    private $password;
    private $bdd;

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
        $req = $this->bdd->prepare("INSERT INTO users SET email = :email, password = :password");
        $req->bindParam(':email', $this->email, PDO::PARAM_STR);
        $req->bindParam(':password', $this->password, PDO::PARAM_STR);
        $req->execute();
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function login()
    {
        $req = $this->bdd->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $req->bindParam(':email', $this->email, PDO::PARAM_STR);
        $req->bindParam(':password', $this->password, PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetch();
        if (empty($user)) {
            echo "Veuillez verifier vos informations de login";
        }
    }

    public function create($email, $password)
    {
        $req = $this->bdd->prepare("INSERT INTO users SET email = :email, password = :password");
        $req->bindParam(':email', $email, PDO::PARAM_STR);
        $req->bindParam(':password', $password, PDO::PARAM_STR);
        $req->execute();
        $req = $this->bdd->prepare("SELECT * FROM users WHERE email = :email AND password = :password ");
        $req->bindParam(':email', $email, PDO::PARAM_STR);
        $req->bindParam(':password', $password, PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetch();
        return $user["id"];    
    }

    public function read($id)
    {
        $req = $this->bdd->prepare("SELECT * FROM users WHERE id = :id");
        $req->bindParam(':id', $id, PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetch();
        return $user;
    }

    public function update($id)
    {
        $req = $this->bdd->prepare("UPDATE users SET email = :email, password = :password WHERE id = :id");
        $req->bindParam(':id', $id, PDO::PARAM_STR);
        $req->bindParam(':email', $this->email, PDO::PARAM_STR);
        $req->bindParam(':password', $this->password, PDO::PARAM_STR);
        $req->execute();
    }

    public function delete($id)
    {
        $req = $this->bdd->prepare("DELETE FROM users WHERE id = :id");
        $req->bindParam(':id', $id, PDO::PARAM_STR);
        $req->execute();
    }

    public function read_all()
    {
        $req = $this->bdd->prepare("SELECT * FROM users");
        $req->bindParam(':id', $id, PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetch();
        return $user;
    }
}
