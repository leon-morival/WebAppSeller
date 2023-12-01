<?php
namespace WebAppSeller\Models;

class Collaborateur extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(column="prenom", type="string", length=100, nullable=true)
     */
    protected $prenom;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(column="prime_embauche", type="integer", nullable=true)
     */
    protected $prime_embauche;

    /**
     *
     * @var string
     * @Column(column="nom", type="string", length=50, nullable=true)
     */
    protected $nom;

    /**
     *
     * @var string
     * @Column(column="niveau_competence", type="string", length='1','2','3', nullable=true)
     */
    protected $niveau_competence;

    const _COMP_STAGIAIRE_= 1;
    const _COMP_JUNIOR_= 2;
    const _COMP_SENIOR_= 3;

    /**
     * Method to set the value of field prenom
     *
     * @param string $prenom
     * @return $this
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field prime_embauche
     *
     * @param integer $prime_embauche
     * @return $this
     */
    public function setPrimeEmbauche($prime_embauche)
    {
        $this->prime_embauche = $prime_embauche;

        return $this;
    }

    /**
     * Method to set the value of field nom
     *
     * @param string $nom
     * @return $this
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Method to set the value of field niveau_competence
     *
     * @param string $niveau_competence
     * @return $this
     */
    public function setNiveauCompetence($niveau_competence)
    {
        $this->niveau_competence = $niveau_competence;

        return $this;
    }

    /**
     * Returns the value of field prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field prime_embauche
     *
     * @return integer
     */
    public function getPrimeEmbauche()
    {
        return $this->prime_embauche;
    }

    /**
     * Returns the value of field nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Returns the value of field niveau_competence
     *
     * @return string
     */
    public function getNiveauCompetence()
    {
        return $this->niveau_competence;
    }

    /**
     * Traduit le niveau de compétence en une chaine de caractère
     *
     * @return String
     */
    public function translateLevel() : String
    {
        switch ($this->getNiveauCompetence()){
            case self::_COMP_STAGIAIRE_:
                return "Stagiaire";

            case self::_COMP_JUNIOR_:
                return "Junior";

            case self::_COMP_SENIOR_:
                return "Senior";

            default:
                return "N/A";
        }
    }


    /**
     * Check if the collaborateur is a Developpeur.
     *
     * @return bool
     */
    public function isDeveloppeur():bool
    {
        // Assuming you have a relationship between Collaborateur and Developpeur
        $developpeur = Developpeur::findFirst([
            'conditions' => 'id_collaborateur = :id_collaborateur:',
            'bind' => ['id_collaborateur' => $this->getId()],
        ]);

        return $developpeur !== null;
    }

    /**
     * Check if the collaborateur is a Chef de Projet.
     *
     * @return bool
     */
    public function isChefDeProjet():bool
    {
        // Assuming you have a relationship between Collaborateur and ChefDeProjet
        $chefDeProjet = ChefDeProjet::findFirst([
            'conditions' => 'id_collaborateur = :id_collaborateur:',
            'bind' => ['id_collaborateur' => $this->getId()],
        ]);

        return $chefDeProjet !== null;
    }


    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("ecf");
        $this->setSource("collaborateur");
        $this->hasMany('id', 'ChefDeProjet', 'id_collaborateur', ['alias' => 'ChefDeProjet']);
        $this->hasMany('id', 'Developpeur', 'id_collaborateur', ['alias' => 'Developpeur']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Collaborateur[]|Collaborateur|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Collaborateur|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
