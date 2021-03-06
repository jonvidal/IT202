<?php

require_once("error.php.inc");
class localDB
{
    private $db;
    private $salt;	
    private $logger;
    public function __construct($iniFile){
	$ini = parse_ini_file($iniFile,true);
        $this->logger = new errorLogger("/var/log/it202.log");
	$this->db = new mysqli(
		$ini['loginDB']['host'],
		$ini['loginDB']["user"],
		$ini['loginDB']["password"],
		$ini['loginDB']["db"]);
	$this->salt = $ini['loginDB']['salt'];
	if ($this->db->connect_errno > 0 )
	{
		$this->logger->log(__FILE__.__LINE__."failed to connect to database re: ".$this->db->connect_error);
		exit(0);
	}
    }
    public function __destruct()
    {
	$this->db->close();
    }

    public function getUserId($username)
    {
	$query = "select userId from fantasysport where userName = '$username';";
	$results = $this->db->query($query);
	if (!$results)
	{
	    $this->logger->log("error with results: ".$this->db->error);
	    return 0;
	}
        $client = $results->fetch_assoc();
	if (isset($client['userId']))
	{
	    return $client['userId'];
	}
	return 0;
    }

    private function saltPassword($password)
    {
	return $this->db->real_escape_string(sha1($password.$this->salt));
    }

    public function validateUser($username,$password)
    {
	if ($this->getUserId($username) == 0)
        {
	    return array("success"=>false,
		"message"=>"user does not exist");
	}
	$query = "select * from fantasysport where userName='$username';";
	$results = $this->db->query($query);
	if (!$results)
	{
	    return array("success"=>false,
		"message"=>"db failure");
	}
        $client = $results->fetch_assoc();
        {
	    if ($client['userPW'] == $this->saltPassword($password))
	    {
		return array("success"=>true);
	    }
        }
        return array("success"=>false,"message"=>"failed to match password");
    }

    public function addNewUser($username,$password, $firstName, $lastName, $emailAd)
    {
	if ($this->getUserId($username) != 0)
        {
	    $this->logger->log("user $username already exists!!!!!");
	    $response = array(
		"message"=>"user $username already exists!",
		"success"=>false
		);
	    return $response;
	}
        $now = date("Y-m-d h:i:s",time());
        $name = $this->db->real_escape_string($username);
	$password = $this->saltPassword($password);
        $addQuery = "insert into fantasysport (userName, userPW, firstName, lastName, emailAd, activeSession, lastLogin, permission) values ('$username', '$password', '$firstName', '$lastName', '$emailAd','$now','$now','FALSE');";
        $results = $this->db->query($addQuery);
	if (!$results)
	{
	    $this->logger->log("error: ".$this->db->error);
	    return "Connect DB Error";
	}
	$userdb = "create table $username (playerId int(11) primary key);";
	$create = $this->db->query($userdb);
	if (!$create)
	{
	    $this->logger->log("error: ".$this->db->error);
	    return "Connect DB Error";
	}
	return array("success"=>true);
	
    }
    //-------------------------------------------------------------------------------------------------------------
    //
    //-------------------------------------------------------------------------------------------------------------
    
    public function nbaTeams(){
      $query = "select * from nbateam";
      $results = $this->db->query($query);
      if ( !$results ){
	return "error";
      }
      $count = 0;
      while ( $team =  $results->fetch_assoc() ){
	if ($count < 4){
	  $strTeam .= "<td style='font-weight:bolder;'><a href='nbateams/".preg_replace('/\s+/', '', $team["teamName"]).".php' title='".$team["teamName"]."'>".$team["teamName"]."</a></td>";
	  ++$count;
	}else{
	  $strTeam .= "<td style='font-weight:bolder;'><a href='nbateams/".preg_replace('/\s+/', '', $team["teamName"]).".php' title='".$team["teamName"]."'>".$team["teamName"]."</a></td>";
	  $count = 0;
	  $division = "<tr><td colspan='5' align='center'class='thsub'><strong>".ucfirst($team['division'])."</strong></td></tr>";
	  $colTeam = $division."<tr>".$strTeam."</tr>";
	  $reT .= $colTeam;
	  $strTeam = "";
	}
      }
      return "<table>".$reT."</table>";
    }
    
