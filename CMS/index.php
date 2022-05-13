<?php include('init.php');?>
<?php include ADMIN_TPL.'header.php';?>
    <!-- Start Main-Content -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <div class="box box-x">
            <?php
                  $sql = 'SELECT * FROM tbl_food';
                  $stat = $cont->prepare($sql);
                  $stat->execute();
                  $c = $stat->rowCount();
                  if ($c > 0) {
                      $clients = $c;
                  }
                ?>
                <h2><?php echo $clients;?></h2>
                <h4>Clients</h4>
            </div>
            <div class="box box-x">
                <?php
                  $sql1 = 'SELECT * FROM tbl_category';
                  $stat1 = $cont->prepare($sql1);
                  $stat1->execute();
                  $c1 = $stat1->rowCount();
                  if ($c1 > 0) {
                      $cates =  $c1;

                  }
                ?>
                <h2><?php echo $cates;?></h2>
                <h4>Categories</h4>
            </div>
            <div class="box box-x">
            <?php
                  $sql2 = 'SELECT * FROM tbl_food';
                  $stat2 = $cont->prepare($sql2);
                  $stat2->execute();
                  $c2 = $stat2->rowCount();
                  if ($c2 > 0) {
                      $foods =  $c2;

                  }
                ?>
                <h2><?php echo $foods;?></h2>
                <h4>Foods</h4>
            </div>
            <div class="box box-x">
            <?php
                  $sql3 = 'SELECT * FROM tbl_food ';
                  $stat3 = $cont->prepare($sql3);
                  $stat3->execute();
                  $c3 = $stat3->rowCount();
                  if ($c3 > 0) {
                      $ords =  $c3;

                  }
                ?>
                <h2><?php echo $ords;?></h2>
                <h4>Orders</h4>
            </div>
        </div>
    </div>

     <!-- End Main-Content -->
     <?php include('includes/templates/footer.php') ?>