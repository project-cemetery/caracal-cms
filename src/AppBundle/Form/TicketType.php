<?php

namespace AppBundle\Form;


use AppBundle\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customerName', TextType::class, ['label' => 'Имя'])
            ->add('customerEmail', EmailType::class, ['label' => 'Email'])
            ->add('customerMessage', TextareaType::class, ['label' => 'Сообщение'])
            ->add('submit', SubmitType::class, ['label' => 'Отправить сообщение']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ticket::class
        ));
    }
}