    public function nbaStandings(){
      $query = "select * from nbateam
		where conference = 'east'
		order by wins desc, losses asc; ";
      $results = $this->db->query($query);
      if (!$results){
	return "error";
      }
      $heading="<tr><th>Eastern Conference</th><th>W</th><th>L</th></tr>";
      while ( $team =  $results->fetch_assoc() ){
	$row .= "<tr><td><a href='nbateams/".preg_replace('/\s+/', '', $team["teamName"]).".php' title='".$team["teamName"]."'>".$team["teamName"]."</a></td><td align='center'>".
		$team["wins"]."</td><td align='center'>".$team["losses"]."</td></tr>";
      }
      $east = "<table>".$heading.$row."</table>";
      
      $query1 = "select * from nbateam
		where conference = 'west'
		order by wins desc, losses asc; ";
      $results1 = $this->db->query($query1);
      if (!$results1){
	return "error";
      }
      $heading1="<tr><th>Western Conference</th><th>W</th><th>L</th></tr>";
      while ( $team1 =  $results1->fetch_assoc() ){
	$row1 .= "<tr><td><a href='nbateams/".preg_replace('/\s+/', '', $team1["teamName"]).".php' title='".$team1["teamName"]."'>".$team1["teamName"]."</a></td><td align='center'>".
		$team1["wins"]."</td><td align='center'>".$team1["losses"]."</td></tr>";
      }
      $west = "<table>".$heading1.$row1."</table>";
      
      return "<table><tr><td>".$east."</td><td>".$west."</td></tr></table>";
    }
    
    public function nbaSelTeam($selTeam){
      $query = "select * from nbarosters where teamId = '$selTeam' order by points desc;";
      $results = $this->db->query($query);
      if (!$results){
	return "error";
      }
      $heading = "<tr><td ><b>Players</b></td><td align='center'><b>FG%</b></td><td align='center'><b>FT%</b></td><td align='center'><b>3PM</b></td>
		  <td align='center'><b>REB</b></td><td align='center'><b>AST</b></td><td align='center'><b>STL</b></td>
		  <td align='center'><b>BLK</b></td><td align='center'><b>TO</b></td><td align='center'><b>PTS</b></td></tr>";
      while( $team =  $results->fetch_assoc() ){
	$row .= "<tr><td><form action='../account.php' method='post'>".$team['lastName'].", ".$team['firstName']." ".$team['position'].
		"&nbsp; &nbsp; <button type='submit' name='addteam' alt='Add' value='".$team['playerID']."' style='border:none;background:url(img/add_small.png);
		width:16px;height:16px;vertical-align:middle;'></button>
		</form></td><td align='center'>".
		$team['fieldGoal']."</td><td align='center'>".
		$team['freeThrow']."</td><td align='center'>".
		$team['threePoint']."</td><td align='center'>".
		$team['rebound']."</td><td align='center'>".
		$team['assist']."</td><td align='center'>".
		$team['steal']."</td><td align='center'>".
		$team['block']."</td><td align='center'>".
		$team['turnovers']."</td><td align='center'>".
		$team['points']."</td></tr>";
      }
      return "<table class='rosters'>".$heading.$row."</table>";
      }
      
