<?php
	include_once('../include_files.php');
	$userInfo = getUserInfoFromSession();

	require_once('preheader.php');

	#the code for the class
	include ('ajaxCRUD.class.php');

    #this one line of code is how you implement the class
    ########################################################
    ##

    $tblDemo = new ajaxCRUD("Item", TABLE_PREFIX."sms", "sms_id", "");

    ##
    ########################################################

    ## all that follows is setup configuration for your fields....
    ## full API reference material for all functions can be found here - http://ajaxcrud.com/api/
    ## note: many functions below are commented out (with //). note which ones are and which are not

    #i can define a relationship to another table
    #the 1st field is the fk in the table, the 2nd is the second table, the 3rd is the pk in the second table, the 4th is field i want to retrieve as the dropdown value
    #http://ajaxcrud.com/api/index.php?id=defineRelationship
    //$tblDemo->defineRelationship("fkOtherTableID", "tblOtherTable", "pkOtherTableID", "fldName");

    #i don't want to visually show the primary key in the table
    $tblDemo->omitPrimaryKey();

    #the table fields have prefixes; i want to give the heading titles something more meaningful
    $tblDemo->displayAs("receiver_number", "Sent To");
    $tblDemo->displayAs("date_created", "Date");

	#set the textarea height of the longer field (for editing/adding)
    #http://ajaxcrud.com/api/index.php?id=setTextareaHeight
    $tblDemo->setTextareaHeight('message', 200);

    #i could omit a field if I wanted
    #http://ajaxcrud.com/api/index.php?id=omitField
   $tblDemo->omitField("sms_id");
   $tblDemo->omitField("fb_id");
   $tblDemo->omitField("carrier_name");
   $tblDemo->omitField("carrier_number");
   $tblDemo->omitField("ip_address");
   $tblDemo->omitField("date_modifed");
   $tblDemo->omitField("is_delivered");
   //$tblDemo->omitField("message");



    #i could omit a field from being on the add form if I wanted
   $tblDemo->omitAddField("sms_id");
   $tblDemo->omitAddField("fb_id");
   $tblDemo->omitAddField("carrier_name");
   $tblDemo->omitAddField("carrier_number");
   //$tblDemo->omitAddField("date_created");
   $tblDemo->omitAddField("date_modifed");
   $tblDemo->omitAddField("is_delivered");
   //$tblDemo->omitAddField("message");


    #i could disallow editing for certain, individual fields
    $tblDemo->disallowEdit('message');
    $tblDemo->disallowEdit('receiver_number');
    $tblDemo->disallowEdit('date_created');

    #i could set a field to accept file uploads (the filename is stored) if wanted
    //$tblDemo->setFileUpload("fldField2", "uploads/");

    #i can have a field automatically populate with a certain value (eg the current timestamp)
    //$tblDemo->addValueOnInsert("date_created", "NOW()");
    //$tblDemo->addValueOnInsert("date_modifed", "NOW()");
    //$tblDemo->addValueOnInsert("fb_id", "1");

    #i can use a where field to better-filter my table
    $tblDemo->addWhereClause("WHERE fb_id = {$userInfo['id']}");

    #i can order my table by whatever i want
    $tblDemo->addOrderBy("ORDER BY date_created desc");

    #i can set certain fields to only allow certain values
    #http://ajaxcrud.com/api/index.php?id=defineAllowableValues
    //$allowableValues = array("Allowable Value 1", "Allowable Value2", "Dropdown Value", "CRUD");
    //$tblDemo->defineAllowableValues("fldCertainFields", $allowableValues);

    #i can disallow deleting of rows from the table
    #http://ajaxcrud.com/api/index.php?id=disallowDelete
    $tblDemo->disallowDelete();

    #i can disallow adding rows to the table
    #http://ajaxcrud.com/api/index.php?id=disallowAdd
    $tblDemo->disallowAdd();

    #i can add a button that performs some action deleting of rows for the entire table
    #http://ajaxcrud.com/api/index.php?id=addButtonToRow
    //$tblDemo->addButtonToRow("Add", "add_item.php", "all");

    #set the number of rows to display (per page)
    $tblDemo->setLimit(5);

	#set a filter box at the top of the table
    $tblDemo->addAjaxFilterBox('receiver_number');
    $tblDemo->addAjaxFilterBox('date_created');

    #if really desired, a filter box can be used for all fields
    //$tblDemo->addAjaxFilterBoxAllFields();

    #i can set the size of the filter box
    //$tblDemo->setAjaxFilterBoxSize('fldField1', 3);

	#i can format the data in cells however I want with formatFieldWithFunction
	#this is arguably one of the most important (visual) functions
	$tblDemo->formatFieldWithFunction('receiver_number', 'makeBlue');
	$tblDemo->formatFieldWithFunction('date_created', 'makeBold');

	#actually show the table
	$tblDemo->showTable();

	#my self-defined functions used for formatFieldWithFunction
	function makeBold($val){
		return "<b>$val</b>";
	}

	function makeBlue($val){
		return "$val";
	}
?>
