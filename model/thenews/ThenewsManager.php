<?php


class ThenewsManager
{
    // EXERCICE créez le manager complet avec la connexion MyPDO en argument et toutes les méthodes nécessaires au CRUD des "thenews"
    private MyPDO $db;

    /**
     * ThenewsManager constructor.
     * @param MyPDO $db
     */
    public function __construct(MyPDO $db)
    {
        $this->db = $db;
    }

    // Récupération de tous les news (thenews) avec le nom d'auteur joint (theuser) ordonné par date Descendante, nous allons prendre que 180 caractères
    public function readAllNews(): array{
        $sql="SELECT n.idtheNews, n.theNewsTitle, SUBSTR(n.theNewsText,1,180) AS theNewsText, n.theNewsDate, n.theUser_idtheUser, u.theUserLogin 
        FROM thenews n
        INNER JOIN theuser u 
            ON u.idtheUser = n.theUser_idtheUser
        ORDER BY n.theNewsDate DESC ;
        ";
        $request = $this->db->query($sql);
        // si on a des articles
        if($request->rowCount()){
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }
        // pas d'articles
        return [];
    }

    public function readAllNewsByIdUser(int $iduser){
        $sql = "SELECT n.idTheNews, n.theNewsTitle, SUBSTR(theNewsText,1,180) AS theNewsText, n.theNewsDate, n.theUser_idtheUser FROM thenews n WHERE n.theUser_idtheUser = ? ORDER BY n.theNewsDate DESC;";
        $request = $this->db->prepare($sql);
        $request->execute([$iduser]);

        if($request->rowCount()){
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return[];
    }

    // Chargement d'une news par son ID
    public function readOneNewsById(int $idThenews):array{
        $sql="SELECT n.idtheNews, n.theNewsTitle, n.theNewsText, n.theNewsDate, n.theUser_idtheUser, u.theUserLogin 
        FROM thenews n
        INNER JOIN theuser u 
            ON u.idtheUser = n.theUser_idtheUser
        WHERE n.idtheNews=? ;
        ";
        $request = $this->db->prepare($sql);
        $request->execute([$idThenews]);
        // si on a un article
        if($request->rowCount()){
            return $request->fetch(PDO::FETCH_ASSOC);
        }
        // pas d'article
        return [];
    }

    //Création d'une news
    public function createNews(Thenews $item){
        $sql = "INSERT INTO thenews (theNewsTitle,theNewsText,theUser_idtheUser) VALUES (?,?,?)";
        $request = $this->db->prepare($sql);
        try{
            $request->execute([
                $item->getTheNewsTitle(),
                $item->getTheNewsText(),
                $item->getTheUser_idtheUser()
            ]);
            return true;
        }catch (Exception $e){
            return $e->getMessage();
        }
        
    }

    //Suppression d'une news
    public function deleteNewsById(int $idTheNews){
        $sql = "DELETE FROM thenews WHERE idTheNews = ?";
        $prepare = $this->db->prepare($sql);
        try{
            $prepare->execute([$idTheNews]);
            return true;
        }catch(PDOException $exception){
            return $exception->getMessage();
        }
    }

    //Modification d'une news
    public function updateNewsById(Thenews $news,int $idTheNews){
        if($idTheNews==$news->getIdtheNews()){
            $sql = "UPDATE thenews SET theNewsTitle= :theNewsTitle,theNewsText= :theNewsText,theNewsDate= :theNewsDate WHERE idTheNews= :idTheNews";
            $prepare = $this->db->prepare($sql);

            
            $prepare->bindValue("theNewsTitle",$news->getTheNewsTitle(),PDO::PARAM_STR);
            $prepare->bindValue("theNewsText",$news->getTheNewsText(),PDO::PARAM_STR);
            $prepare->bindValue("theNewsDate",$news->getTheNewsDate(),PDO::PARAM_STR);
            $prepare->bindValue("idTheNews",$news->getIdTheNews(),PDO::PARAM_INT);
            /*$prepare->bindValue("theUser_idtheUser",$news->getTheUser_idtheUser(),PDO::PARAM_INT);*/

            try{
                $prepare->execute();
                return true;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
        else{
            return "No Way !";
        }
    }

    // méthode qui coupe le texte en dehors des mots, on peut l'utiliser sans instancier cette classe (static)
    public static function cutTheText(string $text, int $nbChars): string{
        $cutText = substr($text,0,$nbChars);
        return $cutText = substr($cutText,0,strrpos($cutText," "));
    }

}