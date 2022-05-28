<?php
class Membre {
    public  function  __construct(){
        $this->bdd = bdd();
    }


    //Create

    public function addAdmin($userDate,$nom,$prenom,$slug,$email,$phone,$iso_phone,$dial_phone){
        $query = "INSERT INTO admin(admin_date,nom,prenom,slug,email,phone,iso_phone,dial_phone)
            VALUES (:userDate,:nom,:prenom,:slug,:email,:phone,:iso_phone,:dial_phone)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "userDate" => $userDate,
            "nom" => $nom,
            "prenom" => $prenom,
            "slug" => $slug,
            "email" => $email,
            "phone" => $phone,
            "iso_phone" => $iso_phone,
            "dial_phone" => $dial_phone
        ));

        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }
    public function newPassword($password,$valid,$id){
        $query = "UPDATE admin
            SET mot_de_passe = :password , email_valid =:valid WHERE id_admin = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "password" => $password,
            "valid" => $valid,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }


    // Read

    public function getAdminByEmail($email){

        $query = "SELECT * FROM admin
        WHERE email = :email";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "email" => $email
        ));

        return $rs;
    }

    public function getAdminById($id){

        $query = "SELECT * FROM admin
        WHERE id_admin = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        return $rs;
    }

    public function getAllAdmin(){
        $query = "SELECT * FROM admin
        WHERE role = 0 ORDER BY id_admin DESC";
        $rs = $this->bdd->query($query);

        return $rs;
    }
    public function updateBloquer($etat,$id){
        $query = "UPDATE admin
            SET bloquer = :etat
            WHERE id_admin = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "etat" => $etat,
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

$membre = new Membre();