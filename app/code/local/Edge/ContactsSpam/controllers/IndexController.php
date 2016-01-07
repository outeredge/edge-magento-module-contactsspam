<?php

require_once('Mage/Contacts/controllers/IndexController.php');
class Edge_ContactsSpam_IndexController extends Mage_Contacts_IndexController
{
    public function postAction()
    {
        $post = $this->getRequest()->getPost();
        if ($post) {
            if (Zend_Validate::is(trim($post['first_name']), 'NotEmpty')) {
                Mage::getSingleton('customer/session')->addError(Mage::helper('contacts')->__('Unable to submit your request. Please, try again later'));
                $this->_redirect('*/*/');
                return;
            }
        }

        parent::postAction();
    }
}