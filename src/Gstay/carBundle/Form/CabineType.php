<?php

namespace Gstay\carBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CabineType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom')

            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                        'exterior Stateroom' => 'exterior Stateroom',
                          'interior Stateroom' =>  'interior Stateroom',
                    'Balcony Stateroom' =>  'Balcony Stateroom',

                    'Suite' =>'Suite',

                )))






            ->add('superficie')
            ->add('quantite')
            ->add('maxper')
            ->add('nbr_lit')
            ->add('salle_bain', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('tele', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('mini_bar', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('coffre_fort', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('clim', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('dressing', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ])
            ->add('prix');


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gstay\carBundle\Entity\Cabine'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gstay_carbundle_cabine';
    }


}
