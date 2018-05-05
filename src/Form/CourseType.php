<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/4/2018
 * Time: 9:57 PM
 */

namespace App\Form;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('required' => true, "label" => "Pavadinimas", 'attr'=> array('class'=>'form-control')))
            ->add('eventDate', DateTimeType::class, array('widget' => 'single_text', 'required' => true, "label" => "Mokymų data", 'attr'=> array('class'=>'form-control')))
            ->add('price', MoneyType::class, array('currency' => false, 'required' => true, "label" => "Kaina", 'attr'=> array('class'=>'form-control')))
            ->add('description', TextareaType::class, array('required' => true, "label" => "Aprašymas", 'attr'=> array('class'=>'form-control')))
            ->add('save', SubmitType::class, array("label" => "Išsaugoti", 'attr'=> array('class'=>'btn-sm float-right btn-primary btn')));

        if($options['validation_groups'][0] == 'add')
        {
            $builder->add('photo', FileType::class, array('required' => true, "label" => "Nuotrauka", 'data_class' => null));
        }
        else
        {
            $builder->add('photo', FileType::class, array('required' => false, "label" => "Nuotrauka", 'data_class' => null));
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Course',
            'attr' => array(
                'class' => 'course'
            ),
            'validation_groups' => array('add')
        ));
    }
}