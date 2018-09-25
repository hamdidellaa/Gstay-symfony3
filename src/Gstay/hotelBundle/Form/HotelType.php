<?php

namespace Gstay\hotelBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HotelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('stars',IntegerType::class
            )
            ->add('phone')

            ->add('dateBuilt',\Symfony\Component\Form\Extension\Core\Type\DateType::class, [
                'widget' => 'single_text',


                'attr' => [

                    'placeholder'=>"Built",
                ]
            ])
            ->add('altitude',HiddenType::class)
            ->add('langitude',HiddenType::class)
            ->add('country')
            ->add('gouvernorat')
            ->add('adresse')
            ->add('description',TextareaType::class)
            ->add('architecture')
            ->add('matricule_fiscale')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ])



            ->add('Save',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gstay\hotelBundle\Entity\Hotel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gstay_hotelbundle_hotel';
    }


}
