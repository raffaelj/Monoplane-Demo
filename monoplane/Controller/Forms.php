<?php

namespace Monoplane\Controller;

class Forms extends Monoplane {

    public $message = [
        'success' => 'Thank you for the message<br>I will answer soon.',
        'notice' => 'Fill in all mandatory fields.',
        'submit' => 'Send'
    ];

    public function __construct($cockpit){

        $cockpit->monoplane['contactform'] = $cockpit->monoplane['contactform'] ?? null;

        parent::__construct($cockpit);

    }

    protected function before() {

        // expire form data after 1 minute(s)
        $expire = $this->monoplane['contactform']['session_expire'] ?? 60;
        if (isset($_SESSION['call']) && time() - $_SESSION['call'] > $expire) {
            unset($_SESSION['response']);
            unset($_SESSION['call']);
        }

    }

    // public function index() {
        // index function must exist or LimeExtra howls
    // }

    public function form($name = '') {

        $fields = $this->app->module('forms')->form($name)['fields'];

        if (!$fields) {
            return 'Form fields are not defined. Use the FormValidation addon to specify them.';
        }

        $response = $_SESSION['response'] ?? [];

        return $this->render('views:partials/contactform.php', compact('fields', 'response'));

    }

    public function submit($form = '') {

        // evil user input
        $postedData = [];
        foreach($this->app->param() as $key => $val) {
            if ($key != 'submit')
                $postedData[$key] = htmlspecialchars(trim($val));
        }

        // catch response stop from FormValidation addon
        try {
            $response = $this->module('forms')->submit($form, $postedData);
        } catch (\Exception $e) {
            $response = json_decode($e->getMessage(), true);
        }

        if (!isset($response['error'])) {

            unset($_SESSION['call']);
            unset($_SESSION['response']);

            $this->reroute($this->app->monoplane['contactform']['route'] . '?success=1' . $this->app->monoplane['contactform']['anchor']);

        } else {

            $_SESSION['call'] = time();
            $_SESSION['response'] = $response;

            $path = $this->routeUrl($this->app->monoplane['contactform']['route']) . '?notice=1' . $this->app->monoplane['contactform']['anchor'];
            header('Location: '.$path);
            $this->stop(303);

        }

    }

    public function renderField($field, $response = []) {

        $fieldContent = '';
        $attr = [];
        $fld = '';
        $input = 'input';

        $fieldContent = $response['data'][$field['name']] ?? '';

        switch($field['type']){
            case 'boolean':
                $attr['type'] = 'checkbox';
                if(in_array($fieldContent, [1, 'on', 'yes', 'ja']))
                    $attr['checked'] = 'checked';
                break;
            case 'textarea':
                $input = 'textarea';
                break;
            default:
                $attr['type'] = 'text';
                $attr['value'] = $fieldContent;
        }

        $attr['name'] = $attr['id'] = $field['name'];

        if(isset($field['required']) && $field['required'])
        $attr['required'] = 'required';

        // add defined attributes from form builder
        if(isset($field['options']['attr']))
            foreach($field['options']['attr'] as $key => $val)
                $attr[$key] = $val;

        $fld .= "<$input";

        // add attributes to string
        foreach($attr as $key => $val) {
            $fld .= ' '.$key.'="'.$val.'"';
        }
            

        if($input == "textarea")
            $fld .= ">$fieldContent</textarea>";
        else
            $fld .= " />";

        // label
        if (isset($field['options']['validate']['honeypot']) && $field['options']['validate']['honeypot']['fieldname'] == $field['name']){
            $label = ''; // no label for honypot
        } else {

            $label_attr = [];
            $label = "<label";

            $label_attr['for'] = $field['name'];

            // if(isset($field['info']) && !empty($field['info']))
                // $label_attr['title'] = $field['info'];

            // add attributes to string
            foreach($label_attr as $key => $val) {
                $label .= ' '.$key.'="'.$val.'"';
            }

            // $label .= ">" . $field['label'] . "</label>";
            $label .= ">" . $this('i18n')->get($field['label']) . "</label>";

        }

        // errors
        $error = false;

        if (isset($response['error'][$field['name']])) {

            $error = $response['error'][$field['name']];
            $error = is_string($error) ? $error : implode('<br>', $error);

        }

        // field info
        $info = false;
        if (!empty($field['info'])) {
            // translate info before route replacement
            $info = $this('i18n')->get($field['info']);
            $info = str_replace('{{route}}', BASE_URL, $info);
        }

        // field output
        echo '<div class="width-' . $field['width'] . '">' . "\r\n";
        echo $fld . $label . "\r\n";

        if($error)
            echo '<p class="message error">' . $error . '</p>' . "\r\n";

        if($info)
            echo '<p class="info">' . $info . '</p>' . "\r\n";

        echo '</div>' . "\r\n";

    }

    public function seriousError($fields, $response) {

        // display errors from validator or from Mailer Exceptions (coming soon)

        if (!isset($response['error'])) return false;

        $error = [];
        $fieldnames = array_column($fields, 'name');

        foreach ($response['error'] as $key => $val) {
            if (!in_array($key, $fieldnames)) {
                $error[$key] = $val;
            } 
        }
        if (empty($error)) return false;

        $out = '';
        foreach ($error as $key => $val) {
            $out .= "<strong>$key: </strong><br>";
            $out .= is_string($val) ? $val : implode('<br>', $val);
        }

        return $out;

    }

}
