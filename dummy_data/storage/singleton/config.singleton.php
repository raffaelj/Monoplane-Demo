<?php
 return array (
  'name' => 'config',
  'label' => 'Site Config',
  '_id' => 'config5bedb8c98d76f',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'site_name',
      'label' => 'Site Name',
      'type' => 'text',
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
      'required' => true,
    ),
    1 => 
    array (
      'name' => 'slogan',
      'label' => 'Slogan',
      'type' => 'text',
      'default' => '',
      'info' => 'optional',
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
    2 => 
    array (
      'name' => 'logo',
      'label' => 'Logo',
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
    3 => 
    array (
      'name' => 'site_description',
      'label' => 'Short Description',
      'type' => 'textarea',
      'default' => '',
      'info' => 'for SEO',
      'group' => '',
      'localize' => true,
      'options' => 
      array (
        'rows' => 3,
      ),
      'width' => '1-1',
      'lst' => true,
      'acl' => 
      array (
      ),
    ),
  ),
  'template' => '',
  'data' => NULL,
  '_created' => 1542305993,
  '_modified' => 1542738328,
  'description' => 'Monoplane loads the content for site title and logo etc.',
  'acl' => 
  array (
    'visitor' => 
    array (
      'form' => true,
      'data' => false,
      'edit' => false,
    ),
  ),
  'in_menu' => true,
  'icon' => 'settings.svg',
);