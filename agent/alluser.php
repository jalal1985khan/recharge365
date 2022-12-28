<?php
session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:/");
}
?>

<?php include('common/header.php'); ?>
<?php include('common/sidebar.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ALL USERS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>
            </div> 
        
<div class="card">
<div class="card-body"> 
<table id="example1" class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>S.NO</th>
            <th>User Type</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>RC BAL</th>
            <th>DMR BAL</th>
            <th>SMS BAL</th>
            <th>Cutt off</th>
            <th>Reg. Date</th>
            <th>Comm</th>
            <th>Status</th>
            <!-- <th>Action</th> -->
        </tr>
    </thead>
    <tbody>
    <?php
                                $res = $con->query("SELECT * FROM retailer order by ID asc");
                                if($res->num_rows > 0){
                                    while($row = $res->fetch_assoc()){
                                        $rt_am += $row['RCBAL'];
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['ID'] ?> </td>
                                                    <td>Retailer</td>
                                                    <td><?php echo $row['FNAME'] . $row['LNAME'] ?></td>
                                                    <td><?php echo $row['MOBILE'] ?> </td>
                                                    <td><?php echo $row['RCBAL'] ?> </td>
                                                    <td><?php echo $row['DMRBAL'] ?> </td>
                                                    <td><?php echo $row['SMSBAL'] ?> </td>
                                                    <td><?php echo $row['CUTTOFFAMOUNT'] ?> </td>
                                                    <td><?php echo $row['REGDATE'] ?> </td>
                                                    <td><a href="user_api.php?user_type=RETAILER&user_id=<?php echo $row['ID']?> ">Edit Api</a></td> 
                                                    <td><a  href="../retailer/index.php?login_rt&id=<?php echo $row['ID']?>" target="_blank">Login</a></td>
                                                </tr>
                                                <?php
                                                  }
                                                }
                                                    
                                                ?>
<?php
                                $res = $con->query("SELECT * FROM distributer order by ID asc");
                                if($res->num_rows > 0){
                                    while($row = $res->fetch_assoc()){
                                                $ds_am += $row['RCBAL'];
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['ID'] ?> </td>
                                                    <td>Distributer</td>
                                                    <td><?php echo $row['NAME'] ?></td>
                                                    <td><?php echo $row['MOBILE'] ?> </td>
                                                    <td><?php echo $row['RCBAL'] ?> </td>
                                                    <td><?php echo $row['DMRBAL'] ?> </td>
                                                    <td><?php echo $row['SMSBAL'] ?> </td>
                                                    <td><?php echo $row['CUTTOFFAMOUNT'] ?> </td>
                                                    <td><?php echo $row['REGDATE'] ?> </td>
                                                    <td><a href="user_api.php?user_type=DISTRIBUTER&user_id=<?php echo $row['ID']?> ">Edit Api</a></td><td><a  href="../distributer/index.php?login_ds&id=<?php echo $row['ID']?>" target="_blank">Login</a></td>
                                                   
                
                                                </tr>
                                                <?php
                                                  }
                                                }
                                                    
                                                ?>
                                                  <?php
                                $res = $con->query("SELECT * FROM masterdistributer order by ID asc");
                                if($res->num_rows > 0){
                                    while($row = $res->fetch_assoc()){
                                        $ms_am += $row['RCBAL'];
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['ID'] ?> </td>
                                                    <td>Masterdistributer</td>
                                                    <td><?php echo $row['NAME']?></td>
                                                    <td><?php echo $row['MOBILE'] ?> </td>
                                                    <td><?php echo $row['RCBAL'] ?> </td>
                                                    <td><?php echo $row['DMRBAL'] ?> </td>
                                                    <td><?php echo $row['SMSBAL'] ?> </td>
                                                    <td><?php echo $row['CUTTOFFAMOUNT'] ?> </td>
                                                    <td><?php echo $row['REGDATE'] ?> </td>
                                                    <td><a href="user_api.php?user_type=MASTERDISTRIBUTER&user_id=<?php echo $row['ID']?> ">Edit Api</a></td><td><a  href="../masterdistributer/index.php?login_ms&id=<?php echo $row['ID']?>" target="_blank">Login</a></td>
                                                   
                
                                                </tr>
                                                <?php
                                                  }
                                                }
                                                    
                                                ?>                                                
                                              
    </tbody>
    <tfoot>
<th></th>
<th></th>
<th></th>
<th>Total Amount</th>
<th><?php echo $rt_am+$ds_am+$ms_id ?> </th>
</tfoot>    
</table>

  
        </div>
        </div><!-- /.container-fluid -->
        </div>
    
    </section></div>
<?php include('common/footer.php'); ?>