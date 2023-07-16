<?php error_reporting(); ?>
<?php include './constant/layout/head.php'; ?>
<?php include './constant/layout/header.php'; ?>

<?php include './constant/layout/sidebar.php'; ?>   
<?php
$lowStockSql = 'SELECT * FROM product WHERE quantity <= 3 AND status = 1';
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;
$connect->close();
?>
  
<style type="text/css">
    .ui-datepicker-calendar {
        display: none;
    }
</style>
        
        <div class="page-wrapper">
            
            <div class="row page-titles">
              
                
            </div>
            
            
            <div class="container-fluid">
               
                
        

                      <div class="row">
                        
                   <div class="col-md-4">
                       <div class="card bg-primary p-20">
                           <div class="media widget-ten">
                               <div class="media-left meida media-middle">
                                   <span><i class="ti-book f-s-40"></i></span>
                               </div>
                               <div class="media-body media-text-right">
                                
                           
                                   <h2 class="color-white"><?php echo 3; ?></h2>
                                   <a href="product.php"><p class="m-b-0">Total Product</p></a>
                               </div>
                           </div>
                       </div>
                   </div> 
                    <?php if (
                        isset($_SESSION['userId']) &&
                        $_SESSION['userId'] == 1
                    ) { ?>
                    <div class="col-md-4">
                        <div class="card bg-dark p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-comment f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                                        
                    
                    
                            
                                    <h2 class="color-white"><?php 0; ?></h2>
                                     <a href="product.php"><p class="m-b-0">Low Stock</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                                       <?php } ?> 
                 <?php if (
                     isset($_SESSION['userId']) &&
                     $_SESSION['userId'] !== 0
                 ) { ?>
                   <div class="col-md-4">
                      <div class="card bg-danger p-20">
                          <div class="media widget-ten">
                              <div class="media-left meida media-middle">
                                  <span><i class="ti-vector f-s-40"></i></span>
                              </div>
                              <div class="media-body media-text-right">
                                  
                          <h2 class="color-white"><?php echo 1; ?></h2>
                                  <a href="Order.php"><p class="m-b-0">Total Order</p></a>
                              </div>
                          </div>
                      </div>
                  </div>
                                 <?php } ?>
                </div>  
                <div class="row"> 
        <div class="col-md-4">
        <div class="card" style="background-color:#ffc107;">
          <div class="cardHeader">
            <h1 style="color:white;"><?php echo date('d'); ?></h1>
          </div>

          <div class="cardContainer">
            <p style="color:white;"><?php echo date('l') .
                ' ' .
                date('d') .
                ', ' .
                date('Y'); ?></p>
          </div>
        </div> 
        <br/>

        <div class="card" style="background-color:#009688;">
          <div class="cardHeader">
            <h1 style="color:white;"><?php if ($totalRevenue) {
                echo $totalRevenue;
            } else {
                echo '0';
            } ?></h1>
          </div>

          <div class="cardContainer">
            <p style="color:white;">Total Revenue</p>
          </div>
        </div> 

    </div>
    <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] !== 0) { ?>
     <div class="col-md-8">
<div class="card">
                            <div class="card-header">
                                <strong class="card-title">User Wise Order</strong>
                            </div>
                            
                    </div>
                </div>
             
            <?php } ?>

                
            </div>
        </div>
    </div>

            
            <?php include './constant/layout/footer.php'; ?>
        <script>
        $(function(){
            $(".preloader").fadeOut();
        })
        </script>