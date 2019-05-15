<?php
/**
 * ORM file
 *
 * PHP Version 7.2.15
 *
 * @category ORM
 * @package  ORM
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/ORM.php
 */

/**
 * Class Entity
 *
 * File ORM.php
 *
 * @category ORM
 * @package  ORM
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/ORM.php
 */
class ORM
{
    private $_bdd;

    /**
     * La function __construct se connecte a la bdd
     *
     * @return void
     */
    public function __construct()
    {
        try
        {
            $this->_bdd = new PDO(
                "mysql:host=localhost;dbname=My_cinema;charset=utf8", "root", ""
            );
            $this->_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Erreur $e)
        {
            die("Erreur : " . $e->getMessage());
        }    
    }

    /**
     * La function create insere une ligne en bdd
     *
     * @param string $table  le nom de table
     * @param array  $fields tableau de parametre
     *
     * @return void
     */
    public function create($table, $fields)
    {
        $table = $this->PDObackquote($table);
        $tab = "";
        $colonne = "";
        $val = "";
        $virgule = ", ";
        $tmp = 1;
        foreach ($fields as $key => $value) {
            if ($tmp == count($fields)) {
                $tmp = 1;
                $virgule = ")";
            }
            $colonne = $colonne . $key . $virgule;
            $val = $val . "'" . $value . "'" . $virgule;
            $tmp++;
        }
        $sql = "INSERT INTO " . $table . "(" . $colonne . " VALUES (" . $val;
        echo $sql;
        $query = $this->_bdd->query($sql);
    }

    /**
     * La function read lit une entree
     *
     * @param string $table    le nom de table
     * @param int    $id       l'id que l'on cherche
     * @param array  $relation tableau des relations
     *
     * @return $user
     */
    public function read($table, $id, $relation=null)
    {
        $table1 = $this->PDObackquote($table);
        $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
        $query = $this->bdd->query($sql);
        $user[$table] = $query->fetch();
        if ($relation != null) {
            foreach ($relation as $key => $value) {
                if ($value == "has many") {
                    $n1 = $table . "_" . $key;
                    $n2 = $key . "_" . $table;
                    $table_exist_1 = $this->tableExist($n1);
                    $table_exist_2 = $this->tableExist($n2);
                    $name_table = false;
                    if ($table_exist_1 == true) {
                        $name_table = $table_exist_1;
                    } elseif ($table_exist_2 == true) {
                        $name_table = $table_exist_2;
                    }
                    $user[$key] = [];
                    if ($name_table != false) {
                        $sql = "SELECT * FROM " . $name_table .
                            " WHERE id_" . $table . "= " . $id;
                        $query = $this->_bdd->query($sql);
                        $tab = $query->fetchAll();
                        foreach ($tab as $key2 => $value2) {
                                   $sql = "SELECT * FROM " . $key .
                                       " WHERE id=" . $value2['id_' . $table];
                                   $query = $this->_bdd->query($sql);
                                   $tab_content = $query->fetchAll();
                                   array_push($user[$key], $tab_content);
                        }
                    } else {
                        $sql = "SELECT * FROM " . $key .
                            " WHERE id_" . $table . "= " . $id;
                        $query = $this->_bdd->query($sql);
                        $tab = $query->fetchAll();
                        array_push($user[$key], $tab);
                    }
                } elseif ($value == "has one") {
                    $sql = "SELECT * FROM " . $key .
                        " WHERE id=" . $user[$table]['id_' . $key];
                    $query = $this->_bdd->query($sql);
                    $user[$key] = $query->fetch();
                }
            }
        }
        return $user;
    }

    /**
     * La function update met a jour une entree
     *
     * @param string $table  le nom de table
     * @param int    $id     l'id que l'on cherche
     * @param array  $fields tableau des relations
     *
     * @return void
     */
    public function update($table, $id, $fields)
    {
        $table = $this->PDObackquote($table);
        $tab = "";
        $virgule = "";
        $tmp = 0;
        foreach ($fields as $key => $value) {
            
            $tab = $tab . $virgule . $key . " = '" . $value . "'";
            if ($tmp == 0) {
                $tmp = 1;
                $virgule = ", ";
            }
        }
        $sql = "UPDATE " . $table . " SET " . $tab . " WHERE id = " . $id;
        echo $sql;
        $query = $this->_bdd->query($sql);
    }

