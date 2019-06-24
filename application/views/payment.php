<!-- Top content -->
       <div class="top-content">
           <div class="container">

              <div class="row">
                   <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 form-box">
                     <form role="form" action="" method="post" class="f1" data-package-ref="<?php echo $plan->reference; ?>" data-visit="<?php echo $visit; ?>">
                       <h4>You are about to make a payment for Wellingtons Care's <b class="font-green"><?php if(($visit!="")) echo $visit."</b> and <b class='font-green'>" ?>  <?php  echo $plan->plan_description; ?> </b>.
                       The total amount is <b class="font-orange"><?php echo to_money($total_amount); ?>/-</b></h4>


                       <div class="f1-steps">
                         <div class="f1-progress">
                             <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                         </div>
                         <div class="f1-step active">
                           <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                           <p>Details</p>
                         </div>
                         <div class="f1-step">
                           <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                           <p>Verification</p>
                         </div>
                           <div class="f1-step">
                           <div class="f1-step-icon"><i class="fa fa-twitter"></i></div>
                           <p>Finish</p>
                         </div>
                       </div>

                       <fieldset>
                        <h4>Tell us who you are:</h4>
                        <div class="form-group">
                           <label>Amount *</label><br>
                           <small class="error-field" id="error-amount"></small>
                           <input type="text" name="patient_id" id="id_amount" class="form-control" value="<?php echo $total_amount; ?>">
                           <small  class="form-text text-muted">This is the amount of money that will be deducted in your mobile money account</small>
                           <small  id="amountid_error"></small>

                         </div>
                          <div class="form-group">
                              <label>Mobile Money Number *</label><br>
                              <small class="error-field" id="error-phone"></small>
                              <div class="">
                              <div class="col-md-3">
                                <select name="countries" id="countries" class="form-control" name="code">
                                 <option value='256' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ug" data-title="Uganda">Uganda</option>
                                 <option value='254' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag ke" data-title="Kenya">Kenya</option>
                                 <option value='255' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag tz" data-title="Tanzania">Tanzania</option>
                               </select>
                              </div>
                              <div class="col-md-9">
                                  <!-- <input id="country_selector" type="text"class="pull-left" style="width:100px;"> -->
                                  <input type="text" name="phone_number" id="id_phone_number" class="form-control" size="10" >
                              </div>
                            </div>
                              <small  class="form-text text-muted">Phone number where the Mobile Money transaction will be conducted. The number format is 7xx....</small>

                            </div>


                             <div class="form-group">
                                <label>Patient ID (provide if registered)</label><br>
                                <input type="text" name="patient_id" id="id_patient_id" class="form-control">
                                <small  class="form-text text-muted">Clinics ID of the Patient</small>
                                <small  id="patientid_error"></small>
                              </div>
                              <div class="form-group  col-md-6">
                                <label  for="f1-first-name">First name *</label>
                                <small class="error-field" id="error-fname"></small>
                                <input type="text" name="f1-first-name"  class="f1-first-name form-control" id="id_first_name">
                                </div>
                               <div class="form-group col-md-6">
                                  <label >Last name * </label>
                                   <small class="error-field" id="error-lname"></small>
                                   <input type="text" name="f1-last-name"  class="f1-last-name form-control" id="id_last_name">
                               </div>
                               <div class="form-group col-md-6">
                                 <label>Patient Phone Number * </label>
                                 <small class="error-field" id="error-patient-phone"></small>
                                 <input type="text" name="patient_number" id="id_patient_number" class="form-control">
                                 <small id="patientPhoneNumberHelp" class="form-text text-muted">The phone number of the patient</small>
                               </div>
                               <div class="form-group col-md-6">
                                 <label>Email</label><br>
                                 <input type="text" name="email" id="id_patient_email" class="form-control">
                                 <small id="emailhelp" class="form-text text-muted">Email address of the patient</small>
                               </div>
                               <div class="">
                                <label>Care Advisor (optional)</label><br>
                                <select name="agent" name="agent_reference" id="id_agent_number" class="form-control">
                                  <option value="">------Select a Care Advisor------</option>
                                  <?php foreach ($agent as $value) { ?>
                                    <option value="<?php echo $value->name."|".$value->phone_number; ?>"><?php echo $value->name ?></option>
                                  <?php }  ?>
                                </select>
                                <small class="form-text text-muted">If an agent is present, please provide their Agent number</small>
                              </div>
                               <div class="f1-buttons">
                                   <button type="button" id="id_payment_request" class="btn btn-next">Next</button>
                               </div>
                           </fieldset>

                           <fieldset>
                               <h4>Verify the transaction:</h4>
                               <div class="form-group">
                                 <div class="confirm-mm">
                                   <p class="text-center"><img src="<?php echo base_url(); ?>assets/img/gif/wait.gif" width="50"></p>
                                   <p class="text-center">A transaction request has been made to the number given. Please enter pin to confirm</p>
                                 </div>
                               </div>
                               <div class="f1-buttons">
                                   <button type="button" class="btn btn-previous bck2start">Previous</button>
                                   <button type="button" class="btn btn-next bflst" >Next</button>
                               </div>
                           </fieldset>

                           <fieldset>
                               <h4>Transaction Complete</h4>
                               <div class="form-group lstfrm" data-ctid="">
                                 Welcome to the Wellington Family!
                                 Transaction has complete successfully. You are now a subscribed to the package.
                                 You now need to create and appointment.
                               </div>
                               <div class="f1-buttons">
                                   <button type="button" class="btn btn-previous">Previous</button>
                                   <!-- <a type="button" href="<?php echo base_url(); ?>appointment/service/" class="btn btn-submit">Creat Appointment</a> -->
                                   <button type="button" class="btn btn-submit lstbtn">Creat Appointment</a>
                               </div>
                           </fieldset>
                     </form>
                   </div>
               </div>

           </div>
       </div>
