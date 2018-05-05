<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/5/2018
 * Time: 10:13 AM
 */

namespace App\Form;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryType extends AbstractType
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
            ->add('photo', FileType::class, array('required' => true, "label" => "Nuotrauka", 'data_class' => null))
            ->add('save', SubmitType::class, array("label" => "Išsaugoti", 'attr'=> array('class'=>'btn-sm float-right btn-primary btn')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Gallery',
            'attr' => array(
                'class' => 'gallery'
            )
        ));
    }
}