<?php
class User {
    public  function  __construct(){
        $this->bdd = bdd();
    }





    // Read
    public function getAllUserReunion(){
        $query = "SELECT * FROM reunion ORDER BY id_reunion DESC";
        $rs = $this->bdd->query($query);
        return $rs;
    }


    public function getAllUsers(){
        $query = "SELECT * FROM membre
                  WHERE bloquer = 1 ORDER BY id_membre  DESC";
        $rs = $this->bdd->query($query);

        return $rs;
    }
 public function getAllUser(){
        $query = "SELECT * FROM membre ORDER BY id_membre  DESC";
        $rs = $this->bdd->query($query);

        return $rs;
    }

    public function getUserById($id){

        $query = "SELECT * FROM membre
        WHERE id_membre = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        return $rs;
    }



    // Update

    public function updateBloquer($etat,$id){
        $query = "UPDATE membre
            SET bloquer = :etat
            WHERE id_membre = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "etat" => $etat,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }
    // Delete
    public function deleteUser($id){

        $query = "DELETE  FROM membre WHERE id_membre  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }

    public function deleteUserReunion($id){

        $query = "DELETE  FROM reunion WHERE id_reunion  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }


    // Verification valeur existant
    public function verifUtilisateur($propriete,$val){

        $query = "SELECT * FROM admin WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }


    // update


    public function updateAdminPhoto($photo,$id){
        $query = "UPDATE admin
            SET photo = :photo
            WHERE id_admin = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "photo" => $photo,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }

    public function updateData($propriete,$val,$id){
        $query = "UPDATE admin
            SET $propriete = :val
            WHERE id_admin = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;
    }

    public function updatePassword($password,$id){
        $query = "UPDATE admin
            SET mot_de_passe = :password WHERE id_admin = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "password" => $password,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }
    public function updateData2($propriete1,$val1,$propriete2,$val2,$id){
        $query = "UPDATE admin
            SET $propriete1 = :val1, $propriete2 = :val2
            WHERE id_admin = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val1" => $val1,
            "val2" => $val2,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;
    }
    public function updateData7($propriete1,$val1,$propriete2,$val2,$propriete3,$val3,$propriete4,$val4,$propriete5,$val5,$propriete6,$val6,$id){
        $query = "UPDATE admin
            SET $propriete1 = :val1, $propriete2 = :val2, $propriete3 = :val3, $propriete4 = :val4, $propriete5 = :val5, $propriete6 = :val6
            WHERE id_admin = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val1" => $val1,
            "val2" => $val2,
            "val3" => $val3,
            "val4" => $val4,
            "val5" => $val5,
            "val6" => $val6,

            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;
    }
    public function updateData8($propriete1,$val1,$propriete2,$val2,$propriete3,$val3,$propriete4,$val4,$propriete5,$val5,$propriete6,$val6,$propriete7,$val7,$id){
        $query = "UPDATE admin
            SET $propriete1 = :val1, $propriete2 = :val2, $propriete3 = :val3, $propriete4 = :val4, $propriete5 = :val5, $propriete6 = :val6, $propriete7 = :val7
            WHERE id_admin = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val1" => $val1,
            "val2" => $val2,
            "val3" => $val3,
            "val4" => $val4,
            "val5" => $val5,
            "val6" => $val6,
            "val7" => $val7,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;
    }



}
// Instance

$user = new User();