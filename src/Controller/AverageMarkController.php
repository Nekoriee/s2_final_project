<?php

namespace App\Controller;

use App\Entity\Smarks;
use App\Entity\Sstudent;
use App\Entity\Ssubject;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AverageMarkController extends AbstractController
{

    public function calcAverage($marks): ?float {
        $count = count($marks);
        if ($count > 0) {
            $average_mark = 0;
            foreach ($marks as $mark) {
                $addMark = $mark->getMark();
                if (!($addMark > 0 and $addMark <= 5)) $addMark = 0;
                $average_mark += $addMark;
            }
            $average_mark = (float)$average_mark / $count;
        }
        else $average_mark = null;
        return $average_mark;
    }

    /**
     * @Route("/school/averageMark")
     */
    public function show(): Response
    {
        $request = Request::createFromGlobals();
        $subject = $request->query->get('subject');
        $student = $request->query->get('student');
        if ($subject != '') {
            $marks = $this->getDoctrine()->getRepository(Smarks::class)->findBy(array('ssubject_id' => $subject));
            $subjects = $this->getDoctrine()->getRepository(Ssubject::class)->findBy(array('id' => $subject));
            $subject_name = $subjects[0]->getName();
            $average_mark = $this->calcAverage($marks);
            return $this->render('averageMark/result.html.twig',[
                'mark' => $average_mark,
                'student_name' => null,
                'subject_name' => $subject_name,
            ]);
        }
        elseif ($student != '') {
            $marks = $this->getDoctrine()->getRepository(Smarks::class)->findBy(array('sstudent_id' => $student));
            $students = $this->getDoctrine()->getRepository(Sstudent::class)->findBy(array('id' => $student));
            $student_name = $students[0]->getFio();
            $average_mark = $this->calcAverage($marks);
            return $this->render('averageMark/result.html.twig',[
                'mark' => $average_mark,
                'student_name' => $student_name,
                'subject_name' => null,
            ]);
        }
        else {
            $tabl_students = $this->getDoctrine()->getRepository(Sstudent::class)->findAll();
            $tabl_subjects = $this->getDoctrine()->getRepository(Ssubject::class)->findAll();
            return $this->render('averageMark/index.html.twig',
                [
                    'tabl_students' => $tabl_students,
                    'tabl_subjects' => $tabl_subjects,
            ]);
        }

    }
}