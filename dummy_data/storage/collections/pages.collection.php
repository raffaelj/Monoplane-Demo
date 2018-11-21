<?php
 return array (
  'name' => 'pages',
  'label' => 'Pages',
  '_id' => 'pages5bed48080af30',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'title',
      'label' => 'Title',
      'type' => 'text',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
      ),
      'width' => '3-4',
      'lst' => true,
      'acl' => 
      array (
      ),
      'required' => true,
    ),
    1 => 
    array (
      'name' => 'published',
      'label' => 'Published',
      'type' => 'boolean',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => false,
      'options' => 
      array (
      ),
      'width' => '1-4',
      'lst' => true,
      'acl' => 
      array (
      ),
    ),
    2 => 
    array (
      'name' => 'content',
      'label' => 'Content',
      'type' => 'markdown',
      'default' => '',
      'info' => '',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
    ),
    3 => 
    array (
      'name' => 'image',
      'label' => 'Featured Image',
      'type' => 'asset',
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
    ),
    4 => 
    array (
      'name' => 'navigation',
      'label' => 'Navigation Menu',
      'type' => 'select',
      'default' => '',
      'info' => '',
      'group' => 'config',
      'localize' => false,
      'options' => 
      array (
        'options' => 
        array (
          'none' => '',
          'main' => 'Main',
          'secondary' => 'Secondary',
        ),
      ),
      'width' => '1-3',
      'lst' => true,
      'acl' => 
      array (
      ),
    ),
    5 => 
    array (
      'name' => 'contactform',
      'label' => 'Contact Form',
      'type' => 'boolean',
      'default' => '',
      'info' => 'Add a contact form to the page. It will appear below the text.',
      'group' => 'config',
      'localize' => false,
      'options' => 
      array (
      ),
      'width' => '1-3',
      'lst' => true,
      'acl' => 
      array (
      ),
    ),
    6 => 
    array (
      'name' => 'slug',
      'label' => '',
      'type' => 'text',
      'default' => '',
      'info' => '',
      'group' => 'config',
      'localize' => false,
      'options' => 
      array (
      ),
      'width' => '1-3',
      'lst' => true,
      'acl' => 
      array (
      ),
    ),
  ),
  'sortable' => false,
  'in_menu' => true,
  '_created' => 1542277128,
  '_modified' => 1542737692,
  'color' => '#A0D468',
  'acl' => 
  array (
    'visitor' => 
    array (
      'entries_view' => true,
    ),
  ),
  'rules' => 
  array (
    'create' => 
    array (
      'enabled' => false,
    ),
    'read' => 
    array (
      'enabled' => false,
    ),
    'update' => 
    array (
      'enabled' => false,
    ),
    'delete' => 
    array (
      'enabled' => false,
    ),
  ),
  'description' => 'Entries of this collection are rendered by monoplane as pages.',
  'icon' => 'adressbook.svg',
);