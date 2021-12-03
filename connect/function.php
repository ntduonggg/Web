<?php 
    include 'connect_db.php';

    function getUsernameById(int $id)
	{
        global $con;
        $sql = mysqli_query($con, "SELECT `cname` FROM `customertbl` WHERE `cid` = $id LIMIT 1");
		return mysqli_fetch_assoc($sql)['cname'];
	}

	function getRepliesByCommentId($id)
	{
        global $con;
		$result = mysqli_query($con, "SELECT * FROM `replytbl` WHERE `comment_id` = $id ");
		$replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $replies;
	}

	function getCommentsCountByPostId($proid)
	{
        global $con;
		$result = mysqli_query($con, "SELECT COUNT(*) AS total FROM `commenttbl`");
		$data = mysqli_fetch_assoc($result);
		return $data['total'];
	}