    /**
     * La function delete supprime une entree
     *
     * @param string $table le nom de table
     * @param int    $id    l'id que l'on cherche
     *
     * @return void
     */
    public function delete($table, $id) 
    {
        $table = $this->PDObackquote($table);
        $sql = "DELETE FROM " . $table . " WHERE id = " . $id;
        $query = $this->_bdd->query($sql);
    }

    /**
     * La function find cherche une entree
     *
     * @param string $table    le nom de table
     * @param array  $params   tableau des des parametre
     * @param array  $relation tableau des relations
     *
     * @return $user
     */
    public function find($table, $params = array(
        'WHERE' => ['id'=>'2'],'ORDER BY' => 'id ASC','LIMIT' => ''), $relation=null
    ) {
        $table1 = $this->PDObackquote($table);
        $limit = " LIMIT " . $params['LIMIT'];
        if (empty($params['LIMIT'])) {
            $limit = "";
        }
        $sql = "SELECT * FROM " . $table1 . " WHERE " . key($params['WHERE'])
            . " = '" . $params['WHERE'][key($params['WHERE'])] .
            "' ORDER BY " . $params['ORDER BY'] . $limit;
        $query = $this->_bdd->query($sql);
        $user[$table] = $query->fetch();
        if ($relation != null) {
            foreach ($relation as $key => $value) {
                if ($value == "has many") {
                    $n1 = $table . "_" . $key;
                    $n2 = $key . "_" . $table;
                    $table_exist_1 = $this->tableExist($n1);
                    $table_exist_2 = $this->tableExist($n2);
                    $name_table = false;
                    if ($table_exist_1 == true) {
                        $name_table = $table_exist_1;
                    } elseif ($table_exist_2 == true) {
                        $name_table = $table_exist_2;
                    }
                    $user[$key] = [];
                    if ($name_table != false) {
                        $sql = "SELECT * FROM " . $name_table . " WHERE id_"
                            . $table . "= " . $user[$table]['id'];
                        $query = $this->_bdd->query($sql);
                        $tab = $query->fetchAll();
                        foreach ($tab as $key2 => $value2) {
                                   $sql = "SELECT * FROM " . $key . " WHERE id="
                                       . $value2['id_' . $table];
                                   $query = $this->_bdd->query($sql);
                                   $tab_content = $query->fetchAll();
                                   array_push($user[$key], $tab_content);
                        }
                    } else {
                        $sql = "SELECT * FROM " . $key . " WHERE id_"
                            . $table . "= " . $user[$table]['id'];
                        $query = $this->_bdd->query($sql);
                        $tab = $query->fetchAll();
                        array_push($user[$key], $tab);    
                        /*$user[$key] = $query->fetchAll();*/
                    }
                } elseif ($value == "has one") {
                    echo $user[$table]['id_' . $key];    
                    $sql = "SELECT * FROM " . $key . " WHERE id="
                        . $user[$table]['id_' . $key];
                    $query = $this->_bdd->query($sql);
                    $user[$key] = $query->fetch();
                }
            }
        }
        return $user;
    }

    /**
     * La function PDObackquote securise le nom des tables
     *
     * @param string $value le nom de table
     *
     * @return la table
     */
    public function PDObackquote($value)
    {
        if (is_array($value) ) {
            return implode(', ', array_map('PDObackquote', $value));
        }

        return '`'.str_replace(
            array('`', '.',"'"),
            array('``', '`.`'), $value
        ).'`';
    }

    /**
     * La function TableExist verifie qu une table existe
     *
     * @param string $table le nom de table
     *
     * @return $b
     */
    public function tableExist($table)
    {
        $b=false;
        $sql = $this->_bdd->query('show tables');
        while ($data = $sql->fetch()) {
            if ($data[0] == $table) {
                $b = $data[0];
            }
        }
        return $b;
    }
}