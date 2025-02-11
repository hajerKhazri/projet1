<?php

namespace App\Form;

use App\Entity\Consultation;
use App\Entity\Patient;
use App\Entity\Psychiatre;
use App\Entity\RDV;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text'
            ])
            ->add('heure', null, [
                'widget' => 'single_text'
            ])
            ->add('status')
            ->add('traitement')
            ->add('patient', EntityType::class, [
                'class' => Patient::class,
'choice_label' => 'id',
            ])
            ->add('psychiatre', EntityType::class, [
                'class' => Psychiatre::class,
'choice_label' => 'id',
            ])
            ->add('rDV', EntityType::class, [
                'class' => RDV::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
        ]);
    }
}
