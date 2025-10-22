<?php
include '..\_src\testpage.php';
include '..\_src\request.php';
include '..\_src\data.php';
include '..\_src\menu.php';
include '..\_src\form_v5.php';

openTestPage('FORMTEST 7','','Eigen (complexe) velden toevoegen');
showMenu(getMenuItems());
$request = getRequest();

$fields = getExtendedFieldsByPageV3($request['page']);


if ($request['posted'])
{
    include '..\_src\validate_v2.php';
    $post_result = checkFields($fields);
    
    if ($post_result['ok'])
    {	
        dump('Gevalideerd PostResult van ['.$request['page'].'] voor verdere verwerking', $post_result);
    }
    else
    {
        showForm(
            action : 'index.php', 
            page   : $request['page'],   
            method : 'POST', 
            fields : $fields, 
            submit_caption : 'Send',
            post_result : $post_result
        );
    }		
}		
else
{
    showForm(
        page   : $request['page'],   
        action : 'index.php', 
        method : 'POST', 
        fields : $fields, 
        submit_caption : 'Send'
    );
}   

closeTestPage('');




