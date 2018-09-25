<?php

namespace Gstay\eventBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class evenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Autre' => 'Autre',
                    'Attraction' => 'Attraction',
                    'Conférance' => 'Conférance',
                    'Diner or gala' => 'Diner or gala',
                ),
            ))

            ->add('theme', ChoiceType::class, array(
                'choices'  => array(
                    'Autre' => 'Autre',
                    'Concerts et spectacle' => 'Concerts et spectacle',
                    'sport fitness' => 'sport fitness',
                    'Voyage et activites' => 'Voyage et activites',
                ),
            ))
            ->add('planing',TextareaType::class)
            ->add('addess')
            ->add('ville')
            ->add('gouvernerat')
            ->add('code_postal')
            ->add('date_debut',DateType::class, array(
                'widget' => 'single_text',
                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => true,
                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
            ))
            ->add('date_fin',DateType::class,  array(
                'widget' => 'single_text',
                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => true,
                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
            ))


            ->add('lien_fb')
            ->add('lien_youtube')

            ->add('nb_ticket')
            ->add('prix')

            ->add('latitude')
            ->add('longitude')
    ->add('imageFile', VichImageType::class, [
     'required' => false,
     'allow_delete' => true, // not mandatory, default is true
     'download_link' => true, // not mandatory, default is true
 ])


            ->add('hotel',EntityType::class, array(
                'class'=>'GstayhotelBundle:Hotel',
                'choice_label'=>'name',
                'multiple'=>false,

            ))        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gstay\eventBundle\Entity\evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gstay_eventbundle_evenement';
    }


}
