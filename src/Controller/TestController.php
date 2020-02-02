<?php
namespace App\Controller;

use App\Entity\UserAnswer;
//use App\Form\TestType;
use App\Form\TestFormType;
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

        $userAnswer = new UserAnswer();

        $form = $this->createForm(TestFormType::class, $userAnswer, ['questions' => $questions]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // todo check function, errors print
            $data = $form->getData();

            // ... . выполните действия, такие как сохранение задачи в базе данных
            // например, если Task является сущностью Doctrine, сохраните его!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();

            // todo if isset user

            $this->redirectToRoute('completed', ['test' => $id]);
        }
        return $this->render('test/show.html.twig', [
            'controller_name' => 'TestController',
            'test' => $test,
            'questions' => $questions,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/result/{id}", methods={"GET"}, name="completed")
     */
    /*
    public function passed($id, UserAnswerRepository $repository)
    {
// todo возможно перенести в другой контроллер
        return $this->render('test/result.html.twig', [
            'controller_name' => 'TestController',
            'test' => $test,
            'questions' => $questions,
        ]);
    }
*/

}
