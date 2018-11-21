<?php

// disable saving singleton form data
$app->on('singleton.saveData.before', function($singleton, &$data) {

    if ($this->module('cockpit')->getGroup() != 'admin') {
        $this->stop(['error' => 'changing data is not allowed for visitors'], 412);
    }

});
/* 
// disable changing the config form configuration
$app->on('admin.init', function() {

    if ($this->module('cockpit')->getGroup() != 'admin') {

        $this->bind('/cockpit/call/forms/saveForm', function() {

            $this->stop(['error' => 'changing data is not allowed for visitors'], 412);

        });
    }
    
    // to do: file issue for forms acls

});
 */
 
/*
  restrict the output of some helper functions
*/

// restrict built-in helper functions
$app->on('admin.init', function() {
    
    // deny request for `find` and `_find`
    $this->bind('/collections/find', function(){
        
        $collection = $this->param('collection');
        
        if (!$this->module('collections')->hasaccess($collection, 'entries_view')) {
            return $this->helper('admin')->denyRequest();
        } else {
            return $this->invoke('Collections\\Controller\\Admin', 'find');
        }
        
    });
    
    // deny request for `tree`
    $this->bind('/collections/tree', function(){
        
        $collection = $this->param('collection');
        
        if (!$this->module('collections')->hasaccess($collection, 'entries_view')) {
            return $this->helper('admin')->denyRequest();
        } else {
            return $this->invoke('Collections\\Controller\\Admin', 'tree');
        }
        
    });
    
    // don't list collections schema of restricted collections
    $this->bind('/collections/_collections', function(){
        
        return $this->module('collections')->getCollectionsInGroup(null, false);
        
    });
    
    // disable user lists for non-admins,
    // non-admins must send a user id to receive the user name
    $this->bind('/accounts/find', function(){

        if ($this->module('cockpit')->isSuperAdmin()) {

            return $this->invoke('Cockpit\\Controller\\Accounts', 'find');

        } else {
          
            // deny request to list all users
            $options = $this->param('options', []);
            if (!isset($options['filter']['_id'])) {
                return $this->helper('admin')->denyRequest();
            }
            
            $out = [];
            $accounts = $this->invoke('Cockpit\\Controller\\Accounts', 'find');
            
            $i = 0;
            foreach ($accounts['accounts'] as $key => $account) {
                $out['accounts'][$i]['user'] = $account['user'] ?? '';
                $out['accounts'][$i]['name'] = $account['name'] ?? '';
                $out['accounts'][$i++]['_id'] = $account['_id'] ?? '';
            }
            
            $out['count'] = $accounts['count'];
            $out['pages'] = $accounts['pages'];
            $out['page'] = $accounts['page'];
            
            return $out;

        }

    });
    
});
