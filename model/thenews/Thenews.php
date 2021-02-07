<?php


class Thenews
{
    // cet attribut est ajouté depuis la table theuser, il sera utile pour instancier des news lorsqu'on aura besoin du le login de l'utilisateur, ceci pour permettre les jointures dans les méthodes de ThenewManager sans à avoir à utiliser des sous-requêtes ou de multiples objets.
    private $theUserLogin;

    // EXERCICE créez les autres attributs (noms des champs dans le table "thenews")
    private $idtheNews;
    private $theNewsTitle;
    private $theNewsText;
    private $theNewsDate;
    private $theUser_idtheUser;

    // EXERCICE créez le constructeur

    public function __construct(Array $param){
        $this->hydrate($param);
    }

    

    // EXERCICE créez l'hydratateur

    private function hydrate(Array $datas){
        foreach($datas as $key => $value){
            $methodSetters = "set".ucfirst($key);
            if(method_exists($this,$methodSetters)){
                $this->$methodSetters($value);
            }
        }
    }


    // EXERCICE créez les getters et setters des attributs propre à cette table, n'oubliez pas de protéger les champs avec les setters !

    public function getIdtheNews():int{
        return $this->idtheNews;
    }

    public function getTheNewsTitle():?string{
        return $this->theNewsTitle;
    }

    public function getTheNewsText():?string{
        return $this->theNewsText;
    }

    public function getTheNewsDate():string{
        return $this->theNewsDate;
    }

    public function getTheUser_idtheUser():int{
        return $this->theUser_idtheUser;
    }

    public function setIdthenews(int $idtheNews):void{
        $this->idtheNews = $idtheNews;
    }

    public function setTheNewsTitle(string $theNewsTitle):void{
        $title = strip_tags(trim($theNewsTitle));
        if(empty($title)){
            trigger_error("Le titre doit être renseigné",E_USER_NOTICE);
        }
        else{
            $this->theNewsTitle = $title;
        }
    }

    public function setTheNewsText(string $theNewsText):void{
        $text = strip_tags((trim($theNewsText)));
        if(empty($text)){
            print("Le texte ne peut être vide");
        }
        elseif(strlen($text)>150){
            print("Le texte ne peut dépasser 150 caractères");
        }
        else{
            $this->theNewsText = $text;
        }
    }

    public function setTheNewsDate(string $theNewsDate):void{
        $regex = preg_grep("/^(\d{4})-(\d{2})-([\d]{2}) (\d{2}):([0-5]{1})([0-9]{1}):([0-5]{1})([0-9]{1})$/",[$theNewsDate]);
        if(empty($regex)){
            print("Format de date non valide");
        }
        else{
            $this->theNewsDate = $theNewsDate;
        }
    }

    public function setTheUser_idtheUser(int $theUser_idtheUser){
        $this->theUser_idtheUser = $theUser_idtheUser;
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


