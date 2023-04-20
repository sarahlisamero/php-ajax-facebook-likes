<?php
	
	include_once("bootstrap.php");
	$posts = Post::getAll();



?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Become a fan</title>
	<style>
	body{background-color: #e9eaed;font-family: Helvetica, Arial, 'lucida grande',tahoma,verdana,arial,sans-serif;}
	article{background-color: #fff;font-size: 15px; padding: 0.5em;width: 300px; margin-bottom: 1em;}
	article div{color: #3b5998;}
	</style>
</head>
<body>
	
	<a href="#" data-location="Mechelen" data-campus="Ham"></a>

	<?php foreach($posts as $post): ?>
	<article>
		<p><?php echo $post->text; ?></p>
		<img src="https://picsum.photos/300/200?random=<?php echo rand(1, 10000); ?>" alt="">
		<div><a href="#" data-id="<?php echo $post->id; ?>" class="like">Like</a> <span class='likes' id="likes<?php echo $post->id;?>"><?php echo $post->getLikes(); ?></span> people like this </div>
	</article>
	<?php endforeach; ?>
		<script>
			//add event click on all links with class .like
			let links = document.querySelectorAll(".like");
			for (let i = 0; i < links.length; i++) {
				links[i].addEventListener("click", function(e){
					e.preventDefault();
					//console.log("like clicked");
					//get the id of the post
					let id = this.getAttribute("data-id");

					//get the span with the id likes{id}
					let likes = document.querySelector("#likes"+id);
					//console.log(id);

					//fetch (POST) to ajax/like.php, use formdata
					let formData = new FormData();
					formData.append("id", id);
					fetch("ajax/like.php", {
						method: "POST",
						body: formData
					})
					.then(function(response){
						return response.json();
					})
					.then(function(json){
						console.log(json); /*like requests checken in network tab in devtools: 
						1) network leegmaken liken knop indrukken 
						2) 200 & groen betekent aangekomen
						3) dan klikken op de request & bij het response tabje kijken -> warning ofzo? er is iets mis*/
						//update the likes
						span.innerhtml = json.likes;
					})

				});
			}
		</script>



</body>
</html>