<?php

namespace Diario\AdmBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Diario\AdmBundle\Form\Type\DiarioType;
use Diario\AdmBundle\Entity\Turma;
use Diario\AdmBundle\Entity\Aula;
use Diario\AdmBundle\Entity\Horario;

class DiarioController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $turmas = $em->getRepository('DiarioAdmBundle:Turma')->findAll();

        return $this->render('DiarioAdmBundle:Diario:index.html.twig',array('turmas' => $turmas));    
    }

    /**
     * Displays a form to create a new Curso entity.
     *
     */
    public function newAction()
    {
        $form   = $this->createForm(new DiarioType());

        return $this->render('DiarioAdmBundle:Diario:new.html.twig', array(
            'form'   => $form->createView(),
        ));
    }

    public function showAction(Turma $turma)
    {
        $deleteForm = $this->createDeleteForm($turma->getId());

        return $this->render('DiarioAdmBundle:Diario:show.html.twig', array(
            'turma' => $turma,
            'delete_form' => $deleteForm->createView(),        
        ));
    }

    public function gerarAulasAction($idTurma)
    {
        $em = $this->getDoctrine()->getManager();
        $turma = $em->getRepository('DiarioAdmBundle:Turma')->find($idTurma);

        $listaExclusao = array();
        if(!$turma->getAulas()->isEmpty())
        {
            $aulas = $turma->getAulas();
            foreach ($aulas as $aula) {
                array_push($listaExclusao, $aula->getData());
            }
        }
        
        $diasSemana = array();
        $aulas = array();
        $horarios = $turma->getHorarios();

        foreach ($horarios as $h) {
            array_push($diasSemana, $h->getDia());
        }   

        $inicio = $turma->getDataInicio();
        $termino = $turma->getDataTermino();
        $termino = $termino->modify('+1 day');

        $intervalo = new \DateInterval('P1D');
        $periodo = new \DatePeriod($inicio, $intervalo ,$termino);

        foreach($periodo as $data)
        {            
            $dia = $this->representacaoDia($data->format('w'));
            if (in_array($dia, $diasSemana))
            {
                $dataHorario = $data;

                foreach ($horarios as $h) {
                    if($h->getDia() == $dia)
                    {
                        $dataHorario = $data->add(\DateInterval::createFromDateString(
                            $h->getHora()->format('H') . "hours" . " + ".  $h->getHora()->format('i') . 'minutes' )
                        );
                        continue;
                    }
                }

                if (in_array($data, $listaExclusao))
                    continue;

                $aula = new Aula();
                $aula->setData($dataHorario);
                $aula->setTurma($turma);

                array_push($aulas, $aula);
            }
        }

        foreach ($aulas as $aula) {
            $turma->addAula($aula);
        }

        $em->persist($turma);
        $em->flush();

        return $this->redirect($this->generateUrl('diario_show', array('id' => $turma->getId())));
    }

    public function representacaoDia($NumDiaSemana)
    {
        $dias = array(
            0 => 'dom',
            1 => 'seg',
            2 => 'ter',
            3 => 'qua',
            4 => 'qui',
            5 => 'sex',
            6 => 'sab'
        );
        return $dias[$NumDiaSemana];
    }

    private function getDias($form)
    {
        $dias = array();

        if ($form->get('cargaHoraria')->getData() == 30)
        {
            if (is_null($form->get('dia1')->getData()))
                throw new \Exception("Campo dia 1 obrigatorio");
                
            $dias[] = $form->get('dia1')->getData();
        }
        else if ($form->get('cargaHoraria')->getData() == 60)
        {
            if (is_null($form->get('dia1')->getData()))
                throw new \Exception("Campo dia 1 obrigatorio");
            
            if (is_null($form->get('dia2')->getData()))
                throw new \Exception("Campo dia 2 obrigatorio");

            $dias[] = $form->get('dia1')->getData();  
            $dias[] = $form->get('dia2')->getData();
        }
        else if ($form->get('cargaHoraria')->getData() == 90)
        {
            if (is_null($form->get('dia1')->getData()))
                throw new \Exception("Campo dia 1 obrigatorio");
            
            if (is_null($form->get('dia2')->getData()))
                throw new \Exception("Campo dia 2 obrigatorio");
            
            if (is_null($form->get('dia3')->getData()))
                throw new \Exception("Campo dia 3 obrigatorio");

            $dias[] = $form->get('dia1')->getData();
            $dias[] = $form->get('dia2')->getData();
            $dias[] = $form->get('dia3')->getData(); 
        }

        return $dias;
    }

    /**
     * Creates a new Turma entity.
     *
     */
    public function createAction(Request $request)
    {
        $turma = new Turma();
        $form = $this->createForm(new DiarioType(), $turma);
        if ($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $dias = $this->getDias($form);

            if (empty($turma->getDataInicio()))
            {
                throw new \Exception("Data de inicio obrigatoria");
            }

            if (empty($turma->getDataTermino()))
            {
                throw new \Exception("Data de termino obrigatoria");
            }

            $bd_turma = $em->getRepository('DiarioAdmBundle:Turma')->findOneBy(
                array
                (
                    'disciplina' => $turma->getDisciplina(),
                    'professor' => $turma->getProfessor(),
                    'codigoTurma' => $turma->getCodigoTurma(),
                    'ano' => $turma->getAno(),
                    'semestre' => $turma->getSemestre(),
                    'dataInicio' => $turma->getDataInicio(),
                    'dataTermino' => $turma->getDataTermino(),
                )
            );

            if (!empty($bd_turma))
            {
                throw new \Exception("Diario existente");
                
            }
            
            foreach ($dias as $d) {
                $horario = new Horario();
                $horario->setDia($d);
                $horario->setHora(new \DateTime('00:00:00'));
                $turma->addHorario($horario);
                $horario->setTurma($turma);
                $em->persist($horario);
            }

            $em->persist($turma);
            $em->flush();

            $this->gerarAulasAction($turma->getId());

            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Cadastro efetuado com sucesso!');

            return $this->redirect($this->generateUrl('diario_show', array('id' => $turma->getId())));
        }

        return $this->render('DiarioAdmBundle:Diario:new.html.twig', array(
            'turma' => $turma,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Create Delete form
     *
     * @param integer $id
     * @return \Symfony\Component\Form\Form
     */
    protected function createDeleteForm($id)
    {
        return $this->createFormBuilder(null, array('attr' => array('id' => 'delete')))
            ->setAction($this->generateUrl('diario_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
