<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Token Generate</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Token Manager </a></li>
                        <li class="breadcrumb-item active"> Token Generate</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h2>Token Generate</h2>
                    </div>
                    <div class="body">
                        <form method="POST" action="generateTokenProcess" >
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Rest Token *</label>
                                            <input type="text" name="restToken" id="restToken" class="form-control" value="<?=$botToken?>" readonly>
                                            <input type="hidden" name="loginMemberId" value="<?=$member_id?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Generate Token *</label>
                                            <input type="text" name="generateToken" id="generateToken" class="form-control" required placeholder="Enter Distribute ICO Token" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Token Rate *</label>
                                            <input type="text" id="coinRate" name="coinRate" class="form-control" placeholder="e.g. Token Rate" required >
                                        </div>
                                   </div>
                                </div>
                                <button type="submit" name="tokenGenerate" class="btn btn-primary action-button float-left" value="Generate Token" > Generate Token</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Token Generate History</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rest Global Token</th>
                                        <th>Token Generate</th>
                                        <th>Token Sell</th>
                                        <th>Generate Rate</th>
                                        <th>Generate Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $count=0;
                                    $queryToken=mysqli_query($con,"SELECT * FROM meddolic_config_coin_generate_history ORDER BY dateTime ASC");
                                    while($valToken=mysqli_fetch_assoc($queryToken)){
                                        $count++; ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><i class="fa fa-coins"></i> <?= $valToken['restCoin']?></td>
                                        <td><i class="fa fa-coins"></i> <?= $valToken['coinGenerate']?></td>
                                        <td><i class="fa fa-coins"></i> <?= $valToken['coinSell']?></td>
                                        <td>$  <?= $valToken['coinRate']?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= $valToken['dateTime']?></td>
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
</div>
<?php include('include/footer.php'); ?>
<script>
var d = document.getElementById("Token");
    d.className += " active";
var d = document.getElementById("tokenGenerate");
    d.className += " active";
</script>
</body>
</html> 