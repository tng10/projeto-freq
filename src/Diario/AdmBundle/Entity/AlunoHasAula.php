<?php

namespace Diario\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlunoHasAula
 *
 * @ORM\Table(name="aluno_has_aula")
 * @ORM\Entity
 */
class AlunoHasAula
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="presenca", type="boolean")
     */
    private $presenca;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Aluno", inversedBy="aulas", cascade={"persist","refresh"})
     * @ORM\JoinColumn(name="aluno_id", referencedColumnName="id")
     */
    protected $aluno;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Aula", inversedBy="alunos", cascade={"persist","refresh"})
     * @ORM\JoinColumn(name="aula_id", referencedColumnName="id")
     */
    protected $aula;


    /**
     * Set presenca
     *
     * @param boolean $presenca
     * @return AlunoHasAula
     */
    public function setPresenca($presenca)
    {
        $this->presenca = $presenca;

        return $this;
    }

    /**
     * Get presenca
     *
     * @return boolean 
     */
    public function getPresenca()
    {
        return $this->presenca;
    }

    /**
     * Set aluno
     *
     * @param \Diario\AdmBundle\Entity\Aluno $aluno
     * @return AlunoHasAula
     */
    public function setAluno(\Diario\AdmBundle\Entity\Aluno $aluno = null)
    {
        $this->aluno = $aluno;

        return $this;
    }

    /**
     * Get aluno
     *
     * @return \Diario\AdmBundle\Entity\Aluno 
     */
    public function getAluno()
    {
        return $this->aluno;
    }

    /**
     * Set aula
     *
     * @param \Diario\AdmBundle\Entity\Aula $aula
     * @return AlunoHasAula
     */
    public function setAula(\Diario\AdmBundle\Entity\Aula $aula = null)
    {
        $this->aula = $aula;

        return $this;
    }

    /**
     * Get aula
     *
     * @return \Diario\AdmBundle\Entity\Aula 
     */
    public function getAula()
    {
        return $this->aula;
    }
}
