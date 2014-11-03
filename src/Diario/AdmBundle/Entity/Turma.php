<?php

namespace Diario\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Turma
 *
 * @ORM\Table(name="turma")
 * @ORM\Entity
 */
class Turma
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
     * @var integer
     *
     * @ORM\Column(name="codigo_turma", type="integer")
     */
    private $codigoTurma;

    /**
     * @var integer
     *
     * @ORM\Column(name="ano", type="smallint")
     */
    private $ano;

    /**
     * @var integer
     *
     * @ORM\Column(name="semestre", type="smallint")
     */
    private $semestre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inicio", type="date")
     */
    private $dataInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_termino", type="date")
     */
    private $dataTermino;

    /**
     * @ORM\ManyToOne(targetEntity="Disciplina", inversedBy="turmas")
     * @ORM\JoinColumn(name="disciplina_id", referencedColumnName="id")
     */
    protected $disciplina;

    /**
     * @ORM\OneToOne(targetEntity="Professor")
     * @ORM\JoinColumn(name="professor_id", referencedColumnName="id")
     */
    private $professor;

    /**
     * @ORM\OneToMany(targetEntity="Horario", mappedBy="turma")
     */
    protected $horarios;

    /**
     * @ORM\OneToMany(targetEntity="Aula", mappedBy="turma", cascade={"persist"})
     */
    protected $aulas;

    
    public function __construct()
    {
        $this->horarios = new ArrayCollection();
        $this->aulas = new ArrayCollection();
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
     * Set codigoTurma
     *
     * @param integer $codigoTurma
     * @return Turma
     */
    public function setCodigoTurma($codigoTurma)
    {
        $this->codigoTurma = $codigoTurma;

        return $this;
    }

    /**
     * Get codigoTurma
     *
     * @return integer 
     */
    public function getCodigoTurma()
    {
        return $this->codigoTurma;
    }

    /**
     * Set ano
     *
     * @param integer $ano
     * @return Turma
     */
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get ano
     *
     * @return integer 
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Set semestre
     *
     * @param integer $semestre
     * @return Turma
     */
    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;

        return $this;
    }

    /**
     * Get semestre
     *
     * @return integer 
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * Set dataInicio
     *
     * @param \DateTime $dataInicio
     * @return Turma
     */
    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    /**
     * Get dataInicio
     *
     * @return \DateTime 
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * Set dataTermino
     *
     * @param \DateTime $dataTermino
     * @return Turma
     */
    public function setDataTermino($dataTermino)
    {
        $this->dataTermino = $dataTermino;

        return $this;
    }

    /**
     * Get dataTermino
     *
     * @return \DateTime 
     */
    public function getDataTermino()
    {
        return $this->dataTermino;
    }

    /**
     * Set disciplina
     *
     * @param \Diario\AdmBundle\Entity\Disciplina $disciplina
     * @return Turma
     */
    public function setDisciplina(\Diario\AdmBundle\Entity\Disciplina $disciplina = null)
    {
        $this->disciplina = $disciplina;

        return $this;
    }

    /**
     * Get disciplina
     *
     * @return \Diario\AdmBundle\Entity\Disciplina 
     */
    public function getDisciplina()
    {
        return $this->disciplina;
    }

    /**
     * Set professor
     *
     * @param \Diario\AdmBundle\Entity\Professor $professor
     * @return Turma
     */
    public function setProfessor(\Diario\AdmBundle\Entity\Professor $professor = null)
    {
        $this->professor = $professor;

        return $this;
    }

    /**
     * Get professor
     *
     * @return \Diario\AdmBundle\Entity\Professor 
     */
    public function getProfessor()
    {
        return $this->professor;
    }

    /**
     * Add horarios
     *
     * @param \Diario\AdmBundle\Entity\Horario $horarios
     * @return Turma
     */
    public function addHorario(\Diario\AdmBundle\Entity\Horario $horarios)
    {
        $this->horarios[] = $horarios;

        return $this;
    }

    /**
     * Remove horarios
     *
     * @param \Diario\AdmBundle\Entity\Horario $horarios
     */
    public function removeHorario(\Diario\AdmBundle\Entity\Horario $horarios)
    {
        $this->horarios->removeElement($horarios);
    }

    /**
     * Get horarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHorarios()
    {
        return $this->horarios;
    }

    /**
     * __toString method
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->disciplina.' - CodTurma: '.$this->codigoTurma.' - Ano/Sem: '.$this->ano.'/'.$this->semestre; 
    }


    /**
     * Add aulas
     *
     * @param \Diario\AdmBundle\Entity\Aula $aulas
     * @return Turma
     */
    public function addAula(\Diario\AdmBundle\Entity\Aula $aulas)
    {
        $this->aulas[] = $aulas;

        return $this;
    }

    /**
     * Remove aulas
     *
     * @param \Diario\AdmBundle\Entity\Aula $aulas
     */
    public function removeAula(\Diario\AdmBundle\Entity\Aula $aulas)
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
