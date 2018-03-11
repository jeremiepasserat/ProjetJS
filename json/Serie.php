<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 11/03/18
 * Time: 12:47
 */

class Serie
{
    private $nom;
    private $synopsys;
    private $image;
    private $note;
    private $nbnotes;
    private $commentaires = array();

    public function setNom($nom){
        $this->nom = $nom;
        return $this;
    }

    public function setSynopsis($synopsis){
        $this->synopsys = $synopsis;
        return $this;
    }

    public function setImage($image){
        $this->image = $image;
        return $this;
    }

    public function changeNote($note){
        if ($this->nbnotes == 0) {
            $this->note = $note;
        }
        else {
            $this->note = ((($this->note * ($this->nbnotes)) + $note) / ($this->nbnotes + $note));
        }
        $this->nbnotes++;
        return $this;

    }


    public function addCommentaires($commentaire){
        array_push($this->commentaires, $commentaire);
        return $this;
    }

    public function getCommentaires(){
        return $this->commentaires;
    }

    public function getNote(){
        return $this->note;
    }

    public function getImage(){
        return $this->image;
    }

    public function getSynopsis(){
        return $this->synopsys;
    }

    public function getNom(){
        return $this->nom;
    }


}