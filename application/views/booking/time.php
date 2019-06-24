<div class="col-md-8 col-md-offset-2">
  <div class="f1">
    <div class="row">
      <div class="col-md-12">
        <h3>Select a time with <?php  echo $the_practn; ?></h3>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 cldappt" data-pid="<?php echo $pid; ?>">
        <div id='calendar'>
          <div class="loading-calender">
            <img src="<?php echo base_url(); ?>assets/img/gif/wait.gif" alt="">
            <p>Loading Calender. Please wait.
          </div>
        </div>
      </div>
      <div class="col-md-4 time" data-practitioner-id="<?php echo $practitioners; ?>" data-appointment_types-id="<?php echo $appointment_types; ?>">
        <h4 id="selected-date">Date: </h4>
        <h3>Available Time</h3>
        <div class="loading-time">
          <img src="<?php echo base_url(); ?>assets/img/gif/wait.gif" alt="" style="width: 200px;">
          <p>Loading Time. Please wait.
        </div>
        <div class="avtime">

        </div>

      </div>
    </div>
  </div>
</div>
