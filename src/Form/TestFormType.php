<?php

namespace App\Form;

use App\Entity\UserAnswer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', TextType::class, [
        'constraints' => [new NotBlank()]
    ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserAnswer::class,
            'questions' => array(),
        ]);
    }
}

//foreach ($options['questions'] as $question)
//        {
//            // if single answer
//            if ($question->getType()->getId() == 1) {
//                $answerNum = 1;
//
//                foreach ($question->getAnswerItems() as $answer) {
//                    $label = "$answerNum) " . $answer->getText();
//                    $name = "text";
//                    $value = $answer->getId();
//
//                    $builder->add($name, RadioType::class, [
//                        'label' => $label,
//                        'value' => $value
//                    ]); // todo 'constraints' => [new Length(['min' => 3]
//
//                    $answerNum++;
//                }
//            }
//
//        }