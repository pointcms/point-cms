<?php

return [

    'extend' => 'Extend',

    'variables'      => 'Site Variables',
    'variables_desc' => 'Create additional metadata',

    'create_variable'  => 'Add variable',
    'editing_variable' => 'Edit variable',
    'novars_desc'      => 'No variables yet',

    // custom vars
    'name'                           => 'Name',
    'name_explain'                   => 'A unique name',
    'name_missing'                   => 'Please enter a unique name',
    'name_exists'                    => 'Name is already in use',

    'value'             => 'Value',
    'value_explain'     => 'The data you want to store (up to 64kb)',
    'value_code_snipet' => 'Snippet to insert into your template.<br>
	<div class="input-group mb-3">
    <input type="text" class="form-control" type="text" value="' . e('<?php echo site_meta(\'%s\'); ?>') . '" id="code"><button class="btn btn-outline-secondary" type="button" onclick="myFunction()">copy</button>
    </div>',

    // messages
    'variable_created'  => 'Your variable was created',
    'variable_updated'  => 'Your variable was updated',
    'variable_deleted'  => 'Your variable was deleted',

];
