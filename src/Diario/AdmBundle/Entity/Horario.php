<?php

namespace Diario\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horario
 *
 * @ORM\Table(name="horario")
 * @ORM\Entity
 */
class Horario
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
     * @ORM\Column(name="dia", type="string", length=3)
     */
    private $dia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="time")
     */
    private $hora;

    /**
     * @ORM\ManyToOne(targetEntity="Turma", inversedBy="horarios", cascade={"persist"})
     * @ORM\JoinColumn(name="turma_id", referencedColumnName="id")
     */
    protected $turma;


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
     * Set dia
     *
     * @param string $dia
     * @return Horario
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return string 
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set hora
     *
     * @param \DateTime $hora
     * @return Horario
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime 
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set turma
     *
     * @param \Diario\AdmBundle\Entity\Turma $turma
     * @return Horario
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

    /**
     * __toString method
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->dia.' - '.$this->hora->format('H:i:s'); 
    }

}
