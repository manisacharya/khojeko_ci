
    <div class="col-sm-12">
    	<h3>Post Ad By Admin</h3>
        <div class="post_admin">
                <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle steps">1</a>
                            <p>Step 1</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle steps" disabled="disabled">2</a>
                            <p>Step 2</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle steps" disabled="disabled">3</a>
                            <p>Step 3</p>
                        </div>
                         <div class="stepwizard-step">
                            <a href="#step-4" type="button" class="btn btn-default btn-circle steps" disabled="disabled">4</a>
                            <p>Step 4</p>
                        </div>
                    </div>
                </div>
<form role="form">
    <div class="setup-content" id="step-1">
     <div class="form-group">
            <table>
                    <tr>
                             <h3> Step 1&nbsp;&nbsp;(Fill Details)</h3>
            
                    </tr>
                    
                    <tr>
                            <td>
                               <label class="control-label">*Ad Owner Name</label>
                            </td>
                            <td>
                               <input  maxlength="100" type="text" required  class="form-control" placeholder="Enter Owner Name"  />
                            </td>
                     </tr>
                     
                     <tr>
                            <td>
                                <label class="control-label">*Zone</label>
                            </td>
                            <td>
                                <input maxlength="15" type="text" required class="form-control" placeholder="Enter Zone" />
                            </td>
                      </tr>
                      
                      <tr>
                            <td>
                                <label class="control-label">*District</label>
                            </td>
                            <td>
                                <input maxlength="15" type="text" required class="form-control" placeholder="Enter District" />
                            </td>
                      </tr>
                      
                      <tr>
                            <td>
                                <label class="control-label">*Address</label>
                            </td>
                            <td>
                                <input maxlength="50" type="text" required class="form-control" placeholder="Enter Address" />
                            </td>
                      </tr>
                      <tr>
                            <td>
                                <label class="control-label">*Primary Mobile</label>
                            </td>
                            <td>
                                <input maxlength="15" type="text" required class="form-control" placeholder="Enter Primary Mobile" />
                            </td>
                      </tr>
                      <tr>
                            <td>
                                <label class="control-label">Secondary Mobile</label>
                            </td>
                            <td>
                                <input maxlength="15" type="text"  class="form-control" placeholder="Enter Secondary Mobile" />
                            </td>
                      </tr>
                      <tr>
                            <td>
                                <label class="control-label">Landline No.</label>
                            </td>
                            <td>
                                <input maxlength="15" type="text"  class="form-control" placeholder="Enter Landline No." />
                            </td>
                      </tr>
                      <tr>
                      		<td>
                            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                      		</td>
                      </tr>
                </table>
          
          </div>
    </div>
    <div class="setup-content" id="step-2">
            <div class="form-group">
                <h3> Step 2&nbsp;&nbsp;(Select category for ad posting)</h3>
                <ul class="category0">
    	<li>
        	<a href="#" value="load"><i class="fa fa-plus-circle plus0"></i><i class="fa fa-minus-circle minus0"></i> Mobile Phones and tablets</a>
            	<ul class="category1">
                	<li><a href="#" value="load"><i class="fa fa-plus-circle plus0"></i><i class="fa fa-minus-circle minus0"></i>Mobile Phones</a>
                    	<ul class="category2">
                        	<li><a href="#">Acer</a></li>
                            <li><a href="#" >Samsung</a></li>
                            <li><a href="#" >Nokia</a></li>
                            <li><a href="#" >Huawei</a></li>
                    	</ul>
                    </li>
                    <li><a href="#"><i class="fa fa-plus-circle plus0"></i><i class="fa fa-minus-circle minus0"></i>Tablets and pc</a>
                    	<ul class="category2">
                        	<li><a href="#">Acer</a></li>
                            <li><a href="#">Samsung</a></li>
                            <li><a href="#">Nokia</a></li>
                            <li><a href="#">Huawei</a></li>
                    	</ul>
                    
                    </li>
                </ul>
        </li>
        
    </ul>
    <ul class="category0">
    	<li>
        	<a href="#"> <i class="fa fa-plus-circle plus0"></i><i class="fa fa-minus-circle minus0"></i>Real States</a>
            	<ul class="category1">
                	<li><a href="#"><i class="fa fa-plus-circle plus0"></i><i class="fa fa-minus-circle minus0"></i>Land</a>
                    	<ul class="category2">
                        	<li><a href="#">Valley</a></li>
                            <li><a href="#">Outside valley</a></li>
                            <li><a href="#">Outside Country</a></li>
                    	</ul>
                    </li>
                    <li><a href="#"><i class="fa fa-plus-circle plus0"></i><i class="fa fa-minus-circle minus0"></i>Apartment</a>
                    	<ul class="category2">
                        	<li><a href="#">Valley</a></li>
                            <li><a href="#">Outside valley</a></li>
                            <li><a href="#">Outside Country</a></li>
                    	</ul>
                    
                    </li>
                </ul>
        </li>
        
    </ul>
      <div class="search_section">
                	<table>
                    	<tr>
                        	<td style="width:30%">
                            	To find best category quick search is here:
                            
                            </td>
                            <td style="width:50%">
                            	<input type="text" style="width:40%">
                                <button>Search</button>
                            </td>
                           
                        </tr>
                        <tr>
                        	<td>
                            	Suggested Category:
                            </td>
                            <td>
								<p id="demo"></p>
                            </td>
                        </tr>
                        
                    </table>
                </div><!--search_section ends-->
                <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
    </div>
    <div class="setup-content step-3" id="step-3">
            <div class="form-group">
                <h3> Step 3</h3>
               
					<strong>*Ad Title:</strong><br>
                    	<input type="text" class="sstep"  placeholder="Title of the product" required/><br /><br />
                        
                        
					<strong>*Short Decription:</strong><br>
                    	<input type="text" class="sstep" placeholder="Description of the product" required/><br /><br />
                        
                        
						<span class="ad_type">
							<strong>Ad Type:</strong><br />
                                  <input type="radio" name="type" id="used" value="Used" checked="checked">Used<br /> 
                                <input type="radio" name="type" id="new" value="Brand New">Brand New (For Dealer ad)<br /> 
                                <input type="radio" name="type" id="service" value="Service">Service Ad/ General Ad<br /> 
                                <input type="radio" name="type" id="event" value="Event">Event (Time Based)<br /> <br />
						</span>
                        
                        
                     <span id="bought_from">
                        <strong>Short Decription:</strong>
                            <span class="ad_type">
                                <strong>Bought From:</strong><br />
                                     <input type="radio" name="from" id="nepal" value="Nepal" checked="checked">Nepal<br /> 
                                     <input type="radio" name="from" id="abroad" value="Abroad">Abroad<br /> 
                                     <input type="text" placeholder="Type Country Name" id="country_name">
                            </span>
                        <br><br>          
                     </span>


					<span id="offer">	
                   		<strong>Offer Price:</strong><br>
                    		<input type="text" class="sstep"/>
                                <span >
                                    <a href="#!"><i class="fa fa-question-circle" id="popup1"></i></a>
                                    <a class="popuptext" id="myPopup1" >If it is Service or Advertisement ad leave box blank</a>
        
                                </span>
                             <br/><br/>
                    </span>
                    
                        
                    <span id="used_for">
						<strong>Used for days/month/year:</strong><br>
                    		<input type="text" class="sstep"/>
                                <span id="popup2">
                                    <a href="#!"><i class="fa fa-question-circle"></i></a>
                                       <a class="popuptext" id="myPopup2"> If service related ad (ignore it)</a>
                                 </span>
                           
                          <br /><br />
                    </span>
                    
                          
                    <span id="market_price">
						<strong>Market Price:</strong><br>
                			<input type="text" class="sstep" />
                                <a href="#!" id="popup3"><i class="fa fa-question-circle"  ></i></a>
                                <a class="popuptext" id="myPopup3">If you don't know indicative market price leave it blank.</a>
                       		 <br /><br />
                    </span>
					
                    
                    <span id="document_no">
                		<strong>(Identification no/Chasis no/Document no/IMEI no):</strong><br>
                   			 <input type="text" class="sstep"/>
                                    <a href="#!" id="popup4">
                                    <i class="fa fa-question-circle"  ></i></a>
                                    <a class="popuptext" id="myPopup4" >this is optional but if you mention ad id no. your ad is fully verified and trustful and may sold out quickly</a>
                       
                        <br /><br /> 
                    </span>
                        
                        
					<strong>Product or Service ad details/ full specification: ( submit with full specification and product details):</strong><br />
                    <input type="text" style="width:60%; height:100px;text-align:center" placeholder="TEXT EDITOR" />
                  <br /><br />
                  
                    
           			<strong>Please select your free ad running time</strong>   
                             <select>
                                  <option>7 days</option>
                                  <option>15 days</option>
                                  <option>30 days</option>
                                  <option>60 days</option>
                                  <option>90 days</option>
                            </select><br /><br />
            
            
					<strong>Own Web site url link:</strong><br>
            				<input type="text" class="sstep"/>
                                     <a href="#!" id="popup5"><i class="fa fa-question-circle"  ></i></a>
                                     <a class="popuptext" id="myPopup5">if not leave it blank.</a>
                 			<br /><br />
                 
                 
             		<span id="home_delivery">    
             				<strong>Home delivery facility:</strong><br>
                                    <input type="radio" name="delivery" id="yes" value="yes" checked="checked" />Yes<br>
                                    <input type="radio" name="delivery" id="no" value="No" />No<br /><br />
              		</span>
                    
                    
                   <div id="delivery"> 
                    		<strong>Delivery Charges:</strong><br>
                        	<input type="text" class="sstep"/>
                            <a href="#!" id="popup6"><i class="fa fa-question-circle"  ></i></a>
                            <a class="popuptext" id="myPopup6">if not leave it blank.</a><br /><br />
                   </div>


                    <span id="warranty">
                        	<strong>Warranty Time:</strong><br>
                            <input type="text" id="input" class="sstep"/>
                             <a href="#!" id="popup7"><i class="fa fa-question-circle"></i></a>
                             <a class="popuptext" id="myPopup7">if not leave it blank.</a><br /><br />
                    </span>
                    
                    
                <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
    </div>
    
    
    <div class="setup-content" id="step-4">
             <div class="form-group">

                		<h3> Step 4</h3>
                 		<strong> owner proof document:</strong><br />
                		<input type="checkbox" noneoption="false"/>Vat/Pan Bill<br />
						<input type="checkbox" noneoption="false"/>Product warranty card<br />
                        <input type="checkbox" noneoption="false"/>Product Paking Box<br />
                        <input type="checkbox" id="none" noneoption="true"/>Not any above<br /><br />
                 
                 
                        <span id="reason">
                                <strong>if not any above.<br />spcify specify reason</strong>
                                <input type="text" style="height:30px; width:160px" />
                        </span><br /><br />

            
                       <strong>Upload your images here.</strong> 
                       <h5 style="color:blue">First image will be displayed as primary.</h5>
                            <input type="file" multiple class="multi with-preview"/>
                        <hr />
             
                      
                        <strong>Upload Video Url ( From Youtube embade):<br /><br> Video 1. </strong>
                           		<input type="text" id="input"/>
                                <a href="#!" id="popup8"><i class="fa fa-question-circle"  ></i></a>
                                <a class="popuptext" id="myPopup8">if not leave it blank.</a><br />
                                
                        <strong>Video 2.</strong>
                            	<input type="text" id="input"/>
                                <a href="#!" id="popup9"><i class="fa fa-question-circle"  ></i></a>
                                <a class="popuptext" id="myPopup9">if not leave it blank.</a><br /><br>

                	
                <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                <button class="btn btn-success btn-lg pull-right" type="submit">Done!</button>
         </div>
      </div>
</form>
        </div><!--end of post_admin-->
    </div><!--col-sm-12-->
</section>