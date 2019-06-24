<div class="col-md-8 col-md-offset-2">
  <div class="f1">
    <div class="row">
      <div class="col-md-12">
        <h3>Select a service</h3>
        <p>All prices are the full amount including any taxes.</p>
        <hr>
      </div>
    </div>
    <div class="row">
     <div class="col-md-12">
      <!-- Default panel contents -->
      <!-- List group -->
      <table class="table table-hover">
        <?php  foreach ($service_obj as $key => $value) { ?>
        <tr >
          <!-- <div class="row"> -->
            <td class="col-md-12">
              <div class="inner-header"><b><?php echo $value['name']; ?></b></div>
              <div class="inner-controls"><div class="btn btn-default"><?php echo $value['duration_in_minutes']; ?> mins</div> <a href="<?php echo base_url() ?>appointment/practioner/<?php echo $pid; ?>/<?php echo $value['id']; ?>" class="btn btn-success">Select</a></div>
            </td>
          <!-- </div> -->
        </tr>
      <?php } ?>
    </table>
    </div>
  </div>
  </div>
</div>
