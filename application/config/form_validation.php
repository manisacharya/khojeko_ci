<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 9/24/16
 * Time: 12:08 AM
 */
/*
|--------------------------------------------------------------------------
| Error delimiters
|--------------------------------------------------------------------------
|
| For validation error
|
| $config['error_prefix'] = '<div class="alert alert-danger">';
| $config['error_suffix'] = '</div>';
*/

// Setting up rules and error message for form validation
$config = array(
    /*
     * users   : class
     * sign_up  : method
     *
     */
    'users/sign_up' => array(
        array(
            'field'     => 'username',
            'label'     => 'Username',
            'rules'     => 'trim|required|alpha_dash|min_length[5]|max_length[50]|is_unique[user.khojeko_username]',
            'errors'    => array(
                'required'      => 'You must provide a {field}.',
                'min_length'    => '{field} must contain minimum {param} characters.',
                'max_length'    => '{field} should be of maximum {param} characters.',
                'is_unique'     => 'This {field} already taken. Choose another one.'
            )
        ),
        array(
            'field'     => 'password',
            'label'     => 'Password',
            'rules'     => 'required|min_length[6]',
            'errors'    => array(
                'required'      => 'You must provide a {field}.',
                'min_length'    => '{field} must contain minimum {param} characters.'
            )
        ),
        array(
            'field'     => 'pass_confirm',
            'label'     => 'Password Confirmation',
            'rules'     => 'required|matches[password]',
            'errors'    => array(
                'matches'   => 'Password not matched'
            )
        ),
        array(
            'field'     => 'email',
            'label'     => 'Email',
            'rules'     => 'trim|required|valid_email|is_unique[user.email]',
            'errors'    => array(
                'is_unique' => 'Email already taken.'
            )
        ),
        array(
            'field'     => 'admin_name',
            'label'     => 'Full Name',
            'rules'     => 'trim|required',
        ),
        array(
            'field'     => 'mob',
            'label'     => 'Mobile',
            'rules'     => 'trim|required',
        ),
        array(
            'field'     => 'address',
            'label'     => 'Address',
            'rules'     => 'trim|required',
        )
    )
);