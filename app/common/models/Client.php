<?php

class Client extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(column="raison_sociale", type="string", length=50, nullable=true)
     */
    protected $raison_sociale;

    /**
     *
     * @var string
     * @Column(column="ridet", type="string", length=10, nullable=true)
     */
    protected $ridet;

    /**
     *
     * @var integer
     * @Column(column="ssi2", type="integer", length=1, nullable=true)
     */
    protected $ssi2;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     * Method to set the value of field raison_sociale
     *
     * @param string $raison_sociale
     * @return $this
     */
    public function setRaisonSociale($raison_sociale)
    {
        $this->raison_sociale = $raison_sociale;

        return $this;
    }

    /**
     * Method to set the value of field ridet
     *
     * @param string $ridet
     * @return $this
     */
    public function setRidet($ridet)
    {
        $this->ridet = $ridet;

        return $this;
    }

    /**
     * Method to set the value of field ssi2
     *
     * @param integer $ssi2
     * @return $this
     */
    public function setSsi2($ssi2)
    {
        $this->ssi2 = $ssi2;

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
     * Returns the value of field raison_sociale
     *
     * @return string
     */
    public function getRaisonSociale()
    {
        return $this->raison_sociale;
    }

    /**
     * Returns the value of field ridet
     *
     * @return string
     */
    public function getRidet()
    {
        return $this->ridet;
    }

    /**
     * Returns the value of field ssi2
     *
     * @return integer
     */
    public function getSsi2()
    {
        return $this->ssi2;
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("ecf");
        $this->setSource("client");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Client[]|Client|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Client|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
