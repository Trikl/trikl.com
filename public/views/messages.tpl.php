						<?php 
						$params = explode( "/", $_GET['p'] );
						$subpage = $params['1'];
							$messages = $data['list'];

						if ($subpage) {
							if ($data['contents']) {
							$msgcontent = $data['contents'];
							foreach ($messages as $message) {
								if ($message['thread']->getMessageID() == $subpage)
								echo "<h1 style='text-align:center;'>" . $message['thread']->getSubject() . "</h1>";
							}
							echo "<div class='messages'>";

							foreach ($msgcontent as $content) {
									$date = $content['msgcontents']->getDate();
									$msg = $content['msgcontents']->getContent();
									foreach ($content['usrinfo'] as $user) {
									$usravatar = $user->getAvatarFilename();
									$usrusername = $user->getUsername();
									$usrname = $user->getFirstName() . " " . $user->getLastName();
									}

									include 'individualmsg.tpl.php';


						}    
						
							echo "</div>";
						?>

						<form id="replymessage" action="#" method="post">
							Reply: <textarea id="messagecontents" class="posttextarea" name="content"></textarea>
							<input type="submit" />
						</form>	
						
						<?php } else { echo "Ah ah ah, you didn't say the magic word!"; }} else { ?>

						<form id="sendmessage" action="/messages" method="post">
							to:<input type=text name="to" />
							subject:<input type=text name="subject" />
							contents: <textarea id="messagecontents" class="posttextarea" name="content"></textarea>
							<input type="submit" />
						</form>	
						
						<hr />
												<div style="width:200px;">

						<?php 
						
							foreach ($messages as $message) {
								echo "<div class='message'>";
								echo "<a href='/messages/" . $message['thread']->getMessageID() . "'>";
								echo $message['thread']->getDate() . " ";
								echo $message['thread']->getSubject();
								echo "</a><br /><br />";
								foreach ($message as $userinfos) {
									foreach ($userinfos as $userinfo) {
										echo "<img height=40 width=40 src='/public/avatars/" . $userinfo->getAvatarFilename() . "' />";
									}
								}
								echo "<br /><br />";
								echo "</div>";
							}
						
						}
						?>
						
						<script>
							var messages = {
								resetForm: true,
								clearForm: true,
								data: {
									"action": "createmessage",
								},
								success: function(response) {
									alert(response);
								}
							};
							$('#sendmessage').ajaxForm(messages);
							
							var reply = {
								resetForm: true,
								clearForm: true,
								data: {
									"action": "replymessage",
								},
								success: function(response) {
									alert(response);
								}
							};
							$('#replymessage').ajaxForm(reply);

						</script>
												</div>

