<?php
	//Do not modify this file. unless it is really required. 
?>
<script>
function makeAsynchronusCall(url)
{
	var oRequest = new XMLHttpRequest();
	oRequest.open("GET",url,false);
	oRequest.setRequestHeader("User-Agent",navigator.userAgent);
	oRequest.send();
	if(oRequest.status==200)
	{
		//alert("Thanks!");
	}
	else
	{
		//alert("Connection Error. Please try again!");
	}
}
</script>
