<?php

class block_additionalechoalp_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Link name
        $mform->addElement('text', 'config_text', get_string('link_name', 'block_additionalechoalp'));
        $mform->setDefault('config_text', 'Echo 360 videos');
        $mform->setType('config_text', PARAM_TEXT);

        // Explanatory text
        $mform->addElement('text', 'config_explanation', get_string('explanation', 'block_additionalechoalp'));
        $mform->setDefault('config_explanation', '');
        $mform->setType('config_explanation', PARAM_TEXT);

    }
}