     //-------------------------------------------------------------------------------------------------------------
    //
    //-------------------------------------------------------------------------------------------------------------
   public function myteam($user){
      $query = "select $user.playerId, nbarosters.* 
		from $user
		left join nbarosters on $user.playerId = nbarosters.playerID
		order by nbarosters.points desc
		;";
      $results = $this->db->query($query);
      if (!$results){
	return "error";
      }
      if ( $results->num_rows > 0){
	$heading = "<tr><td><b>Players</b></td><td align='center'><b>FG%</b></td><td align='center'><b>FT%</b></td><td align='center'><b>3PM</b></td>
		  <td align='center'><b>REB</b></td><td align='center'><b>AST</b></td>
		  <td align='center'><b>STL</b></td><td align='center'><b>BLK</b></td><td align='center'><b>TO</b></td>
		  <td align='center'><b>PTS</b></td></tr>";
	while ( $team = $results->fetch_assoc() ){
	  $myteam .= "<tr><td><form action='account.php' method='post'>".$team['lastName'].", ".$team['firstName']." ".$team['position'].
		"&nbsp; &nbsp; <button type='submit' name='removeplayer' alt='Add' value='".$team['playerId']."' style='border:none;background:url(nbateams/img/minus.png);
		width:16px;height:16px;vertical-align:middle;'></button>
		</form></td><td align='center'>".
		$team['fieldGoal']."</td><td align='center'>".
		$team['freeThrow']."</td><td align='center'>".
		$team['threePoint']."</td><td align='center'>".
		$team['rebound']."</td><td align='center'>".
		$team['assist']."</td><td align='center'>".
		$team['steal']."</td><td align='center'>".
		$team['block']."</td><td align='center'>".
		$team['turnovers']."</td><td align='center'>".
		$team['points']."</td></tr>";
	}
	return "<table class='rosters'>".$heading.$myteam."</table>";
      } else return "Add Players...";
    }
    public function addplayer($player, $user){
      $check = "select * from $user where playerId = $player";
      $results = $this->db->query($check);
      if (!$results){
	return "error";
      }
      if ($results->num_rows > 0){
	return "Failed - Player Exists";
      }else{
	$query = "insert into $user(playerId) values( '$player')";
	$res = $this->db->query($query);
	if (!$res){
	  return "error";
	  }
	return "Successfully Added";
	}
    }
    
    public function removeplayer($player, $user){
      $check = "select * from $user where playerId = $player; ";
      $results = $this->db->query($check);
      if (!$results){
	return "error";
      }
      
      if ($results->num_rows == 1){
	$query = "delete from $user where playerId = $player; ";
	$res = $this->db->query($query);
	if (!$res){
	  return "ERROR";
	  }
      }else {
	return "Player cannot be found ".$player;
      }
      
    }
    
    
     //-------------------------------------------------------------------------------------------------------------
    //
    //-------------------------------------------------------------------------------------------------------------
    
