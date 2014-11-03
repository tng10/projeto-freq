<?php

namespace Diario\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Curso
 *
 * @ORM\Table(name="curso")
 * @ORM\Entity
 */
class Curso
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
     * @ORM\Column(name="nome", type="string", length=45)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_curso", type="string", length=10)
     */
    private $codigoCurso;

    /**
     * @ORM\OneToMany(targetEntity="Disciplina", mappedBy="curso")
     */
    protected $disciplinas;

    
    public function __construct()
    {
        $this->disciplinas = new ArrayCollection();
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
     * @return Curso
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
     * Set codigoCurso
     *
     * @param string $codigoCurso
     * @return Disciplina
     */
    public function setCodigoCurso($codigoCurso)
    {
        $this->codigoCurso = $codigoCurso;

        return $this;
    }

    /**
     * Get codigoCurso
     *
     * @return string 
     */
    public function getCodigoCurso()
    {
        return $this->codigoCurso;
    }


    /**
     * Add disciplinas
     *
     * @param \Diario\AdmBundle\Entity\Disciplina $disciplinas
     * @return Curso
     */
    public function addDisciplina(\Diario\AdmBundle\Entity\Disciplina $disciplinas)
    {
        $this->disciplinas[] = $disciplinas;

        return $this;
    }

    /**
     * Remove disciplinas
     *
     * @param \Diario\AdmBundle\Entity\Disciplina $disciplinas
     */
    public function removeDisciplina(\Diario\AdmBundle\Entity\Disciplina $disciplinas)
    {
        $this->disciplinas->removeElement($disciplinas);
    }

    /**
     * Get disciplinas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDisciplinas()
    {
        return $this->disciplinas;
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
}
