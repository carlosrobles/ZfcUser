<?php

namespace ZfcUser\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZfcUser\Form\Register as RegisterForm;
use Zend\View\Model\ViewModel;

class _ZfcUserRegisterWidget extends AbstractHelper
{
    /**
     * Reg Form
     * @var RegForm
     */
    protected $regForm;

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
            'registerForm' => $this->getRegForm(),
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
     * Retrieve Reg Form Object
     * @return RegForm
     */
    public function getRegForm()
    {
        return $this->regForm;
    }

    /**
     * Inject Reg Form Object
     * @param RegForm $regForm
     * @return ZfcUserRegWidget
     */
    public function setRegForm(RegisterForm $regForm)
    {
        $this->regForm = $regForm;
        return $this;
    }

    /**
     * @param string $viewTemplate
     * @return ZfcUserRegWidget
     */
    public function setViewTemplate($viewTemplate)
    {
        $this->viewTemplate = $viewTemplate;
        return $this;
    }

}
