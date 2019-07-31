<?php

namespace AppBundle\Form;

//use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pcName',TextType::class,array(
                'label'=>'PC Name'
            ))
            ->add('monitor1Model',TextType::class,array(
                'label'=>'Monitor 1 - Model',
                'required' => false
            ))
            ->add('monitor1ID',TextType::class,array(
                'label'=>'Monitor 1 - Asset ID',
                'required' => false
            ))
            ->add('monitor2Model',TextType::class,array(
                'label'=>'Monitor 2 - Model',
                'required' => false
            ))
            ->add('monitor2ID',TextType::class,array(
                'label'=>'Monitor 2 - Asset ID',
                'required' => false
            ))
            ->add('keyboardModel',TextType::class,array(
                'label'=>'Keyboard - Model',
                'required' => false
            ))
            ->add('keyboardID',TextType::class,array(
                'label'=>'Keyboard - Asset ID',
                'required' => false
            ))
            ->add('mouseModel',TextType::class,array(
                'label'=>'Mouse - Model',
                'required' => false
            ))
            ->add('mouseID',TextType::class,array(
                'label'=>'Mouse - Asset ID',
                'required' => false
            ))
            ->add('headsetModel',TextType::class,array(
                'label'=>'Headset - Model',
                'required' => false
            ))
            ->add('headsetID',TextType::class,array(
                'label'=>'Headset - Asset ID',
                'required' => false
            ))
            ->add('cpuModel',TextType::class,array(
                'label'=>'CPU - Model',
                'required' => false
            ))
            ->add('cpuID',TextType::class,array(
                'label'=>'CPU - Asset ID',
                'required' => false
            ))
            ->add('upsModel',TextType::class,array(
                'label'=>'UPS - Model',
                'required' => false
            ))
            ->add('upsID',TextType::class,array(
                'label'=>'UPS - Asset ID',
                'required' => false
            ))
            ->add('description',TextareaType::class,array(
                'label'=>'Description',
                'required' => false
            ))
            ->add('html',TextareaType::class,array(
                'label'=>'Specification',
                'required' => false
            ))
            ->add('save', SubmitType::class)

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'app_bundle_asset_type';
    }
}
