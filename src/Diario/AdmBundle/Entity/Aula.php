<?php

namespace Diario\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Aula
 *
 * @ORM\Table(name="aula")
 * @ORM\Entity
 */
class Aula
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime")
     */
    private $data;

    /**
     * @ORM\ManyToOne(targetEntity="Turma", inversedBy="aulas", cascade={"persist","refresh"})
     * @ORM\JoinColumn(name="turma_id", referencedColumnName="id")
     */
    protected $turma;

    
    //@ORM\OneToMany(targetEntity="AlunoHasAula", mappedBy="aula", cascade={"persist","refresh"})
    // protected $alunos;


    public function __construct()
    {
        // $this->alunos = new ArrayCollection();
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
     * Set data
     *
     * @param \DateTime $data
     * @return Aula
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set turma
     *
     * @param \Diario\AdmBundle\Entity\Turma $turma
     * @return Aula
     */
    public function setTurma(\Diario\AdmBundle\Entity\Turma $turma = null)
    {
        $this->turma = $turma;

        return $this;
    }

    /**
     * Get turma
     *
     * @return \Diario\AdmBundle\Entity\Turma 
     */
    public function getTurma()
    {
        return $this->turma;
    }

    // /**
    //  * __toString method
    //  *
    //  * @return string 
    //  */
    // public function __toString()
    // {
    //     return $this->turma.' - '.$this->data; 
    // }


    /**
     * Add alunos
     *
     * @param \Diario\AdmBundle\Entity\AlunoHasAula $alunos
     * @return Aula
     */
    public function addAluno(\Diario\AdmBundle\Entity\AlunoHasAula $alunos)
    {
        $this->alunos[] = $alunos;

        return $this;
    }

    /**
     * Remove alunos
     *
     * @param \Diario\AdmBundle\Entity\AlunoHasAula $alunos
     */
    public function removeAluno(\Diario\AdmBundle\Entity\AlunoHasAula $alunos)
    {
        $this->alunos->removeElement($alunos);
    }

    /**
     * Get alunos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlunos()
    {
        return $this->alunos;
    }
}
