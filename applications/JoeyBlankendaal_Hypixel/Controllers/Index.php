<?php
class Index extends Controller
{
    public function __contruct()
    {
        parent::__construct();
    }
    
    public function index()
    {   
        $welcome = new View();
        $welcome->render('Index/Welcome');
        
        $contactForm = new Form();
        
        $contactForm->setValidation('name', array('alpha' => true, 'minLength' => 3, 'maxLength' => 50, 'required' => true));
        $contactForm->setValidation('email', array('alphaNumeric' => true, 'minLength' => 6, 'maxLength' => 100, 'required' => true));
        
        if (isset($_POST['submit']))
        {
            if ($contactForm->validateFields($_POST))
            {
                if ($loginForm->validEmail($loginForm->getField('email')))
                {
                    echo 'Your contact form has been sent and will be read as soon as possible!';
                }
            }
        }
        
        $contactMe = new View();
        $contactMe->render('Index/ContactMe');
        
        echo $contactForm->openForm();
        echo $contactForm->setField('text', 'name', 'Name:');
        echo $contactForm->setField('text', 'email', 'Email:');
        echo $contactForm->setSubmit('submite', 'Send');
        echo $contactForm->closeForm();
    }
}