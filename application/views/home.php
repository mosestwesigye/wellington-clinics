<section class="section-padding">
  <div class="container">
    <div class="row">
      <!-- Nav tabs -->
    <div class="col-md-6 col-md-offset-3">
     <ul class="nav nav-pills" role="tablist">
       <li role="presentation" class="active"><a href="#annual" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-default">Annual/Yearly</a></li>
       <li role="presentation"><a href="#six-months" aria-controls="profile" role="tab" data-toggle="tab" class="btn btn-default">Every 6 Months</a></li>
       <li role="presentation"><a href="#three-months" aria-controls="messages" role="tab" data-toggle="tab" class="btn btn-default">Every 3 Months</a></li>
       <li role="presentation"><a href="#monthly" aria-controls="settings" role="tab" data-toggle="tab" class="btn btn-default">Monthly</a></li>
     </ul>
   </div>
 </div>
      <!-- <div class="col-md-12 text-center">
        <h1 class="section-title red-heading">Icon Pricing Table</h1>
        <p>This is a very basic style pricing table with icons, made with less.</p>
      </div> -->
      <!-- Tab panes -->
      <div class="row">
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="annual">
          <div class="gg-pricing-table icon-table col-md-12 mt-50">
            <div class="row display-flex" style="padding: 10px 0;">
              <?php foreach ($object_list_y as $key) {  ?>
                <div class="col-md-3 col-sm-7 col-xs-12 pull-left price-tab">
                  <div class="single-pricing-table text-center clearfix">

                    <div class="pricing-table-heading">
                      <div class="pricing-icon">
                        <!-- <img src="assets/images/bicycle.png" alt="" class="center-block img-responsive"> -->
                      </div>
                      <h2><?php echo $key->plan_name; ?></h2>
                    </div>

                    <div class="price">
                      <span>UGX <?php echo to_money($key->amount); ?></span>
                    </div>
                    <hr>
                    <div class="pricing-item">

                      <ul>
                        <?php echo create_list($key->plan_description); ?>
                        <!-- <li><p>Diabetes Type1 (A)</p></li>
                        <li><p>Diabetes Type 2 (B)</p></li>
                        <li><p>Hypertension (Cardiac) (C)</p></li>
                        <li><p>Thyroid disease (D)</p></li> -->
                      </ul>
                    </div>

                    <div class="pricing-button">
                      <a href="<?php base_url(); ?>home/detail/<?php echo $key->reference ?>" class="btn btn-pricing"><i class="fa fa-check"></i> BUY NOW</a>
                      <!-- <a href="#" class="btn btn-pricing" onclick="openPopup('2,698,500', 'Annual Premium')"><i class="fa fa-check"></i> BUY NOW</a> -->
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="six-months">
          <div class="gg-pricing-table icon-table col-md-12 mt-50">
            <div class="row display-flex" style="padding: 10px 0;">
              <?php foreach ($object_list_b as $key) {  ?>
                <div class="col-md-3 col-sm-7 col-xs-12 pull-left price-tab">
                  <div class="single-pricing-table text-center clearfix">

                    <div class="pricing-table-heading">
                      <div class="pricing-icon">
                        <!-- <img src="assets/images/bicycle.png" alt="" class="center-block img-responsive"> -->
                      </div>
                      <h2><?php echo $key->plan_name; ?></h2>
                    </div>

                    <div class="price">
                      <span>UGX <?php echo to_money($key->amount); ?></span>
                    </div>
                    <hr>
                    <div class="pricing-item">

                      <ul>
                        <?php echo create_list($key->plan_description); ?>
                        <!-- <li><p>Diabetes Type1 (A)</p></li>
                        <li><p>Diabetes Type 2 (B)</p></li>
                        <li><p>Hypertension (Cardiac) (C)</p></li>
                        <li><p>Thyroid disease (D)</p></li> -->
                      </ul>
                    </div>

                    <div class="pricing-button">
                      <a href="<?php base_url(); ?>home/detail/<?php echo $key->reference ?>" class="btn btn-pricing"><i class="fa fa-check"></i> BUY NOW</a>

                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="three-months">
          <div class="gg-pricing-table icon-table col-md-12 mt-50">
            <div class="row display-flex" style="padding: 10px 0;">
              <?php foreach ($object_list_q as $key) {  ?>
                <div class="col-md-3 col-sm-7 col-xs-12 pull-left price-tab">
                  <div class="single-pricing-table text-center clearfix">

                    <div class="pricing-table-heading">
                      <div class="pricing-icon">
                        <!-- <img src="assets/images/bicycle.png" alt="" class="center-block img-responsive"> -->
                      </div>
                      <h2><?php echo $key->plan_name; ?></h2>
                    </div>

                    <div class="price">
                      <span>UGX <?php echo to_money($key->amount); ?></span>
                    </div>
                    <hr>
                    <div class="pricing-item">

                      <ul>
                        <?php echo create_list($key->plan_description); ?>
                        <!-- <li><p>Diabetes Type1 (A)</p></li>
                        <li><p>Diabetes Type 2 (B)</p></li>
                        <li><p>Hypertension (Cardiac) (C)</p></li>
                        <li><p>Thyroid disease (D)</p></li> -->
                      </ul>
                    </div>

                    <div class="pricing-button">
                      <a href="<?php base_url(); ?>home/detail/<?php echo $key->reference ?>" class="btn btn-pricing"><i class="fa fa-check"></i> BUY NOW</a>

                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="monthly">
          <div class="gg-pricing-table icon-table col-md-12 mt-50">
            <div class="row display-flex" style="padding: 10px 0;">
              <?php foreach ($object_list_m as $key) {  ?>
                <div class="col-md-3 col-sm-7 col-xs-12 pull-left price-tab">
                  <div class="single-pricing-table text-center clearfix">

                    <div class="pricing-table-heading">
                      <div class="pricing-icon">
                        <!-- <img src="assets/images/bicycle.png" alt="" class="center-block img-responsive"> -->
                      </div>
                      <h2><?php echo $key->plan_name; ?></h2>
                    </div>

                    <div class="price">
                      <span>UGX <?php echo to_money($key->amount); ?></span>
                    </div>
                    <hr>
                    <div class="pricing-item">

                      <ul>
                        <?php echo create_list($key->plan_description); ?>
                        <!-- <li><p>Diabetes Type1 (A)</p></li>
                        <li><p>Diabetes Type 2 (B)</p></li>
                        <li><p>Hypertension (Cardiac) (C)</p></li>
                        <li><p>Thyroid disease (D)</p></li> -->
                      </ul>
                    </div>

                    <div class="pricing-button">
                      <a href="<?php base_url(); ?>home/detail/<?php echo $key->reference ?>" class="btn btn-pricing"><i class="fa fa-check"></i> BUY NOW</a>

                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</section>
