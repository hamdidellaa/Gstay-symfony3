<?php

namespace Gstay\hotelBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class promoHotelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('status', ChoiceType::class, array(
                'choices'  => array(
                    'Active' => 0,
                    'Disabled' => 1,
                    'on Going' => 2,
                ),))
            ->add('description',TextareaType::class)
            ->add('youtube')
            ->add('pourcentage')
            ->add('date_begin',DateType::class, [
                'widget' => 'single_text',


                'attr' => [

                    'placeholder'=>"Check in",
                ]
            ])

            ->add('date_end',DateType::class, [
                'widget' => 'single_text',


                'attr' => [

                    'placeholder'=>"Check out",
                ]
            ])
            ->add('maxplace')
            ->add('roomConcerned',EntityType::class, array(
                'class'=>'GstayhotelBundle:room',
                'choice_label'=>'name',
                'multiple'=>false,    ))     ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gstay\hotelBundle\Entity\promoHotel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gstay_hotelbundle_promohotel';
    }


}
