<?php

namespace App\Infra;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author Nicolas OLIVE <nicolas.olive@viacesi.fr>
 */
class ChooseTextType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text',      ChoiceType::class, [
                'placeholder' => 'Text To Decrypt',
                'label'       => false,
                'choices'     => [
                    'PA' => 'PA',
                    'PB' => 'PB',
                    'PC' => 'PC',
                    'PD' => 'PD',
                    'PE' => 'PE',
                    'PF' => 'PF',
                    'PG' => 'PG',
                    'PH' => 'PH',
                    'PI' => 'PI',
                    'PJ' => 'PJ',
                    'PK' => 'PK',
                ],
            ])
            ->add('save',    SubmitType::class, [
                'label' => 'Decrypt'
            ])
        ;
    }
}