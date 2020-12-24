<?php

namespace App\Form;

use App\Entity\Section;
use App\Entity\Activity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Name',
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextType::class,[
                'label' => 'Description',
                'attr' => ['class' => 'form-control']
            ])
           
            ->add('sections', EntityType::class, [
                'class' => Section::class,
                'choice_label' => 'title',
                'label' => 'Section',
                'attr' => ['class' => 'form-control']
            ])
            ->add('file', FileType::class, [
                'label' => 'PDF File',
                'attr' => ['class' => 'form-control-file']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}
