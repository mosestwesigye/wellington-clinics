<div class="row">
  <div class="col-md-12">
    <div class="col-md-3">

      <h1 class="package-name font-green"><?php echo $plan->plan_name ?></h1>
      <h2 class="price font-orange">Ugx <span class="package-value"> <?php echo to_money($plan->amount); ?></span></h2>
      <small></small>

      <div class="col-md-12">

        <form action="<?php echo base_url(); ?>payment/process/<?php echo $plan->reference; ?>" method="post">
          <div class="row ">
            <h3 class="text-left">Home Care Visits <span><a type="button" data-toggle="tooltip" data-placement="right" title="Home visit package covers up a radius of 20km from Clinic. Every extra kilometer will be charged ugx 2,000/-"><i class="fa fa-info-circle" aria-hidden="true"></i></a></span> </h3>
            <!-- <p class="text-left">Home visit package (On top of the above) covers up a radius of 20km from Clinic</p> -->
            <div class="col-md-12 table-responsive">
            <table class="table table-hover" style="color:#000000; font-size:12px !important;">

              <tr class="orange-light">
                <th>
                  <label class="rd-container">
                  <input type="radio" class="visit-value" name="visit" value="800000" data-visit-name="12 Visits Monthly">
                  <span class="checkmark"></span>
                  </label>
                </th>
                <th>12 Visits</th>
                <th>Monthly</th>
                <th>Ugx800,000</th>
              </tr>
              <tr class="orange">
                <th>
                  <label class="rd-container">
                  <input type="radio" name="visit" value="400000" data-visit-name="6 Visits, Every 2 Months">
                  <span class="checkmark"></span>
                  </label>
                </th>
                <th>6 Visits</th>
                <th>Every 2 Months</th>
                <th>Ugx400,000</th>
              </tr>
              <tr class="orange-light">
                <th>
                  <label class="rd-container">
                  <input type="radio" name="visit" value="300000"  data-visit-name="4 Visits, Quarterly">
                  <span class="checkmark"></span>
                  </label>
                </th>
                <th>4 Visits</th>
                <th>Quarterly</th>
                <th>Ugx300,000</th>
              </tr>
              <tr class="orange">
                <th>
                  <label class="rd-container">
                  <input type="radio"  checked="checked"  name="visit" value=""  data-visit-name="">
                  <span class="checkmark"></span>
                  </label>
                </th>
                <th colspan="3">No i do not want Home Care Visits.</th>
              </tr>
            </table>
          </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <span>Total Amount</span>
              <h2 class="final-value"></h2><small class="home-care-inc"> <i class="fa fa-check-circle-o font-green font12"></i> Home Care Visit inclusive</small>
              <input type="hidden" name="visit" id="id_hidden_visit">
              <input type="hidden" name="amount" id="id_hidden_amount">
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-success green cbtn">MAKE PAYMENT</a>
            </div>
          </div>
        </form>


      </div>
    </div>

    <div class="col-md-9">
      <div class="col-md-4">
        <h3 class="text-left">Listed Drugs</h3>
        <table class="table table-hover table-bordered services-table">
          <thead class="orange">
            <tr>
              <th  style="width:50px;">Medication</th>
              <th  style="width:50%">Unit</th>
            </tr>
          </thead>
          <tbody>
            <?php $x=0; foreach ($medications as $key) {  $class = ($x%2 == 0) ? 'green-light': 'green-lighter'; ?>
              <?php if((in_array("A", $plan_array)) || (in_array("B", $plan_array))) { if($key->plan_option == "diabetes") { ?>
                <tr <?php echo 'class="'.$class.'"'; ?>>

                  <td><?php echo $key->medication; ?></td>
                  <td><?php echo $key->units; ?></td>
               </tr>
             <?php }} ?>
              <?php if((in_array("C", $plan_array)  && ($key->plan_option == "hypertension"))) { ?>
                <tr <?php echo 'class="'.$class.'"'; ?>>
                  <td><?php echo $key->medication; ?></td>
                  <td><?php echo $key->units; ?></td>
               </tr>
              <?php } ?>
              <?php if((in_array("D", $plan_array)  && ($key->plan_option == "thyroid"))) { ?>
                <tr <?php echo 'class="'.$class.'"'; ?>>
                  <td><?php echo $key->medication; ?></td>
                  <td><?php echo $key->units; ?></td>
               </tr>
              <?php } ?>
            <?php $x++;} ?>
          </tbody>
        </table>
      </div>
      <div class="col-md-8">
        <h3 class="text-left"> Care Structure</h3>
        <table class="table table-hover table-bordered services-table">
          <thead class="orange">
            <tr>
              <th>COVERED SERVICES</th>
              <th>TIMES IN A YEAR</th>
              <?php if((in_array("A", $plan_array)) || (in_array("B", $plan_array))){ ?>
              <th style="width:20%">DIABETES TYPE1 (A) OR TYPE 2 (B)</th>
            <?php } ?>
            <?php if(in_array("C", $plan_array)){ ?>
              <th style="width:20%">HYPERTENSION (CARDIAC) (C)</th>
            <?php } ?>
            <?php if(in_array("D", $plan_array)){ ?>
              <th style="width:20%">THYROID DISEASE (D)</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php $x=0; foreach ($cs as $key) {  $class = ($x%2 == 0) ? 'green-light': 'green-lighter'; ?>
              <tr <?php echo 'class="'.$class.'"'; ?>>
                <td><?php echo $key->covered_services; ?></td>
                <td><?php echo $key->time ?></td>
              <?php if((in_array("A", $plan_array)) || (in_array("B", $plan_array))){ ?>
                <td <?php if($key->diabetes) echo "class='orange-light'"; ?>></td>
              <?php } ?>
              <?php if(in_array("C", $plan_array)){ ?>
                <td <?php if($key->hypertension) echo "class='orange-light'"; ?>></td>
                <?php } ?>
                <?php if(in_array("D", $plan_array)){ ?>
                <td <?php if($key->thyroid) echo "class='orange-light'"; ?>></td>
                <?php  } ?>
              </tr>
            <?php $x++; } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
