<?php


class ThenewsManager
{
    // EXERCICE créez le manager complet avec la connexion MyPDO en argument et toutes les méthodes nécessaires au CRUD des "thenews"

    private MyPDO $db;

    public function __construct(MyPDO $connect){
        $this->db = $connect;
    }

    //Read

    public function readAllNews(): Array{
        $sql = "SELECT * FROM thenews ORDER BY theNewsDate DESC";
        $recupAll = $this->db->query($sql);
        if($recupAll->rowCount()){
            return $recupAll->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return[];
        }
    }

    public function readOneNewsById(int $id):Array{
        $sql = "SELECT * FROM thenews WHERE idtheNews = ?";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue(1,$id,PDO::PARAM_INT);
        $prepare->execute();
        if($prepare->rowCount()){
            return $prepare->fetch(PDO::FETCH_ASSOC);
        }
        return[];
    }

    //Insert

    public function insertNews (Thenews $item){
        $sql = "INSERT INTO thenews (theNewsTitle,theNewsText,theNewsDate,theUser_idtheUser) VALUES (?,?,?,?)";
        $request = $this->db->prepare($sql);
        if(getTheUser_idtheUser()!==7){
            throw new Exception('Seul Alain peut insérer un article');
        }
        try{
            $request->execute([
                $item->getTheNewsTitle(),
                $item->getTheNewsText(),
                $item->getTheNewsDate(),
                $item->getTheUser_idtheUser()
            ]);
            return true;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }

    //Delete 

    public function deleteNewsById(int $id){
        $sql = "DELETE FROM thenews WHERE idtheNews = ?";
        $prepare = $this->db->prepare($sql);
        try{
            $prepare->execute([$id]);
            return true;
        }
        catch (PDOException $exception){
            return $exception->getMessage();
        }
    }

    public function deleteNewsByTitle($title){
        $sql = "DELETE FROM thenews WHERE theNewsTitle = ?";
        $prepare = $this->db->prepare($sql);
        try{
            $prepare->execute([$title]);
            return true;
        }
        catch (PDOException $exception){
            return $exception->getMessage();
        }
    }

    //Update 

    public function updateNewsById(Thenews $thenews){

        if($idtheNews == $thenews->getIdNews()){
            $sql = "UPDATE thenews SET theNewsTitle= :theNewsTitle, theNewsText= :theNewsText, theNewsDate= :theNewsDate WHERE idtheNews= :idtheNews";
            $prepare= $this->db->prepare($sql);

            $prepare->bindValue("idtheNews",$thenews->getIdtheNews(),PDO::PARAM_INT);
            $prepare->bindValue("theNewsTitle",$thenews->getTheNewsTitle(),PDO::PARAM_STR);
            $prepare->bindValue("theNewsText",$thenews->getTheNewsText(),PDO::PARAM_STR);
            $prepare->bindValue("theNewsDate",$thenews->getTheNewsDate(),PDO::PARAM_STR);

            try{
                $prepare->execute();
                return true;
            }
            catch (PDOException $e){
                return $e->getMessage();
            }
            
        }
        else{
            return "Go back to China !";
        }
    }
}

