<?php

class Edge_ContactsSpam_Model_Observer
{
    public function appendInput($observer)
    {
        $block = $observer->getEvent()->getBlock();
        $transport = $observer->getEvent()->getTransport();

        if ($block->getBlockAlias() == 'contactForm') {

            $dom = new DOMDocument;
            $dom->loadHTML($transport->getHtml());

            $child = $dom->createElement('input');
            $child->setAttribute('type', 'text');
            $child->setAttribute('name', 'first_name');
            $child->setAttribute('value', '');
            $child->setAttribute('class', 'contact-first-name');

            $form = $dom->getElementsByTagName('form')->item(0);
            $form->appendChild($child);

            $transport->setHtml($dom->saveHTML());
        }

        return $this;
    }

}
