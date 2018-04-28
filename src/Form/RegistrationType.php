<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/28/2018
 * Time: 6:22 PM
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('required' => true, "label" => "El. paštas"))
            ->add('firstName', TextType::class, array('required' => true, "label" => "Vardas"))
            ->add('lastName', TextType::class, array('required' => true, "label" => "Pavardė"))
            ->add('phone', TextType::class, array('required' => true, "label" => "Telefono numeris"))
            ->add('lastName', TextType::class, array('required' => true, "label" => "Pavardė"))
            ->add('save', SubmitType::class, array("label" => "Registruotis"))
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Registration',
            'attr' => array(
                'class' => 'registration'
            )
        ));
    }
}