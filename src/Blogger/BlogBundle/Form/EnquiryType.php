<?php
// src/Blogger/BlogBundle/Form/EnquiryType.php

namespace Blogger\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EnquiryType extends AbstractType
{
	    public function buildForm(FormBuilder $builder, array $options) //This function use the ,method of formbuilder to build the form
		        {	    											//This FormBuilder is a special class of symfony
				        $builder->add('name');
					        $builder->add('email', 'email');
					        $builder->add('subject');
						        $builder->add('body', 'textarea');
						    }

	        public function getName()
			    {
				            return 'contact';
					        }
}
