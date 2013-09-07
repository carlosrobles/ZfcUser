<?php

namespace ZfcUser\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZfcUser\Form\Register as RegisterForm;
use Zend\View\Model\ViewModel;

class ZfcUserRegisterWidget extends AbstractHelper
{
    /**
     * Login Form
     * @var LoginForm
     */
    protected $loginForm;

    /**
     * $var string template used for view
     */
    protected $viewTemplate;
    /**
     * __invoke
     *
     * @access public
     * @param array $options array of options
     * @return string
     */
    public function __invoke($options = array())
    {
        if (array_key_exists('render', $options)) {
            $render = $options['render'];
        } else {
            $render = true;
        }
        if (array_key_exists('redirect', $options)) {
            $redirect = $options['redirect'];
        } else {
            $redirect = false;
        }
    //   $config = $sm->get('Config');
       //  $config = $config['zfcuser'];
        
        $vm = new ViewModel(array(
        	'enableRegistration' => true,//TODO $config['enable_registration'],
            'registerForm' => $this->getLoginForm(),
            'redirect'  => $redirect,
        ));
        $vm->setTemplate($this->viewTemplate);
        if ($render) {
            return $this->getView()->render($vm);
        } else {
            return $vm;
        }
    }

    /**
     * Retrieve Login Form Object
     * @return LoginForm
     */
    public function getLoginForm()
    {
        return $this->loginForm;
    }

    /**
     * Inject Login Form Object
     * @param LoginForm $loginForm
     * @return ZfcUserLoginWidget
     */
    public function setLoginForm(RegisterForm $loginForm)
    {
        $this->loginForm = $loginForm;
        return $this;
    }

    /**
     * @param string $viewTemplate
     * @return ZfcUserLoginWidget
     */
    public function setViewTemplate($viewTemplate)
    {
        $this->viewTemplate = $viewTemplate;
        return $this;
    }

}
