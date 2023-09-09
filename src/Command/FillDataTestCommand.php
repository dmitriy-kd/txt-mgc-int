<?php

namespace App\Command;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\TestItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FillDataTestCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
        parent::__construct('app:fill-data-test');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $questions = $this->createQuestions();
        $answers = $this->createAnswers();
        $this->createTestItems($questions, $answers);

        $this->em->flush();

        return Command::SUCCESS;
    }

    private function createQuestions(): array
    {
        $questions = [];

        for ($i = 1; $i <= 10; $i++) {
            $question = new Question("{$i}+{$i}");

            $this->em->persist($question);
            $questions[$i] = $question;
        }

        return $questions;
    }

    private function createAnswers(): array
    {
        $answers[1] = new Answer("3");
        $answers[2] = new Answer("2");
        $answers[3] = new Answer("0");
        $answers[4] = new Answer("4");
        $answers[5] = new Answer("3+1");
        $answers[6] = new Answer("10");
        $answers[7] = new Answer("1+5");
        $answers[8] = new Answer("1");
        $answers[9] = new Answer("6");
        $answers[10] = new Answer("2+4");
        $answers[11] = new Answer("8");
        $answers[12] = new Answer("0+8");
        $answers[13] = new Answer("18");
        $answers[14] = new Answer("9");
        $answers[15] = new Answer("12");
        $answers[16] = new Answer("5+7");
        $answers[17] = new Answer("5");
        $answers[18] = new Answer("14");
        $answers[19] = new Answer("16");
        $answers[20] = new Answer("17+1");
        $answers[21] = new Answer("3+16");
        $answers[22] = new Answer("20");

        for ($i = 1; $i <= 22; $i++) {
            $this->em->persist($answers[$i]);
        }

        return $answers;
    }

    private function createTestItems(array $questions, array $answers): void
    {
        $mapQuestionsAnswers = [
            1 => [
                1 => false,
                2 => true,
                3 => false,
            ],
            2 => [
                4 => true,
                5 => true,
                6 => false,
            ],
            3 => [
                7 => true,
                8 => false,
                9 => true,
                10 => true,
            ],
            4 => [
                11 => true,
                4 => false,
                3 => false,
                12 => true,
            ],
            5 => [
                9 => false,
                13 => false,
                6 => true,
                14 => false,
                3 => false,
            ],
            6 => [
                1 => false,
                14 => false,
                3 => false,
                15 => true,
                16 => true,
            ],
            7 => [
                17 => false,
                18 => true,
            ],
            8 => [
                19 => true,
                15 => false,
                14 => false,
                17 => false,
            ],
            9 => [
                13 => true,
                14 => false,
                20 => true,
                21 => false,
            ],
            10 => [
                3 => false,
                2 => false,
                11 => false,
                22 => true,
            ],
        ];

        foreach ($mapQuestionsAnswers as $questionIndex => $answerIndexes) {
            foreach ($answerIndexes as $answerIndex => $isRightAnswer) {
                $testItem = new TestItem(
                    $questions[$questionIndex],
                    $answers[$answerIndex],
                    $isRightAnswer
                );

                $this->em->persist($testItem);
            }
        }
    }
}