<div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
          </div>
		  <?php
		  try{
				$pdo = new PDO( DSN, DB_USR, DB_PWD );
				$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);	
				$stmt = $pdo->prepare(
    "SELECT MAX(id) as latest_message_id, 
            CASE 
                WHEN from_message = :username THEN to_message 
                ELSE from_message 
            END AS other_party, 
            MAX(date_update) as latest_timestamp,
            COUNT(*) as total_messages,to_message,from_message
    FROM message
    WHERE to_message = :username OR from_message = :username
    GROUP BY 
            CASE 
                WHEN from_message = :username THEN to_message 
                ELSE from_message 
            END
    ORDER BY latest_timestamp DESC"
);

$stmt->execute([':username' => $_SESSION["user"]["userName"]]);
$currentUser = $_SESSION["user"]["userName"];
		echo '<div class="inbox_chat">';
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$from = $row["from_message"];
				$date_update = $row["latest_timestamp"]; // Use latest_timestamp instead of date_update
				$formatted_date = date("M d", strtotime($date_update));
				$other_party = $row["other_party"]; // Use the other_party field
				if ($from == $currentUser) {
				$from = $row["to_message"]; // Use the other_party field
				} else {
				$from = $row["from_message"];	
				}
				echo '<div class="chat_list active_chat">';
				echo '<div class="chat_people">';
				echo '<div class="chat_img">From: '.$from.'<img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>';
				echo '<div class="chat_ib">';
				echo '<h5><span class="other">'.$other_party.'</span><span class="chat_date">'.$formatted_date.'</span></h5>';
				// Now you need to fetch the latest message for this conversation and display it
				$latest_message_id = $row["latest_message_id"];
				$latest_message_stmt = $pdo->prepare("SELECT * FROM message WHERE id = :id");
				$latest_message_stmt->execute([':id' => $latest_message_id]);
				$latest_message_row = $latest_message_stmt->fetch(PDO::FETCH_ASSOC);
				echo '<p>'.$latest_message_row["message"].'</p>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
			echo '</div>';

			
		  ?>
        </div>
        <div class="mesgs">
          <div class="msg_history" >
		  <span style="display: flex; justify-content: center;"><img src="images/message.png" height="50%" width="50%" /></span>
		  <h1 style="display: flex; justify-content: center;">No Conversation Selected</h1>
          </div>
		  
		  <?php
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			$pdo = null;
		  ?>
          <div class="type_msg" style="display:none">
            <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder="Type a messages" />
              <button class="msg_send_btn_reply" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>