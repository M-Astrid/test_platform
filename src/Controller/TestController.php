<?php
namespace App\Controller;

use App\Entity\AnswerItem;
use App\Entity\User;
use App\Entity\UserAnswer;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test_list")
     */
    public function index(TestRepository $repository)
    {
        $tests = $repository->findAll();
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'tests' => $tests,
        ]);
    }

    /**
     * @Route("/test/{id}", name="test_show")
     */
    public function show($id, Request $request, TestRepository $repository)
    {
        $test = $repository->find($id);
        $questions = $test->getQuestions();

        if ($request->getMethod() == 'POST')
        {
            //todo validation

            $entityManager = $this->getDoctrine()->getManager();
            $answerItems = $this->getDoctrine()
                ->getRepository(AnswerItem::class);

            foreach ($questions as $question)
            {
                $userAnswer = new UserAnswer();
                $userAnswer->setQuestion($question);

                if ($question->getType()->getId() == 1)
                {
                    $answer = $answerItems->find($request->request->get($question->getId()));
                    $userAnswer->addAnswer($answer);
                }
                elseif ($question->getType()->getId() == 2)
                if ($question->getType()->getId() == 2)
                {
                    foreach ($request->request->get($question->getId()) as $id)
                    {
                        $answer = $answerItems->find($id);
                        dump($answer);
                        $userAnswer->addAnswer($answer);
                    }
                }
                elseif ($question->getType()->getId() == 3)
                {
                    $answer = $request->request->get($question->getId());
                    $userAnswer->setAnswerText($answer);
                }
                $entityManager->persist($userAnswer);
                $entityManager->flush();
            }

            $this->redirectToRoute('completed', ['testId' => $id]);
        }
        return $this->render('test/show.html.twig', [
            'controller_name' => 'TestController',
            'test' => $test,
            'questions' => $questions,
        ]);
    }
}
