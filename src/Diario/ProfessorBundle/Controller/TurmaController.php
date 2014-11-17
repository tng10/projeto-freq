<?php

namespace Diario\ProfessorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Diario\AdmBundle\Entity\AlunoHasAula;
use Diario\ProfessorBundle\Form\Type\ImportarType;
use Diario\ProfessorBundle\Form\Type\ListaDiaType;
use Doctrine\Common\Collections\ArrayCollection;

class TurmaController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $professor = $em->getRepository('DiarioAdmBundle:Professor')->findOneBy(array('usuario' => $usuario));

        $turmas = $em->getRepository('DiarioAdmBundle:Turma')->findBy(array('professor' => $professor, 'ano' => date('Y')));

        $diarios = array();
        foreach ($turmas as $t) {
            $diarios[] = $this->verificaDiarioDeClasse($t);
        }

        $q = $em->getRepository('DiarioAdmBundle:Turma')->createQueryBuilder('d')
            ->where('d.professor = ?1')
            ->andWhere('d.ano = ?2')
            ->setParameter(1,$professor->getId())
            ->setParameter(2,date('Y'))
            ->getQuery();
        $paginator = $this->get('knp_paginator')->paginate($q, $request->query->get('page', 1), 20);

        return $this->render('DiarioProfessorBundle:Turma:index.html.twig', array('paginator' => $paginator, 'diarios' => $diarios));
    }

    public function showAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$turma = $em->getRepository('DiarioAdmBundle:Turma')->find($id);

        $importar = $this->verificaDiarioDeClasse($turma);

    	return $this->render('DiarioProfessorBundle:Turma:show.html.twig', array('turma' => $turma, 'importar' => $importar));
    }

    private function verificaDiarioDeClasse($turma)
    {
        $importar = true;
        $aulas = $turma->getAulas();
        $alunos = new ArrayCollection();

        foreach ($aulas as $aula) {
            $alunosAula = $aula->getAlunos();
            foreach ($alunosAula as $aluno) {
                if(!$alunos->contains($aluno))
                    $alunos->add($aluno);
            }
        }

        if(!$alunos->isEmpty())
            $importar = false;
        return $importar;
    }

    public function importarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $turma = $em->getRepository('DiarioAdmBundle:Turma')->find($id);
        $form = $this->createForm(new ImportarType(),null,array('attr' => array('turma' => $turma->getId())));

        return $this->render('DiarioProfessorBundle:Turma:importar.html.twig', 
            array('turma' => $turma, 'form' => $form->createView())
        );

    }

    public function processarAction(Request $request)
    {
        $requestImp = $request->request->get('importar');

        $turma_id = $requestImp['turma'];

        $form = $this->createForm(new ImportarType(), null, 
            array('attr' => array('turma' => $turma_id)
        ));

        if ($form->handleRequest($request)->isValid()) {
            
            $em = $this->getDoctrine()->getManager();

            $arquivo = $form['arquivo']->getData();

            $diario = $this->csv_to_array($arquivo->getPathName(),';');

            $matriculas = array();
            $alunos = new ArrayCollection();

            foreach ($diario as $d) {
                array_push($matriculas, (int)str_replace('.', '', $d['MATRICULA']));
            }

            $turma = $em->getRepository('DiarioAdmBundle:Turma')->find($turma_id);
            
            foreach ($matriculas as $mat) {
                $aluno = $em->getRepository('DiarioAdmBundle:Aluno')->find($mat);     
                $alunos->add($aluno);
            }

            if($turma != null)
            {
                $aulas = $turma->getAulas();

                foreach ($alunos as $aluno) {

                    foreach ($aulas as $aula) {
                        $aha = new AlunoHasAula();
                        $aha->setAula($aula);
                        $aha->setAluno($aluno);
                        $aha->setPresenca(false);

                        $aluno->addAula($aha);
                    }
                    $em->persist($aluno);
                    $em->flush();
                }   
            }

            return $this->redirect($this->generateUrl('professor_turma_show', array('id' => $turma->getId())));

        }

        return $this->redirect($this->generateUrl('professor_turma_show', array('id' => $turma->getId())));

    }

    public function diarioAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $turma = $em->getRepository('DiarioAdmBundle:Turma')->find($id);
        return $this->render('DiarioProfessorBundle:Turma:diario.html.twig',array('turma' => $turma));
    }

    public function listaDiaAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $aula = $em->getRepository('DiarioAdmBundle:Aula')->find($id);

        return $this->render('DiarioProfessorBundle:Turma:listaDia.html.twig',array('aula' => $aula));
    }

    public function diarioProcessarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $turma_id = $request->request->get('turma');
        $aula_id = $request->request->get('aula');

        $turma = $em->getRepository('DiarioAdmBundle:Turma')->find($turma_id);
        $aula = $em->getRepository('DiarioAdmBundle:Aula')->find($aula_id);

        $alunos = $aula->getAlunos();

        $i=0;
        foreach ($alunos as $aluno) {
            ++$i;
            $inputAluno = $request->request->get($aluno->getAluno()->getId());
            $inputPresenca = $request->request->get($aluno->getAluno()->getId().'_'.$i);

            $presenca = false;
            if($inputPresenca == 'on')
                $presenca = true;

            $aluno->setPresenca($presenca);

            $em->persist($aluno);

        }

        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Frequencia efetuada com sucesso!');

        return $this->redirect($this->generateUrl('professor_turma_diario', array('id' => $turma->getId())));

    }
    
    /**
     * Convert a comma separated file into an associated array.
     * The first row should contain the array keys.
     * 
     * Example:
     * 
     * @param string $filename Path to the CSV file
     * @param string $delimiter The separator used in the file
     * @return array
     * @link http://gist.github.com/385876
     * @author Jay Williams <http://myd3.com/>
     * @copyright Copyright (c) 2010, Jay Williams
     * @license http://www.opensource.org/licenses/mit-license.php MIT License
     */
    function csv_to_array($filename='', $delimiter=',')
    {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;
        
        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    

}
