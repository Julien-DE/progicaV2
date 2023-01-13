<?php

namespace App\Form;

use App\Entity\EqpExt;
use App\Entity\EqpInt;
use App\Entity\Gite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('city')
            ->add('zipcode')
            ->add('departement')
            ->add('region')
            ->add('surface')
            ->add('rooms')
            ->add('beds')
            ->add('animalAllowed')
            ->add('animalFee')
            ->add('greenPrice')
            ->add('redPrice')
            ->add('startRed')
            ->add('endRed')
            ->add('createdAt')
            ->add('updateAt')
            ->add('giteServices',CollectionType::class,[
                'allow_add' => true,
                'entry_type'=> GiteServiceType::class,
                
            ])
            ->add('giteEqpExts',CollectionType::class,[
                'allow_add' => true,
                'entry_type'=> GiteEqpExtType::class,
                
            ])
            ->add('giteEqpInts',CollectionType::class,[
                'allow_add' => true,
                'entry_type'=> GiteEqpIntType::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gite::class,
        ]);
    }
}
