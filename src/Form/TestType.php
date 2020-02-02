<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach($options['questions'] as $question)
        {
            // if single answer
            if ($question->getType()->getId() == 1)
            {
                $answerNum = 1;

                foreach ($question->answerItems as $answer)
                {
                    $label = "$answerNum) ".$answer->text;
                    $name = "single".$question->id;
                    $value = $answer->id;

                    $builder->add($name, RadioType::class, [
                        'label' => $label,
                        'value' => $value
                    ]); // todo 'constraints' => [new Length(['min' => 3]

                    $answerNum ++;
                }
            }

            // if multiple choice
            if ($question->getType()->getId() == 2)
            {
                $answerNum = 1;

                foreach ($question->answerItems as $answer)
                {
                    $label = "$answerNum) ".$answer->text;
                    $name = "multiple".$question->id."[]";
                    $value = $answer->id;

                    $builder->add($name, CheckboxType::class, [
                        'label' => $label,
                        'value' => $value
                    ]); // todo 'constraints' => [new Length(['min' => 3]

                    $answerNum ++;
                }
            }

            // if text answer
            if ($question->getType()->getId()  3)
            {
                foreach ($question->answerItems as $answer)
                {
                    $builder->add('Answer', TextType::class, [
                        'constraints' => [new NotBlank()]
                    ]);
                }
            }
        }
        $builder->add('Submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'questions' => array() // todo user field
        ));
    }
}

