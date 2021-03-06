<?php

namespace AdminBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('inn', TextType::class, ['label' => 'Идентифiкацiйний код'])
            ->add('lastName', TextType::class, ['label' => 'Прізвище'])
            ->add('firstName', TextType::class, ['label' => 'Им\'я'])
            ->add('middleName', TextType::class, ['label' => 'По батьковi'])
            ->add('birthday', TextType::class, [
                'label' => 'Дата Народження',
                'attr' => ['placeholder' => 'Формат: 1950-05-25, якщо є ІНН, Дата Народження буде вирахувано автоматично']
            ])
            ->add('sex', ChoiceType::class, [
                'label' => 'Стать',
                'choices' => ['Чоловік' => 'M', 'Жінка' => 'F'],
            ]);
//            ->add('phone', TextType::class, ['label' => 'Телефон'])
//            ->add('email', EmailType::class, ['label' => 'E-mail'])
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_user';
    }
}
