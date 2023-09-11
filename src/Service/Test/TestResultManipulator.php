<?php

namespace App\Service\Test;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\TestItem;
use App\Entity\TestResult;
use App\Entity\TestResultItem;
use App\Form\Model\TestModel;
use Doctrine\ORM\EntityManagerInterface;

readonly class TestResultManipulator
{
    public function __construct(private EntityManagerInterface $em) {}

    public function createTestResult(TestModel $testModel): TestResult
    {
        $testResult = new TestResult();
        $this->em->persist($testResult);
        $this->em->flush();

        foreach ($testModel->getQuestions() as $questionItem) {
            $question = $this->em->getRepository(Question::class)
                ->findOneBy([
                    'text' => $questionItem->getText()
                ]);

            if ($question) {
                foreach ($questionItem->getTestItems() as $questionTestItem) {
                    /** @var TestItem $questionTestItem */

                    $answer = $this->em->getRepository(Answer::class)
                        ->findOneBy([
                            'text' => $questionTestItem->getAnswer()->getText()
                        ]);

                    $testItem = $this->em->getRepository(TestItem::class)
                        ->findOneBy([
                            'question' => $question,
                            'answer' => $answer
                        ]);

                    $testResultItem = new TestResultItem(
                        $testResult,
                        $question,
                        $answer,
                        $testItem->isRightAnswer()
                    );

                    $testResult->addTestResultItem($testResultItem);
                    $this->em->persist($testResultItem);
                }
            }
        }

        $this->em->flush();

        return $testResult;
    }

    public function getQuestionLists(TestResult $testResult): array
    {
        $questionsWithWrongAnswers = [];
        $allQuestions = [];

        foreach ($testResult->getTestResultItems() as $testResultItem) {
            /** @var TestResultItem $testResultItem */
            $question = $testResultItem->getQuestion();

            $allQuestions[$question->getId()] = $question;

            if (!$testResultItem->isRightAnswer()) {
                $questionsWithWrongAnswers[$question->getId()] = $question;
            }
        }

        $questionsWithOnlyRightAnswers = array_diff_key($allQuestions, $questionsWithWrongAnswers);

        return [
            'pass' => $questionsWithOnlyRightAnswers,
            'not_pass' => $questionsWithWrongAnswers
        ];
    }
}