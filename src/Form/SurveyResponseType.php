<?php

namespace App\Form;

use App\Entity\SurveyResponse;
use App\Repository\QuestionRepository;
use App\Repository\SurveyRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Zikula\Bundle\DynamicFormPropertyBundle\DynamicPropertiesContainerInterface;
use Zikula\Bundle\DynamicFormPropertyBundle\Form\Type\InlineFormDefinitionType;

class SurveyResponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('survey', InlineFormDefinitionType::class, [
                'dynamicFieldsContainer' => $options['survey'],
                'inherit_data' => true
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SurveyResponse::class,
            'survey' => null,
        ]);
        $resolver->addAllowedTypes('survey', DynamicPropertiesContainerInterface::class);
    }
}
