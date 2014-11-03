<?php

namespace Diario\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Professor
 *
 * @ORM\Table(name="professor")
 * @ORM\Entity
 */
class Professor
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
     * @ORM\Column(name="email", type="string", length=75)
     */
    private $email;

    // @ORM\OneToOne(targetEntity="Diario\UsuarioBundle\Entity\Usuario", cascade={"persist","remove"})
    // @ORM\JoinColumn(name="fos_user_id", referencedColumnName="id")
    // private $usuario;


    /**
     * Set id
     *
     * @param integer $id
     * @return Professor
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
     * @return Professor
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
     * @return Professor
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
     * Set usuario
     *
     * @param \Diario\UsuarioBundle\Entity\Usuario $usuario
     * @return Professor
     */
    // public function setUsuario(\Diario\UsuarioBundle\Entity\Usuario $usuario = null)
    // {
    //     $this->usuario = $usuario;

    //     return $this;
    // }

    /**
     * Get usuario
     *
     * @return \Diario\UsuarioBundle\Entity\Usuario 
     */
    // public function getUsuario()
    // {
    //     return $this->usuario;
    // }
}
