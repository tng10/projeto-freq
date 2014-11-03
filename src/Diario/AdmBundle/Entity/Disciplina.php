<?php

namespace Diario\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Disciplina
 *
 * @ORM\Table("disciplina")
 * @ORM\Entity
 */
class Disciplina
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
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=75)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_disciplina", type="string", length=10)
     */
    private $codigoDisciplina;

    /**
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="disciplinas")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    protected $curso;

    /**
     * @ORM\OneToMany(targetEntity="Turma", mappedBy="disciplina")
     */
    protected $turmas;

    
    public function __construct()
    {
        $this->turmas = new ArrayCollection();
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
     * @return Disciplina
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
     * Set codigoDisciplina
     *
     * @param string $codigoDisciplina
     * @return Disciplina
     */
    public function setCodigoDisciplina($codigoDisciplina)
    {
        $this->codigoDisciplina = $codigoDisciplina;

        return $this;
    }

    /**
     * Get codigoDisciplina
     *
     * @return string 
     */
    public function getCodigoDisciplina()
    {
        return $this->codigoDisciplina;
    }

    /**
     * Set curso
     *
     * @param \Diario\AdmBundle\Entity\Curso $curso
     * @return Disciplina
     */
    public function setCurso(\Diario\AdmBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \Diario\AdmBundle\Entity\Curso 
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Add turmas
     *
     * @param \Diario\AdmBundle\Entity\Turma $turmas
     * @return Disciplina
     */
    public function addTurma(\Diario\AdmBundle\Entity\Turma $turmas)
    {
        $this->turmas[] = $turmas;

        return $this;
    }

    /**
     * Remove turmas
     *
     * @param \Diario\AdmBundle\Entity\Turma $turmas
     */
    public function removeTurma(\Diario\AdmBundle\Entity\Turma $turmas)
    {
        $this->turmas->removeElement($turmas);
    }

    /**
     * Get turmas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTurmas()
    {
        return $this->turmas;
    }

    /**
     * __toString method
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->nome.' - '.$this->curso->getCodigoCurso(); 
    }

}
