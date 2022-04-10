<?php

namespace Src\TableGateways;

class PersonGateway
{
  private $db = null;
  public function __construct($db)
  {
    $this->db = $db;
  }

  //GET ALL RECORDS
  public function getAll()
  {
    $statement = "
      SELECT
        id,
        firstname,
        lastname,
        firstparent_id,
        secondparent_id
      FROM person";

    try {
      $statement = $this->db->prepare($statement);
      $statement->execute();
      $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
      return $result;
    } catch (\PDOException $th) {
      exit($th->getMessage("mamchetech el get all"));
    }
  }

  //GET RECORD BY ID
  public function getById($id)
  {
    $statement = "
      SELECT
        id,
        firstname,
        lastname,
        firstparent_id,
        secondparent_id
      FROM person
      WHERE id = ?";

    try {
      $statement = $this->db->prepare($statement);
      $statement->execute([$id]);
      $result = $statement->fetch(\PDO::FETCH_ASSOC);
      return $result;
    } catch (\PDOException $th) {
      exit($th->getMessage("mamchetech el find bel id"));
    }
  }

  //INSERT RECORD
  public function insert(array $data)
  {
    $statement = "
      INSERT INTO person
        (firstname,
        lastname,
        firstparent_id,
        secondparent_id)
      VALUES
        (:firstname,
         :lastname,
         :firstparent_id,
         :secondparent_id)";

    try {
      $statement = $this->db->prepare($statement);
      $statement->execute(array(
        ':firstname' => $data['firstname'],
        ':lastname' => $data['lastname'],
        ':firstparent_id' => $data['firstparent_id'],
        ':secondparent_id' => $data['secondparent_id']
      ));
      return $statement->rowCount();
    } catch (\PDOException $th) {
      exit($th->getMessage("mamchetech el insert"));
    }
  }
}