    public function allnbaplayers(){
      $query = "select * from nbarosters order by points desc;";
      $results = $this->db->query($query);
      if (!$results){
	return "error";
      }
      $heading = "<thead><th width='37%'><b>Players</b></th><th  width='7%' align='center'><b>FG%</b></th><th width='7%' align='center'><b>FT%</b></th><th width='7%' align='center'><b>3PM</b></th>
		  <th width='7%' align='center'><b>REB</b></th><th width='7%' align='center'><b>AST</b></th><th  width='7%' align='center'><b>STL</b></th>
		  <th width='7%' align='center'><b>BLK</b></th><th width='7%' align='center'><b>TO</b></th><th width='7%' align='center'><b>PTS</b></th></thead>";
      while( $team =  $results->fetch_assoc() ){
	$row .= "<tr><td width='37%'><form action='../account.php' method='post'>".$team['lastName'].", ".$team['firstName']." ".$team['position'].
		"&nbsp; &nbsp; <button type='submit' name='addteam' alt='Add' value='".$team['playerID']."' style='border:none;background:url(nbateams/img/add_small.png);
		width:16px;height:16px;vertical-align:middle;'></button>
		</form></td><td width='7%' align='center'>".
		$team['fieldGoal']."</td><td width='7%' align='center'>".
		$team['freeThrow']."</td><td width='7%' align='center'>".
		$team['threePoint']."</td><td width='7%' align='center'>".
		$team['rebound']."</td><td width='7%' align='center'>".
		$team['assist']."</td><td width='7%' align='center'>".
		$team['steal']."</td><td width='7%' align='center'>".
		$team['block']."</td><td width='7%' align='center'>".
		$team['turnovers']."</td><td width='7%' align='center'>".
		$team['points']."</td></tr>";
      }
      
      return "<table class='rosters'>".$heading."</table><table id='myTable' class='table' class='rosters'><tbody>".$row."</tbody></table>";
    }
     //-------------------------------------------------------------------------------------------------------------
    //
    //-------------------------------------------------------------------------------------------------------------
    public function getPermission($username){
      $query = "select * from fantasysport where userName = '$username'";
      $result = $this->db->query($query);
      if (!$result){
	return array("success" => TRUE, "message" => "Failed to connect in user table");
      }else {
	if ($result->num_rows > 0){
	  $check = $result->fetch_assoc();
	  $permission = $check["permission"];
	  if ($permission == 1){
	    return array("success" => TRUE);
	  }else return array("success" => FALSE);
	}else return array("success" => FALSE, "message" => "Cannot Find The $username");
      }
    }
     //-------------------------------------------------------------------------------------------------------------
    //
    //-------------------------------------------------------------------------------------------------------------
    public function listNba(){
    $query = "select * from nbateam";
    $results = $this->db->query($query);
    if (!$results){
	return array("success" => FALSE, "message" => "Failed to connect in nba table");
      }else{
	while($row = $results->fetch_assoc()){
	  $list .= "<option value='".$row['teamId']."'>".$row['teamName']."</option>";
	}
	$return = "<select name='nbateam'><option>Select A Team...</option>".$list."</select>";
	return array("success"=>TRUE, "message"=> $return);
      }
  

   }
    //-------------------------------------------------------------------------------------------------------------
    //
    //-------------------------------------------------------------------------------------------------------------
   public function adminAdd($teamId,$firstName,$lastName,$position,$fieldGoal,$freeThrow,$threePoint,$rebound,$assist,
				  $steal,$block,$turnovers,$points){
   $query="select * from nbarosters where firstName = '$firstName' and lastName = '$lastName' and position = '$position'
	  and teamId = '$teamId';";
   $result = $this->db->query($query);
   if(!$result){
    return array("success"=>FALSE, "message"=>"Error: Failed to connect to roster table");
   }else{
    if($result->num_rows == 0){
      $add = "insert into nbarosters(teamId, firstName, lastName, position, fieldGoal, freeThrow, threePoint,
		      rebound, assist, steal, block, turnovers,points)
		      values('$teamId','$firstName','$lastName','$position','$fieldGoal',
			      '$freeThrow','$threePoint','$rebound','$assist','$steal','$block','$turnovers','$points');";
		      
	$results_add = $this->db->query($add);
	if (!$results_add){
	  return array("success" => FALSE, "message" => "Error insert to roster table");
	}else {
	  return array("success" => TRUE);
	}
      }else return array("success"=> FALSE, "message"=>"Error: $firstName $lastName already exist in selected team. Try Again!");
    }
   }
   
   public function adminRemove($teamId, $firstName, $lastName, $position){
    $queryteam="select * from nbarosters where firstName = '$firstName' and lastName = '$lastName' and position = '$position'
	  and teamId = '$teamId';";
    $resultsteam = $this->db->query($queryteam);
    if(!$resultsteam){
      return array("success"=>FALSE, "message"=>"Error: Failed to connect to roster table");
    }else{
	if($resultsteam->num_rows > 0){
	$query = "delete from nbarosters where firstName = '$firstName' and lastName = '$lastName' and position = '$position'
	    and teamId = '$teamId';";
	$results = $this->db->query($query);
	if(!$results){
	  return array("success" => FALSE, "message" => "Error: deleteing $firstName $lastName is not found. Try Again!");
	}else return array("success" => TRUE);
      }else return array("success" => FALSE, "message" => "Error: $firstName $lastName is not found. Try Again!");
      
     }
   
   }
   
   
   
   
   
   
  }
  
 
// at this point db is connected
?>
