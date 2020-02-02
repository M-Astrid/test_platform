<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['questions'] as $question)
        {
            // if single answer
            if ($question->getType()->getId() == 1) {
                $answerNum = 1;

                foreach ($question->getAnswerItems() as $answer) {
                    $label = "$answerNum) " . $answer->getText();
                    $name = "answer";
                    $value = $answer->getId();

                    $builder->add($name, RadioType::class, [
                        'label' => $label,
                        'value' => $value
                    ]); // todo 'constraints' => [new Length(['min' => 3]

                    $answerNum++;
                }
            }

        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'questions' => array(),
        ]);
    }
}
