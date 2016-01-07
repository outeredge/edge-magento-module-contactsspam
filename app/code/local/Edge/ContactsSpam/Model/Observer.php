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

            $div = $dom->createElement('div');
            $div->setAttribute('class', 'field contact-first-name');

            $label = $dom->createElement('label');
            $label->setAttribute('for', 'first-name');
            $label->setAttribute('class', 'required');

            $em  = $dom->createElement('em');
            $txt = $dom->createTextNode("*");
            $text = $dom->createTextNode("First Name");

            $divInput = $dom->createElement('div');
            $divInput->setAttribute('class', 'input-box');

            $input = $dom->createElement('input');
            $input->setAttribute('name', 'first_name');
            $input->setAttribute('id', 'first-name');
            $input->setAttribute('title', 'First-Name');
            $input->setAttribute('value', '');
            $input->setAttribute('class', 'input-text');
            $input->setAttribute('type', 'text');

            $label->appendChild($em);
            $em->appendChild($txt);
            $label->appendChild($text);

            $div->appendChild($label);
            $div->appendChild($divInput);
            $divInput->appendChild($input);

            $xpath = new DOMXPath($dom);
            $fields = $xpath->query("//*[@class='fields']");

            $form = $fields->item(0);
            $form->appendChild($div);

            $transport->setHtml($dom->saveHTML());
        }

        return $this;
    }

}
