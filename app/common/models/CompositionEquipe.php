<?php
namespace WebAppSeller\Models;
class CompositionEquipe extends \Phalcon\Mvc\Model
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
     * @Column(column="id_equipe", type="integer", nullable=false)
     */
    protected $id_equipe;

    /**
     *
     * @var integer
     * @Column(column="id_developpeur", type="integer", nullable=false)
     */
    protected $id_developpeur;

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
     * Method to set the value of field id_equipe
     *
     * @param integer $id_equipe
     * @return $this
     */
    public function setIdEquipe($id_equipe)
    {
        $this->id_equipe = $id_equipe;

        return $this;
    }

    /**
     * Method to set the value of field id_developpeur
     *
     * @param integer $id_developpeur
     * @return $this
     */
    public function setIdDeveloppeur($id_developpeur)
    {
        $this->id_developpeur = $id_developpeur;

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
     * Returns the value of field id_equipe
     *
     * @return integer
     */
    public function getIdEquipe()
    {
        return $this->id_equipe;
    }

    /**
     * Returns the value of field id_developpeur
     *
     * @return integer
     */
    public function getIdDeveloppeur()
    {
        return $this->id_developpeur;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("ecf");
        $this->setSource("composition_equipe");
        $this->belongsTo('id_developpeur', Developpeur::class, 'id', ['alias' => 'Developpeur']);
        $this->belongsTo('id_equipe', Equipe::class, 'id', ['alias' => 'Equipe']);
        $this->hasMany('id_equipe', Developpeur::class, 'id_equipe', ['alias' => 'Developpeurs']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CompositionEquipe[]|CompositionEquipe|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CompositionEquipe|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }


    public static function validateDeveloperCount($developerIds)
    {
        $numSelectedDevelopers = count($developerIds);
        return $numSelectedDevelopers >= 1 && $numSelectedDevelopers <= 3;
    }


    /**
     * Vérifie si un développeur existe déjà dans une autre équipe avec le même Chef de Projet.
     *
     * @param array $developpeurs Les ID des développeurs sélectionnés pour l'équipe en cours de création.
     * @param int $chef L'ID du Chef de Projet de l'équipe en cours de création.
     * @return bool Retourne true si l'un des développeurs sélectionnés appartient déjà à une autre équipe avec le même Chef de Projet, sinon retourne false.
     */
    public static function developerExists(array $developpeurs,int $chef):bool
    {
        // Parcourt chaque ID de développeur
        foreach ($developpeurs as $developerId) {
            // Recherche l'équipe liée au développeur en cours
            $equipe = self::findFirst([
                'conditions' => 'id_developpeur = :developerId:',
                'bind' => [
                    'developerId' => $developerId,
                ]
            ]);

            // Si une équipe liée est trouvée et que son Chef de Projet est identique au Chef de Projet donné,
            // cela signifie que le développeur fait déjà partie d'une autre équipe avec le même Chef de Projet
            if ($equipe && $equipe->getEquipe()->getIdChefDeProjet() == $chef) {
                return true;
            }
        }

        // Si aucune équipe n'est trouvée, cela signifie que les développeurs ne font pas partie d'une autre équipe avec le même Chef de Projet
        return false;
    }




}
