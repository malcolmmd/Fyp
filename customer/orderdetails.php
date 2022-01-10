<?php 

if (!isset($_SESSION['CUSID'])){
redirect(web_root."index.php");
}

$customerid =$_SESSION['CUSID'];
$customer = New Customer();
$singlecustomer = $customer->single_customer($customerid);

  ?>
 
<?php 
  $autonumber = New Autonumber();
  $res = $autonumber->set_autonumber('ordernumber'); 
?>

<form onsubmit="return orderfilter()" action="customer/controller.php?action=processorder" method="post" >   
<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Order Details</li>
        </ol>
      </div>
      <div class="row">
    <div class="col-md-6 pull-left">
      <div class="col-md-2 col-lg-2 col-sm-2" style="float:left">
        Name:
      </div>
      <div class="col-md-8 col-lg-10 col-sm-3" style="float:left">
        <?php echo $singlecustomer->FNAME .' '.$singlecustomer->LNAME; ?>
      </div>
       <div class="col-md-2 col-lg-2 col-sm-2" style="float:left">
        Address:
      </div>
      <div class="col-md-8 col-lg-10 col-sm-3" style="float:left">
        <?php echo $singlecustomer->CUSHOMENUM . ' ' . $singlecustomer->STREETADD . ' ' .$singlecustomer->BRGYADD . ' ' . $singlecustomer->CITYADD . ' ' .$singlecustomer->PROVINCE . ' ' .$singlecustomer->COUNTRY; ?>
      </div>
    </div>

    <div class="col-md-6 pull-right">
    <div class="col-md-10 col-lg-12 col-sm-8">
    <input type="hidden" value="<?php echo $res->AUTO; ?>" id="ORDEREDNUM" name="ORDEREDNUM">
      Order Number :<?php echo $res->AUTO; ?>
    </div>
    </div>
 </div>
      <div class="table-responsive cart_info"> 
 
              <table class="table table-condensed" id="table">
                <thead >
                <tr class="cart_menu"> 
                  <th style="width:12%; text-align:center; ">Product</th>
                  <th >Description</th>
                  <th style="width:15%; text-align:center; ">Quantity</th>
                  <th style="width:15%; text-align:center; ">Price</th>
                  <th style="width:15%; text-align:center; ">Total</th>
                  </tr>
                </thead>
                <tbody>    
                       
              <?php

              $tot = 0;
                if (!empty($_SESSION['gcCart'])){ 
                      $count_cart = @count($_SESSION['gcCart']);
                      for ($i=0; $i < $count_cart  ; $i++) { 

                      $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
                           WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  and p.PROID='".$_SESSION['gcCart'][$i]['productid']."'";
                        $mydb->setQuery($query);
                        $cur = $mydb->loadResultList();
                        foreach ($cur as $result){ 
              ?>

                         <tr>
                         <!-- <td></td> -->
                          <td><img src="admin/products/<?php echo $result->IMAGES ?>"  width="50px" height="50px"></td>
                          <td><?php echo $result->PRODESC ; ?></td>
                          <td align="center"><?php echo $_SESSION['gcCart'][$i]['qty']; ?></td>
                          <td>RM <?php echo  $result->PRODISPRICE ?></td>
                          <td>RM <output><?php echo $_SESSION['gcCart'][$i]['price']?></output></td>
                        </tr>
              <?php
              $tot +=$_SESSION['gcCart'][$i]['price'];
                        }

                      }
                }
              ?>
            

                </tbody>
                
              </table>  
                <div class="  pull-right">
                  <p align="right">
                   <div> Total Price : RM <span id="overall"><?php echo $tot ;?></span></div>
                   <input type="hidden" name="alltot" id="alltot" value="<?php echo $tot ;?>"/>
                  </p>  
                </div>
 
      </div>
    </div>
  </section>
 
  <section id="do_action">
    <div class="container">
      <div class="row">
         <div class="row">
                   <div class="col-md-7">


              <div class="form-group">
                  <label> Payment Method : </label> 
                  <div class="radio" >
                      <label >
                          <input type="radio"  class="paymethod" name="paymethod" id="deliveryfee" value="Paypal" checked="true" data-toggle="collapse"  data-parent="#accordion" data-target="#collapseOne" onclick="show();" >Paypal  
                      </label>
                  </div> 
                  <div class="radio" >
                      <label >
                          <input type="radio"  class="paymethod" name="paymethod" id="deliveryfee" value="Cash on Delivery" checked="true" data-toggle="collapse"  data-parent="#accordion" data-target="#collapseOne" onclick="hide();" >Cash on Delivery 
                      </label>
                  </div> 
                  
                  <div id = "paypal_payment_button" class="col-md-6">
                      <script src="https://www.paypal.com/sdk/js?client-id=ATfRNhXrN2L558Ov9Yy6Z8EJjNAe3q8kizBtFFq_eYZ_MRWKsrqprYTPKlLlnDk-_KHLhhJC4wi9maNr&disable-funding=credit,card"></script>
                      <script src="js\paypal.js"></script>
                      <script type="text/javascript">var totalPrice = "<?= $tot ?>";</script>
                </div>  

                <script type="text/javascript">
                    function hide(){
                      document.getElementById('paypal_payment_button').style.display = 'none';
                    }
                </script>

                <script type="text/javascript">
                    function show(){
                      document.getElementById('paypal_payment_button').style.display = 'block';
                    }
                </script>

                
	
</script>

              </div> 


        </div>
<br/>
 
      </div>
    </div>
  </section><!--/#do_action-->
 
 
  <section id="do_action">
    <div class="container">
      
      <div class="row">
         <div class="row">
                  
<br/>


              <div class="row">
                <div class="col-md-6">
                      <a href="index.php?q=cart" class="btn btn-default pull-left"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>View Cart</strong></a>
                </div>
                
                <div class="col-md-6">
                      <button type="submit" class="btn btn-pup  pull-right " name="btn" id="btn" onclick="return validatedate();"   /> Submit Order <span class="glyphicon glyphicon-chevron-right"></span></button>
                      <script src="https://www.paypal.com/sdk/js?client-id=ATfRNhXrN2L558Ov9Yy6Z8EJjNAe3q8kizBtFFq_eYZ_MRWKsrqprYTPKlLlnDk-_KHLhhJC4wi9maNr&disable-funding=credit,card&currency=MYR"></script> 
                      <script src="js\paypal.js"></script>
                <script type="text/javascript">var totalPrice = "<?= $tot ?>";</script>
                
                </div>  
                   
                
              </div>



              <!-- <div id = "paypal_payment_button">
              <script src="https://www.paypal.com/sdk/js?client-id=ATfRNhXrN2L558Ov9Yy6Z8EJjNAe3q8kizBtFFq_eYZ_MRWKsrqprYTPKlLlnDk-_KHLhhJC4wi9maNr&disable-funding=credit,card"></script>
              <script src="js\paypal.js"></script>
              </div>   
              <script type="text/javascript">var totalPrice = "<?= $tot ?>";</script> -->


             
      </div>
    </div>
  </section><!--/#do_action-->
  
</form>