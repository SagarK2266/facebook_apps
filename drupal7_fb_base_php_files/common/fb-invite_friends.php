<?php
			/***********Lib File***********/
/* Note: Do not modify this file for the application specific requirements */

?>
<script type="text/javascript">
 FB.init({
        appId  : '<?php echo FacebookConfiguration::APP_ID ?>',
        frictionlessRequests : true
      });
          function sendRequestViaMultiFriendSelector(friendsId) {
        FB.ui({method: 'apprequests',
          message: '<?php echo APP_REQUEST_MESSAGE ?>',
          to: friendsId,
        }, requestCallback);
      }

      function requestCallback(response) {
        // Handle callback here
      }
</script>
<?php
	$allFriendsId = getCommaSeperatedFriendsId();
	//printFormattedArray($allFriendsId); exit;
	?>
	<div id="invite_friends" >
			<a OnClick="sendRequestViaMultiFriendSelector(<?php echo "'".$allFriendsId."'"; ?>)" href="#" class="FB_Links">Invite Friends </a>
	</div>
<?php
function getCommaSeperatedFriendsId()
{
	$allFriendsIdArray = array();
	$friendsData = getFriendsDataFromSession();
	$noOfFriends = SHOW_TOTAL_FRIENDS_IN_INVITE_FRIENDS_DIALOG;
	if(is_array($friendsData))
	{
		$filteredFriendIdArray = array_rand($friendsData, $noOfFriends+1);
		$allFriendsId = implode(",", $filteredFriendIdArray);
		return $allFriendsId;
	}
	else
	{
		return;
	}

}
