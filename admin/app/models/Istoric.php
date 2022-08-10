<?php
class Istoric extends Model{
    var $id_istoric;
    var $id_car;
    var $data_intrare_service;
    var $data_iesire_service;
    var $pret_manopera;
    var $pret_piese;
    var $pret_total;
    var $tip_operatie;
    var $km;
    var $descriere;

    public function get(){
      $SQL = 'SELECT * FROM istoric';
      $stmt = self::$_connection->prepare($SQL);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'istoric');
      return $stmt->fetchAll();
    }

    public function create(){
      $SQL = 'INSERT INTO istoric(id_car,data_intrare_service,data_iesire_service,pret_manopera,pret_piese,pret_total,tip_operatie,km,descriere) VALUE(:id_car,:data_intrare_service,:data_iesire_service,:pret_manopera,:pret_piese,:pret_total,:tip_operatie,:km,:descriere)';
      $stmt = self::$_connection->prepare($SQL);
      $stmt->execute(['id_car'=>$this->id_car,'data_intrare_service'=>$this->data_intrare_service,'data_iesire_service'=>$this->data_iesire_service,'pret_manopera'=>$this->pret_manopera,'pret_piese'=>$this->pret_piese,'pret_total'=>$this->pret_total,'tip_operatie'=>$this->tip_operatie,'km'=>$this->km,'descriere'=>$this->descriere]);
      return $stmt->rowCount();
    }

    public function find($id_istoric){
      $SQL = 'SELECT * FROM istoric WHERE id_istoric = :id_istoric';
      $stmt = self::$_connection->prepare($SQL);
      $stmt->execute(['id_istoric'=>$id_istoric]);
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Istoric');
      return $stmt->fetch();
    }

    public function update(){
      $SQL = 'UPDATE istoric 
              SET data_intrare_service =:data_intrare_service,data_iesire_service=:data_iesire_service, pret_manopera=:pret_manopera ,pret_piese=:pret_piese, pret_total=:pret_total,tip_operatie=:tip_operatie,km=:km, descriere=:descriere 
              WHERE id_istoric = :id_istoric';
      $stmt = self::$_connection->prepare($SQL);
      $stmt->execute(['data_intrare_service'=>$this->data_intrare_service,
                      'data_iesire_service'=>$this->data_iesire_service,
                      'pret_manopera'=>$this->pret_manopera,
                      'pret_piese'=>$this->pret_piese,
                      'pret_total'=>$this->pret_total,
                      'tip_operatie'=>$this->tip_operatie,
                      'km'=>$this->km,
                      'descriere'=>$this->descriere,
                      'id_istoric'=>$this->id_istoric]);
      return $stmt->rowCount();
    }



    public function delete(){
      $SQL = 'DELETE FROM istoric WHERE id_istoric = :id_istoric';
      $stmt = self::$_connection->prepare($SQL);
      $stmt->execute(['id_istoric'=>$this->id_istoric]);
      return $stmt->rowCount();
    }

  }


?>