<?php 
  include_once("header/header.php");
  include_once("header/menu.php");
?>
<div id="content-wrapper">
<div class="container-fluid">

<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="#">Dashboard</a>
</li>
<li class="breadcrumb-item active">Tables</li>
</ol>
<div class="card mb-3">
<div class="card-header">
<i class="fas fa-table"></i> Data Table Example</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Name</th>
          <th>Position</th>
          <th>Office</th>
          <th>Age</th>
          <th>Start date</th>
          <th>Salary</th>
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
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<?php include_once("header/footer.php"); ?>