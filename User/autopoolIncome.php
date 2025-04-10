<?php 
  require_once("loginCheck.php");
    require_once('Include/Head.php');
    require_once('Include/Header.php');
    require_once('Include/Menu.php');?>




<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">Auto Pool Entry </h4>

        <div class="row">
            <div class="card crd0">
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="table table-bordered table-hover display margin-top-5 w-p50" id="export-button">
                            <tbody>

                            <th>Sl. No</th>
                  <th>Status</th>
                  <th>Entry Date</th>
                </tr>
              </thead>
              <tbody>
              <?php
$count = 0;
$queryReferral =mysqli_query($con,"SELECT entryDate,poolStatus,entryId FROM meddolic_user_pool_entry_details  WHERE memberId='$memberId'  ORDER BY  entryId ASC");
// $queryReferral =mysqli_query($con, "
//     (SELECT 'Entry Details' AS source, entryDate, poolStatus, entryId, NULL AS incomeEntryId
//      FROM meddolic_user_pool_entry_details 
//      WHERE memberId='$memberId')

//     UNION ALL

//     (SELECT 'Income Details' AS source, NULL AS entryDate, NULL AS poolStatus, entryId, entryId AS incomeEntryId
//      FROM meddolic_user_pool_income 
//      WHERE memberId='$memberId')
     
//     ORDER BY entryId ASC
// ");

while ($valReferral = mysqli_fetch_assoc($queryReferral)) {

    $count++;
    $poolStatus = $valReferral['poolStatus'];
    $statusText = ($poolStatus == 2) ? "Paid" : "Pending";
    ?>
    <tr>
        <td><?= $count ?></td>
        <td><?= $statusText ?></td>
        <td><?= $valReferral['entryDate'] ?></td>
    </tr>
    <?php
}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <h4 class="fw-bold py-3 mb-4">Auto Pool Income</h4>
        <div class="container-fluid">
            <div class="row">


                <div class="row">
                    <div class="card crd0">
                        <div class="card-body">
                            <div class="dt-ext table-responsive">
                                <table class="table table-bordered table-hover display margin-top-10 w-p100"
                                    id="export-button">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>UserId</th>
                                            <th>Pool Level</th>
                                            <th>Pool Income</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
              $count=0;
              $queryPool=mysqli_query($con,"SELECT a.id,a.poolIncome,a.poolLevel,a.entryId,a.dateTime,a.releaseStatus,b.user_id,b.name FROM meddolic_user_pool_income a, meddolic_user_details b WHERE a.memberId=b.member_id AND a.memberId='$memberId'  ORDER  BY a.dateTime DESC");
              while($valPool=mysqli_fetch_assoc($queryPool)){
                 $count++;  ?>
                                        <tr>
                                            <td><?= $count?></td>
                                            <td><?= $valPool['user_id']?></td>
                                            <td>Pool <?= $valPool['poolLevel']?></td>
                                            <td><span class="badge badge-success"><i class="fa-solid fa fa-dollar"></i>
                                                    <?= $valPool['poolIncome']?></span></td>
                                            <td><i class="fa-regular fa-clock"></i>
                                                <?= date("d-m-Y H:i:s", strtotime($valPool['dateTime']))?></td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once('Include/Footer.php');?>