<?php

 require 'twitteroauth/twitteroauth.php';

$consumer_key = 'PRZ0ShT97JgTPou4JxUwQ7EBf';
$consumer_secret = '2poKPXtZucAmNTcBvR0eBMdD6Bf4fUWY1rr2CtGl6nniKRL6QF';
$access_token = '926481023797514241-QCJTRMJvaMCg4O0AcRuAvEydWjAkIuB';
$access_token_secret = 'yac2zrIYr0YP5PgVRtbl6MqbQcLDknCACqY49M2XsBblZ';

$twitter = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

$count = 20;

$tweets = $twitter->get('https://api.twitter.com/1.1/users/show.json?screen_name='.$tuser);

print_r($tweets);


?>