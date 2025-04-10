<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">

  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">


    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Financial Report /</span> History
    </h4>

    <div class="container-fluid">
      <div class="row">
        <div class="card crd0">
          <div class="card-body">
            <form class="row row-cols-sm-3 theme-form mt-3 form-bottom">
              <div class="col-md-3 mb-3 d-flex">
                <div class="input-group">
                  <input type="text" class="form-control pull-right" name="fromDate" id="fromDate" value="12-04-2023" readonly=""><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
              <div class="col-md-3 mb-3 d-flex">
                <div class="input-group">
                  <input type="text" class="form-control pull-right" name="toDate" id="toDate" value="12-04-2023" readonly=""><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
              <div class="mb-3 d-flex">
                <button class="btn btn-primary btn-sm" data-bs-original-title="" title="">Search</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card crd0">
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="table table-bordered table-hover display margin-top-10 w-p100" id="export-button">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User Id</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Income Type</th>
                    <th>Transaction Type</th>
                    <th>Remark</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <?php require_once('Include/Footer.php'); ?>