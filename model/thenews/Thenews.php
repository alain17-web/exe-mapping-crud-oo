<?php


class Thenews
{
    // cet attribut est ajouté depuis la table theuser, il sera utile pour instancier des news lorsqu'on aura besoin du le login de l'utilisateur, ceci pour permettre les jointures dans les méthodes de ThenewManager sans à avoir à utiliser des sous-requêtes ou de multiples objets.
    private string $theUserLogin;

    // EXERCICE créez les autres attributs (noms des champs dans le table "thenews")
    private int $idtheNews;
    private string $theNewsTitle;
    private string $theNewsText;
    private string $theNewsDate;
    private int $theUser_idtheUser;

    // EXERCICE créez le constructeur
    public function __construct(array $datas){
        $this->hydrate($datas);
    }


    // EXERCICE créez l'hydratateur
    private function hydrate(array $array){
        foreach($array as $key => $value){
            $methodSetters = "set".ucfirst($key);
            if(method_exists($this,$methodSetters)){
                $this->$methodSetters($value);
            }
        }
    }

    // EXERCICE créez les getters et setters des attributs propre à cette table, n'oubliez pas de protéger les champs avec les setters !

    // getters

    /**
     * @return int
     */
    public function getIdtheNews(): int
    {
        return $this->idtheNews;
    }

    /**
     * @return string
     */
    public function getTheNewsTitle(): string
    {
        return $this->theNewsTitle;
    }

    /**
     * @return string
     */
    public function getTheNewsText(): string
    {
        return $this->theNewsText;
    }

    /**
     * @return string
     */
    public function getTheNewsDate(): string
    {
        return $this->theNewsDate;
    }

    /**
     * @return int
     */
    public function getTheUser_idtheUser(): int
    {
        return $this->theUser_idtheUser;
    }


    // setters

    /**
     * @param int $idtheNews
     */
    public function setIdtheNews(int $idtheNews): void
    {
        $idtheNews = (int) $idtheNews;
        if(!empty($idtheNews)) {
            $this->idtheNews = $idtheNews;
        }else{
            trigger_error("Votre id ne peut pas être 0!",E_USER_NOTICE);
        }
    }

    /**
     * @param string $theNewsTitle
     */
    public function setTheNewsTitle(string $theNewsTitle): void
    {
        $theNewsTitle = strip_tags(trim($theNewsTitle));
        if(empty($theNewsTitle)){
            trigger_error("Votre titre ne peut être vide",E_USER_NOTICE);
        }elseif (strlen($theNewsTitle)>150){
            trigger_error("Votre titre ne peut dépasser les 150 caractères",E_USER_NOTICE);
        }else {
            $this->theNewsTitle = $theNewsTitle;
        }
    }

    /**
     * @param string $theNewsText
     */
    public function setTheNewsText(string $theNewsText): void
    {
        $theNewsText = strip_tags(trim($theNewsText));
        if(empty($theNewsText)){
            trigger_error("Votre texte ne peut être vide",E_USER_NOTICE);
        }else {
            $this->theNewsText = $theNewsText;
        }

    }

    /**
     * @param string $theNewsDate
     */
    public function setTheNewsDate(string $theNewsDate): void
    {
        // vérification d'un datetime valide (à perfectionner) grâce à une regex (expression régulière)
        $regex = preg_grep("/^(\d{4})-(\d{2})-([\d]{2}) (\d{2}):([0-5]{1})([0-9]{1}):([0-5]{1})([0-9]{1})$/",[$theNewsDate]);
        if(empty($regex)){
            trigger_error("Format de date non valide",E_USER_NOTICE);
        }else {
            $this->theNewsDate = $theNewsDate;
        }

    }

    /**
     * @param int $theUser_idtheUser
     */
    public function setTheUser_idtheUser(int $theUser_idtheUser): void
    {
        $theUser_idtheUser = (int) $theUser_idtheUser;
        if(!empty($theUser_idtheUser)) {
            $this->theUser_idtheUser = $theUser_idtheUser;
        }else{
            trigger_error("L'id de l'utilisateur ne peut pas être 0!",E_USER_NOTICE);
        }

    }



    // Getters et Setters utiles pour theUserLogin
    /**
     * $theUserLogin's getter
     * @return string
     */
    public function getTheUserLogin(): string
    {
        return $this->theUserLogin;
    }

    /**
     * $theUserLogin's setter
     * @param string $theUserLogin
     */
    public function setTheUserLogin(string $theUserLogin): void
    {
        $theUserLogin = strip_tags(trim($theUserLogin));
        if(strlen($theUserLogin)<3 || strlen($theUserLogin)>60){
            trigger_error("Le login doit être plus grand que 2 et plus petit que 60 caractères!",E_USER_NOTICE );
        }else {
            $this->theUserLogin = $theUserLogin;
        }
    }
}