<?php
// infos of dealer
$dealer_logo_location = $dealer->logo;
$dealer_name = $dealer->name;
$dealer_address = $dealer->full_address;
$dealer_tel_no = $dealer->tel_no;
$dealer_mob = $dealer->primary_mob;
$dealer_website = $dealer->company_website;
$dealer_email = $dealer->email;
$dealer_detail = $dealer->detail;
$dealer_username = $dealer->khojeko_username;
$dateFormat = 'Y-m-d';
?>

						<div class="dealer_info">
                        
							<div class="col-sm-8 dealer_details">
								
                                <div class="col-sm-3 dealer_logo">
									<img src="<?php echo base_url().'public/images/dealer_logos/'.$dealer_logo_location;?>" class="img-rounded">
								</div><!--col-sm-2 dealer_logo-->
                                
								<div class="col-sm-9 dealer_all_info">
                                
									<name><?php echo $dealer_name;?></name><br>
									<address1><?php echo $dealer_address;?></address1><br>
									Telephone : <number><?php echo $dealer_tel_no;?></number><br>
									Mobile no. : <mob><?php echo $dealer_mob;?></mob><br>
									URL: <email><?php echo $dealer_website;?></email><br>
									<p>Contact seller via email : <?php echo $dealer_email;?></p>
                                    
								</div><!--col-sm-10 dealer_all_info-->
                                
								<div class="col-sm-12 dealer_profile">
									Profile:
									<p><?php echo $dealer_detail;?></p>
								</div><!--col-sm-12 dealer_profile-->
                                
							</div><!--col-sm-9 dealer_details-->

							<div class="col-sm-4 dealer_snap">
								<?php
									// load store images only
									$count = 0;
									foreach($store_images as $img) {

										if($dealer->d_id == $img->d_id) {
											if($count == 0) {
												echo '
											<div class="media">
												<div class="pull-left">';
											}
											echo '
												<img src="'.base_url().'public/images/store_images/'.$img->si_name.'" class="img-rounded"/>';
											$count++;     // store picture count

											if($count == 2) {
												echo '
												</div>
											</div>';
											}
											$count = $count%2;
										}
									}
									if($count == 1) {
										echo '
												</div>
											</div>';
									}
								?>
							</div><!--col-sm-3 dealer_snap-->
					</div><!--dealerinfo ends-->
					<div class="clearfix"></div>

					<div class="listCon">
						<div id="viewcontrols" data-enhance="false">

							<a class="gridview" href="#!"><i class="fa fa-th fa-2x" ></i></a>
							<a class="listview" href="#!"><i class="fa fa-list fa-2x"></i></a>
							<a class="info" >Mobile Phones  >>>></a>

							<a class="filter_dropdown">Filter By:</a>
							<select class="select">
								<option value="1">Mobile Phones</option>
								<option value="2">Nokia</option>
								<option value="3">Samsung</option>
								<option value="4">Lg</option>
								<option value="5">Tablets Pcs</option>
								<option value="6">Colors</option>
								<option value="7">Mobile Accesories</option>
							</select>

						</div>

						<ul class="list">
		<?php
		foreach($item as $a) {
			echo '
	<li>
		<div class="col-sm-2" id="image_content">';
				if($a->primary==1) {
					echo '
						<a href="'.base_url().'details/'.$a->item_id.'"><img src = "'.base_url().'public/images/item_images/'.$a->image.'" class="img-responsive" /></a>';
					};
				echo '
		</div>
		<div class="col-sm-10" id="info_content">
			<section class="list-right">
				<span class="price">
					<a class="button">'.$a->c_name.' >> '.$a->c_name.'</a><br>
					'.$a->views.' <i class="fa fa-eye" ></i>
					<i class="fa fa-clock-o" ></i>
					<i class="fa fa-heart" ></i>
					<i class="fa fa-comment-o"></i>
				</span>
			</section>
			<section class="list-left">
				<span class="title">
					<b>Rs. '.$a->price.'<font color="red">&nbsp;('.$a->item_type.')</font></b><br>
					<a class="sub" href="!#">'.$a->title.'</a><br>
					<span class="name">
						<i class="fa fa-check-circle" id="tick"></i><b>&nbsp;Ad by:'.$dealer->name.'</b>
					</span>
					<span class="address">
						<span>'.$dealer->full_address.'</span> <span>'.date($dateFormat, $a->published_date).'</span>
					</span>
				</span>
				<p>'.$a->specs.'</p>
			</section>
		</div>
	</li>
	';
		}
?>

</ul>

</div><!--listcon ends-->
<div class="clearfix"></div>

</div><!--guts-->
</div> <!--col-sm-9-->
</div>  <!--row ends-->