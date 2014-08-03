<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Finder - Problem 2</title>
	</head>
	<body>
		<form action="" method="post">
			<?php $screen_name = (isset($_POST['screen_name']) && !empty($_POST['screen_name'])) ? $_POST['screen_name'] : ''; ?>
			<input type="text" name="screen_name" value="<?php echo $screen_name; ?>">
			<input type="submit" value="Get Tweets!">
		</form>
		<div>
			<?php
			/**
			 * I have used the class provided by J7mbo @ https://github.com/J7mbo/twitter-api-php
			 */
			if(empty($screen_name)) {
				exit;
			}
			
			if(!preg_match('/^[A-Za-z0-9_]{1,15}$/', $screen_name)) {
				echo '<hr>Not a valid Twitter user!';
				exit;
			}
			
			ini_set('display_errors', 1);
			require_once('TwitterAPIExchange.php');
			
			/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
			$settings = array(
			    'oauth_access_token' => "158290189-0cuXeH7x9oS9qMrJResus0Mthsz0cC3OlX0IPdJg",
			    'oauth_access_token_secret' => "8AGxt6NZAQT7qulHBr6nI5ut0ogd8lngMBDWIvLyZTNbt",
			    'consumer_key' => "ZgyxyEzZt7XRTJEVSsI411adV",
			    'consumer_secret' => "3j9fO5Ypc3jJoGNhKbslJfM14HtldzwTrtKzPHzt6BVUCiZbGE"
			);
			
			/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
			$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
			$requestMethod = 'GET';
			
			/** Perform a POST request and echo the response **/
			$twitter = new TwitterAPIExchange($settings);
			$tweets = $twitter->setGetfield("?count=5&include_rts=1&screen_name=".$screen_name)
						 ->buildOauth($url, $requestMethod)
			             ->performRequest();
			$tweets = json_decode($tweets, true);
			if(is_array($tweets)) {
				echo '<hr><span style="text-decoration: underline;">Latest 5 tweets of <strong><i>@'.$screen_name.'</i></strong>:</span><br>';
				foreach ($tweets as $tweet) {
					echo $tweet['text'].'<br>';
				}
			}
			
			$url = 'https://api.twitter.com/1.1/users/show.json';
			$getfield = '?screen_name='.$screen_name;
			$requestMethod = 'GET';
			$twitter = new TwitterAPIExchange($settings);
			$show =  $twitter->setGetfield($getfield)
							 ->buildOauth($url, $requestMethod)
							 ->performRequest();
			
			$show = json_decode($show, true);
			echo '<hr>';
			echo 'TWEETS: ' . $show['statuses_count'] . '<br>';
			echo 'FOLLOWING: '. $show['friends_count'] . '<br>';
			echo 'FOLLOWERS: '. $show['followers_count'] . '<br>';
			?>
		</div>
	</body>
</html>