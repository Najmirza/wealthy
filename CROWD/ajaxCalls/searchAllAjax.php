<?php include("../../conection.php"); ?>
<style type="text/css">
.highlight { background-color: yellow; }
</style>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card">
          <div class="header">
              <h2>Search Member Result</h2>
          </div>
          <div class="body">
              <div class="table-responsive">
                  <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                      <thead>
                          <tr>
                              <th>#</th>          
                              <th>User Id</th>
                              <th>Name</th>
                              <th>Phone</th>
                              <th>Sponser ID</th>
                              <th>Sponser Name</th>
                              <th>Joinig Date</th>
                              <th>More Details</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                        function name($con,$member_id){
                          $query="SELECT name from meddolic_user_details where member_id='$member_id'";
                          $result=mysqli_query($con,$query);
                          $val1=mysqli_fetch_array($result);
                          return $val1[0];
                        }
                        function user_id($con,$member_id){
                          $query="SELECT user_id from meddolic_user_details where member_id='$member_id'";
                          $result=mysqli_query($con,$query);
                          $val1=mysqli_fetch_array($result);
                          return $val1[0];
                        }
                        $i=1;
                        if(!empty($_GET["search_value"])){
                          $s_value=$_GET['search_value'];
                          $search_value=strtolower($s_value);
                          $search_value=strtoupper($s_value);
                          $query=mysqli_query($con,"SELECT * from meddolic_user_details where CONCAT (`user_id`, `name`, `phone`) LIKE '%".$s_value."%' AND user_type=2");
                          $row=mysqli_num_rows($query);
                          if($row == 0) { ?>
                          <tr>
                              <td colspan="9"><b><center> No Record Found </center>  </b> </td>
                          </tr>
                    <?php  } else {
                        while($val1=mysqli_fetch_array($query)){
                    echo "<tr>";
                    echo "<td>" . $i ."</td>"; 
                    echo "<td>" . str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", $val1['user_id']) . "</td>";
                    echo "<td>" . str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", $val1['name']) . "</td>";
                    echo "<td>" . str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", $val1['phone']) . "</td>";
                    echo "<td>" . str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", user_id($con,$val1['sponser_id'])) . "</td>";
                    echo "<td>" . str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", name($con,$val1['sponser_id'])) . "</td>";
                    echo "<td>" . str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", date("d-m-Y H:i:d", strtotime($val1['date_time']))) . "</td>";
                    echo "<td><a class='btn btn-success btn-sm' href='viewMemberDetails?user_id=".$val1['user_id']."'>More</a>";?> &nbsp; <a href="javascript:void(0);" onclick="memberDashboard('<?=base64_encode($val1['user_id'])?>','<?=$val1['password']?>','<?=base64_encode($val1['member_id'])?>')" class="btn btn-primary btn-sm">Dashboard</a> &nbsp; <?php if($val1['account_status']==1) { ?><a href="javascript:void(0);" onclick="blockUser(<?=$val1['member_id']?>,0)" class="btn btn-danger btn-sm" style="font-size: 12px;">Block User</a><?php } else { ?> <a href="javascript:void(0);" onclick="unBlockUser(<?=$val1['member_id']?>,1)" class="btn btn-warning btn-sm" style="font-size: 10px;">Un-Block User</a> <?php } ?>  <?php echo "</td>"; 
                    echo "</tr>"; ?>
                    <?php $i++;  }  } ?>
                        </tbody>
                    <?php } ?>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>