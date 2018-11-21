<?php
 return array (
  '_id' => 'contact5bef180618cbd',
  'name' => 'contact',
  'label' => 'Contact Form',
  'save_entry' => true,
  'in_menu' => true,
  'email_forward' => '',
  '_created' => 1542395910,
  '_modified' => 1542742653,
  'validate' => true,
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'name',
      'label' => 'Name',
      'type' => 'text',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
        'validate' => 
        array (
          'type' => 
          array (
            'url' => false,
            'mail' => false,
          ),
        ),
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => true,
      'validate' => true,
    ),
    1 => 
    array (
      'name' => 'phone',
      'label' => 'Telephone',
      'type' => 'text',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
        'validate' => 
        array (
          'type' => 
          array (
            'url' => false,
            'phone' => true,
            'mail' => false,
          ),
        ),
      ),
      'width' => '1-2',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => false,
      'validate' => true,
    ),
    2 => 
    array (
      'name' => 'mail',
      'label' => 'Mail Address',
      'type' => 'text',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
        'validate' => 
        array (
          'type' => 
          array (
            'url' => false,
            'mail' => true,
          ),
        ),
      ),
      'width' => '1-2',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => true,
      'validate' => true,
    ),
    3 => 
    array (
      'name' => 'subject',
      'label' => 'Subject',
      'type' => 'text',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => true,
    ),
    4 => 
    array (
      'name' => 'message',
      'label' => 'Message',
      'type' => 'textarea',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => true,
    ),
    5 => 
    array (
      'name' => 'confirm_terms_and_conditions',
      'label' => 'I read the privacy notice',
      'type' => 'boolean',
      'default' => '',
      'info' => 'When using the contact form, some data will be collected and stored - see also <a href="{{route}}/privacy">privacy notice</a>.',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
        'attr' => 
        array (
          'value' => 'yes',
        ),
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => true,
      'validate' => false,
    ),
    6 => 
    array (
      'name' => 'confirm',
      'label' => 'Honeypot',
      'type' => 'boolean',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
        'attr' => 
        array (
          'value' => '1',
          'style' => 'display:none !important',
          'tabindex' => '-1',
          'autocomplete' => 'off',
        ),
        'validate' => 
        array (
          'honeypot' => 
          array (
            'fieldname' => 'confirm',
            'expected_value' => '0',
            'response' => 'test honeypot',
          ),
        ),
      ),
      'width' => '1-1',
      'lst' => false,
      'acl' => 
      array (
      ),
      'validate' => true,
    ),
  ),
  'allow_extra_fields' => false,
  'email_subject' => '[{{app.name}}] {{name}}: {{subject}}',
  'reply_to' => 'mail',
  'description' => 'Monoplane auto-generates the contact form from the defined fields. The "confirm" field is a honeypot to trick spambots.',
  'icon' => 'email.svg',
);