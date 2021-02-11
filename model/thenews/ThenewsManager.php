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

    // Chargement d'une news par son ID
    public function readOneNewsById(int $idnews):array{
        $sql="SELECT n.idtheNews, n.theNewsTitle, n.theNewsText, n.theNewsDate, n.theUser_idtheUser, u.theUserLogin 
        FROM thenews n
        INNER JOIN theuser u 
            ON u.idtheUser = n.theUser_idtheUser
        WHERE n.idtheNews=? ;
        ";
        $request = $this->db->prepare($sql);
        $request->execute([$idnews]);
        // si on a un article
        if($request->rowCount()){
            return $request->fetch(PDO::FETCH_ASSOC);
        }
        // pas d'article
        return [];
    }

    // méthode qui coupe le texte en dehors des mots, on peut l'utiliser sans instancier cette classe (static)
    public static function cutTheText(string $text, int $nbChars): string{
        $cutText = substr($text,0,$nbChars);
        return $cutText = substr($cutText,0,strrpos($cutText," "));
    }

}