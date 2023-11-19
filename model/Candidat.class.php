<?php
class Candidat {
    public  function  __construct(){
        $this->bdd = bdd();
    }


// Create

    public function addCandidat($dateCand,$nom,$prenom,$slug,$fonction,$bio,$photo,$an){
        $query = "INSERT INTO candidat(date_candidat,nom,prenom,slug,fonction,bio,photo,an)
            VALUES (:dateCand,:nom,:prenom,:slug,:fonction,:bio,:photo,:an)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "dateCand" => $dateCand,
            "nom" => $nom,
            "prenom" => $prenom,
            "slug" => $slug,
            "fonction" => $fonction,
            "bio" => $bio,
            "photo" => $photo,
            "an" => $an

        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }

    // Read
    public function getCandidatBySlug($slug){

        $query = "SELECT * FROM candidat
        WHERE slug = :slug";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "slug" => $slug
        ));

        return $rs;
    }
    public function getCandidatById($id){

        $query = "SELECT * FROM candidat
        WHERE id_candidat = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        return $rs;
    }

    public function getAllCandidatLimit($debut, $fin){
        $query = "SELECT * FROM candidat ORDER BY id_candidat DESC LIMIT $debut, $fin";
        $rs = $this->bdd->query($query);
        return $rs;
    }
    public function getAllCandidat(){
        $query = "SELECT * FROM candidat
                  WHERE an = 23";
        $rs = $this->bdd->query($query);
        return $rs;
    }

    //Count

    public function getNbrVoteByCandidat($id){
        $query = "SELECT COUNT(*) as nb FROM voter
                  WHERE candidat_id =:id AND an = 23";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        return $rs;
    }

    public function getNbCandidat(){
        $query = "SELECT COUNT(*) as nb FROM candidat
                  WHERE an = 23";
        $rs = $this->bdd->query($query);
        return $rs;
    }

    //Update
    public function updateVote2($vote,$id){
        $query = "UPDATE candidat
            SET nbvote = :vote
            WHERE id_candidat = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "vote" => $vote,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }




    public function updateVote($vote,$id){
        $query = "UPDATE candidat
            SET nbvote = :vote
            WHERE id_candidat = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "vote" => $vote,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }

    public function candidatUpdate($propriete1,$val1,$propriete2,$val2,$propriete3,$val3,$propriete4,$val4,$id){
        $query = "UPDATE candidat
                   Set $propriete1 =:val1,$propriete2 = :val2,$propriete3 = :val3, $propriete4 = :val4
                   WHERE id_candidat = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val1" => $val1,
            "val2" => $val2,
            "val3" => $val3,
            "val4" => $val4,
            "id" => $id
        ));
        $nb = $rs->rowCount();
        return $nb;
    }

    // Delete
    public function deleteCandidat($id){

        $query = "DELETE  FROM candidat WHERE id_candidat  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }


    // Verification valeur existant
    public function verifCandidat($propriete,$val){
        $query = "SELECT * FROM candidat WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }




}
// Instance

$candidat = new Candidat();