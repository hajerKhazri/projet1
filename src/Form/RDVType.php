<?php

namespace App\Form;

use App\Entity\Patient;
use App\Entity\Psychiatre;
use App\Entity\RDV;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RDVType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateheure', null, [
                'widget' => 'single_text'
            ])
            ->add('status')
            ->add('patient', EntityType::class, [
                'class' => Patient::class,
'choice_label' => 'id',
            ])
            ->add('psychiatre', EntityType::class, [
                'class' => Psychiatre::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RDV::class,
        ]);
    }
}
