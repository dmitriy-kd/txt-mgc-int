<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\Model\TestModel;
use App\Form\Type\TestType;
use App\Service\Test\TestResultManipulator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly TestResultManipulator $testResultManipulator
    ) {}

    #[Route(
        '/',
        name: 'main_page',
        methods: ['GET', 'POST']
    )]
    public function show(Request $request): Response
    {
        $form = $this->createForm(TestType::class)
            ->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $testResult = $this->testResultManipulator->createTestResult($form->getData());

                $testResultQuestionLists = $this->testResultManipulator->getQuestionLists($testResult);

                return $this->render('Test/show_result.html.twig', [
                    'passQuestions' => $testResultQuestionLists['pass'],
                    'notPassQuestions' => $testResultQuestionLists['not_pass']
                ]);
            }

            return $this->render('Test/validation_errors.html.twig', [
                'errors' => $form->getErrors()
            ]);
        }

        $questions = $this->em->getRepository(Question::class)
            ->findAll();

        $testModel = (new TestModel())->setQuestions($questions);

        $form = $this->createForm(TestType::class, $testModel);

        return $this->render('Test/show_test.html.twig', [
            'form' => $form->createView()
        ]);
    }
}