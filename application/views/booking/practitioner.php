<div class="col-md-8 col-md-offset-2">
  <div class="f1">
    <div class="row">
      <div class="col-md-12">
        <h3>Select a practitioner</h3>
        <hr>
      </div>
    </div>
     <!-- List group -->
     <table class="table table-hover">
       <?php  foreach ($practitioner_obj['practitioners'] as $key => $value) { ?>
         <tr>
           <td class="col-md-12">
             <div class="inner-header">
               <b><?php echo $value['title']; ?> <?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></b>
              <p><small><i><?php echo $value['designation']; ?></i></small></p>
             </div>
             <div class="inner-controls"><a href="<?php echo base_url() ?>appointment/time/<?php echo $pid.'/'.$value['id'].'/'.$appointment_type; ?>" class="btn btn-success">Select</a></div>
           </td>
         </tr>
       <?php } ?>
     </table>
    </div>
</div>
