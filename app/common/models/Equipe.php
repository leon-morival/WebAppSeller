<?php
namespace WebAppSeller\Models;
class Equipe extends \Phalcon\Mvc\Model
{

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
     * @Column(column="id_chef_de_projet", type="integer", nullable=false)
     */
    protected $id_chef_de_projet;

    /**
     *
     * @var string
     * @Column(column="libelle", type="string", length=50, nullable=true)
     */
    protected $libelle;

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
     * Method to set the value of field id_chef_de_projet
     *
     * @param integer $id_chef_de_projet
     * @return $this
     */
    public function setIdChefDeProjet($id_chef_de_projet)
    {
        $this->id_chef_de_projet = $id_chef_de_projet;

        return $this;
    }

    /**
     * Method to set the value of field libelle
     *
     * @param string $libelle
     * @return $this
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
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
     * Returns the value of field id_chef_de_projet
     *
     * @return integer
     */
    public function getIdChefDeProjet()
    {
        return $this->id_chef_de_projet;
    }

    /**
     * Returns the value of field libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("ecf");
        $this->setSource("equipe");
        $this->hasMany('id', 'CompositionEquipe', 'id_equipe', ['alias' => 'CompositionEquipe']);
        $this->belongsTo('id_chef_de_projet', ChefDeProjet::class, 'id', ['alias' => 'ChefDeProjet']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Equipe[]|Equipe|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Equipe|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
