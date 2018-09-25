<?php

namespace Gstay\guesthostBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EquipementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('euipement', ChoiceType::class, array(
                'choices'  => array(
                    'parking' => 'parking' ,
                    'Ferarepasser' => 'Ferarepasser' ,
                    'Cintres' => 'Cintres' ,
                    'Chauffage' => 'Chauffage' ,
                    'Climatisation' => 'Climatisation' ,
                    'Jacuzzi' => 'Jacuzzi' ,
                    'Piscine' => 'Piscine' ,
                    'Television' => 'Television' ,
                    'Interphone' => 'Interphone' ,
                    'Ascenseur' => 'Ascenseur' ,
                    'wifi' => 'wifi' ,
                    'cuisine' => 'cuisine' ,
                      )
            ))
        ->add('addd',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gstay\guesthostBundle\Entity\Equipement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gstay_guesthostbundle_equipement';
    }


}
