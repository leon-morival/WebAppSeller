<?php
namespace WebAppSeller\Models;
class Developpeur extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(column="competence", type="string", length='1','2','3', nullable=true)
     */
    protected $competence;

    /**
     *
     * @var integer
     * @Column(column="indice_production", type="integer", nullable=false)
     */
    protected $indice_production;

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
     * @Column(column="id_collaborateur", type="integer", nullable=false)
     */
    protected $id_collaborateur;
    const _COMP_BDD_ = 1;
    const _COMP_BACKEND_= 2;
    const _COMP_FRONTEND_= 3;
    /**
     * Method to set the value of field competence
     *
     * @param string $competence
     * @return $this
     */
    public function setCompetence($competence)
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Method to set the value of field indice_production
     *
     * @param integer $indice_production
     * @return $this
     */
    public function setIndiceProduction($indice_production)
    {
        $this->indice_production = $indice_production;

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
     * Method to set the value of field id_collaborateur
     *
     * @param integer $id_collaborateur
     * @return $this
     */
    public function setIdCollaborateur($id_collaborateur)
    {
        $this->id_collaborateur = $id_collaborateur;

        return $this;
    }

    /**
     * Returns the value of field competence
     *
     * @return string
     */
    public function getCompetence()
    {
        return $this->competence;
    }

    /**
     * Returns the value of field indice_production
     *
     * @return integer
     */
    public function getIndiceProduction()
    {
        return $this->indice_production;
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
     * Returns the value of field id_collaborateur
     *
     * @return integer
     */
    public function getIdCollaborateur()
    {
        return $this->id_collaborateur;
    }
    public function translateCompetence()
    {
        // restituer le libelle correspondant à une compétence
        switch ($this->getCompetence()){
            case self::_COMP_BDD_:
                return "BDD";
            case self::_COMP_BACKEND_:
                return "BackEnd";

            case self::_COMP_FRONTEND_:
                return "FrontEnd";

            default:
                return "N/A";
        }
    }
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("ecf");
        $this->setSource("developpeur");
        $this->hasMany('id', CompositionEquipe::class, 'id_developpeur', ['alias' => 'CompositionEquipe']);
        $this->hasMany('id', 'Projet', 'id_developpeur', ['alias' => 'Projet']);
        $this->belongsTo('id_collaborateur', Collaborateur::class, 'id', ['alias' => 'Collaborateur']);

    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Developpeur[]|Developpeur|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Developpeur|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
