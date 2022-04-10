<?php

namespace Src\TableGateways;

class PersonGateway
{
  private $db = null;
  public function __construct($db)
  {
    $this->db = $db;
  }

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
      exit($th->getMessage("mamchetech"));
    }
  }
}
