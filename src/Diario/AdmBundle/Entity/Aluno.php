<?php

namespace Diario\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Aluno
 *
 * @ORM\Table(name="aluno")
 * @ORM\Entity
 */
class Aluno
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=75)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="AlunoHasAula", mappedBy="aluno", cascade={"persist","refresh"})
     */
    protected $aulas;
    


    public function __construct()
    {
        $this->aulas = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Aluno
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Aluno
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Aluno
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * __toString method
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->nome; 
    }
    
    

    /**
     * Add aulas
     *
     * @param \Diario\AdmBundle\Entity\AlunoHasAula $aulas
     * @return Aluno
     */
    public function addAula(\Diario\AdmBundle\Entity\AlunoHasAula $aulas)
    {
        $this->aulas[] = $aulas;

        return $this;
    }

    /**
     * Remove aulas
     *
     * @param \Diario\AdmBundle\Entity\AlunoHasAula $aulas
     */
    public function removeAula(\Diario\AdmBundle\Entity\AlunoHasAula $aulas)
    {
        $this->aulas->removeElement($aulas);
    }

    /**
     * Get aulas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAulas()
    {
        return $this->aulas;
    }
}
