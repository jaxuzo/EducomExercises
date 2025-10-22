<?php
function getFieldsByPage(string $page) : array
{
    switch ($page)
    {
        case 'login':
            return [
                'email'		=> 'email',
                'password'	=> 'password'
            ];
        case 'register':
            return [
                'name' 		=> 'text',
                'email' 	=> 'email',
                'password' 	=> 'password',
                'repeatpassword'=> 'password'
            ];
        case 'contact':
        default: 
            return [
                'name' 		=> 'text',
                'email' 	=> 'email',
                'message' 	=> 'textarea'
            ];
    }
}	

function getMenuItems() : array
{
    return [
        'contact' => 'Contact me!',
        'login'	  => 'Login',
        'register'=> 'Register'		
    ];
}

/* Met extra veld info */
function getExtendedFieldsByPage(string $page) : array
{
    switch ($page)
    {
        case 'login':
            return [
                'email'		=> ['type' => 'email',   'label'=>'Your Email'],
                'password'	=> ['type' => 'password','label'=>'Your password'],
            ];
        case 'register':
            return [
                'name' 		=> ['type' => 'text',    'label'=>'Your name'],
                'email' 	=> ['type' => 'email',   'label'=>'Your Email'],
                'password' 	=> ['type' => 'password','label'=>'Your password'],
                'repeatpassword'=> ['type' => 'password','label'=>'Repeat password'],
            ];
        case 'contact':
        default: 
            return [
                'name' 		=> ['type' => 'text',    'label'=>'Your name'],
                'email' 	=> ['type' => 'email',   'label'=>'Your Email'],
                'message' 	=> ['type' => 'textarea','label'=>'Message'],
            ];
    }
}	

/* Met extra validatie info */
function getExtendedFieldsByPageV2(string $page) : array
{
    switch ($page)
    {
        case 'login':
            return [
                'email'		=> [
                    'type' => 'email',   
                    'label'=> 'Your Email',
                    'filter'    => FILTER_VALIDATE_EMAIL
                ],
                'password'	=> [
                    'type' => 'password',
                    'label'=> 'Your password'
                ],
            ];
        case 'register':
            return [
                'name' 		=> [
                    'type' => 'text',    
                    'label'=> 'Your name'
                ],
                'email' 	=> [
                    'type'      => 'email',   
                    'label'     => 'Your Email',
                    'filter'    => FILTER_VALIDATE_EMAIL
                ],
                'password' 	=> [
                    'type' => 'password',
                    'label'=> 'Your password'
                ],
                'repeatpassword'=> [
                    'type' => 'password',
                    'label'=> 'Repeat password'
                ],
            ];
        case 'contact':
        default: 
            return [
                'name' 		=> [
                    'type' => 'text',    
                    'label'=> 'Your name'
                ],
                'email' 	=> [
                    'type'      => 'email',   
                    'label'     => 'Your Email',
                    'filter'    => FILTER_VALIDATE_EMAIL
                ],
                'message' 	=> [
                    'type' => 'textarea',
                    'label'=> 'Message'
                ],
            ];
    }
}    
    
/* Met complexe veld info */
function getExtendedFieldsByPageV3(string $page) : array
{
    switch ($page)
    {
        case 'login':
            return [
                'email'		=> [
                    'type' => 'email',   
                    'label'=> 'Your Email',
                    'filter'    => FILTER_VALIDATE_EMAIL
                ],
                'password'	=> [
                    'type' => 'password',
                    'label'=> 'Your password'
                ],
                'rememberme'	=> [
                    'type' => 'checkbox',
                    'label'=> 'Remember me'
                ],
            ];
        case 'register':
            return [
                'name' 		=> [
                    'type' => 'text',    
                    'label'=> 'Your name'
                ],
                'email' 	=> [
                    'type'      => 'email',   
                    'label'     => 'Your Email',
                    'filter'    => FILTER_VALIDATE_EMAIL
                ],
                'newpassword' 	=> [
                    'type' => 'newpassword',
                    'label'=> 'Your password'
                ]
            ];
        case 'contact':
        default: 
            return [
                'name' 		=> [
                    'type' => 'text',    
                    'label'=> 'Your name'
                ],
                'email' 	=> [
                    'type'      => 'email',   
                    'label'     => 'Your Email',
                    'filter'    => FILTER_VALIDATE_EMAIL
                ],
                'message' 	=> [
                    'type' => 'textarea',
                    'label'=> 'Message'
                ],
                'contactme' 	=> [
                    'type' => 'radiogroup',
                    'label'=> 'Contact me ',
                    'options'=> [
                        'mail'    => 'email',
                        'phone'   => 'phone',
                        'pidgeon' => 'bird'
                    ]
                ],
            ];
     }
}	
