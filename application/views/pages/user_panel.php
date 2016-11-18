
<?php
// infos of user_info
$user_info_name = $user_info->name;
$user_info_zone = $user_info->zone;
$user_info_district = $user_info->district;
$user_info_city = $user_info->city;
$user_info_full_address = $user_info->full_address;
$user_info_mob = $user_info->primary_mob;
$user_info_tel_no = $user_info->tel_no;
$user_info_email = $user_info->email;
$user_info_user_name = $user_info->khojeko_username;
$dateFormat = 'Y-m-d';

?>

							<div class="clearfix"></div>

							<div class="display" >
								<div class="col-sm-6 col-xs-12" id="left">Top banner ads 1</div>
								<div class="col-sm-6 col-xs-12" id="right">
									<img src="<?php echo base_url('public');?>/images/image5.jpg">
								</div>
							</div>

							<div class="clearfix"></div>


							<div class="status_of_account">
								<a><i class="fa fa-warning"></i> unverified ac</a>
							</div>

							<div class="welcome_div">
								<a style="float:left;color:#00C;text-transform: capitalize;font-weight:bold;font-size:18px">Welcome, <?php echo $user_info_name?></a>
								<a>Your listing url:&nbsp;&nbsp;</a><a style="color:#00C;font-weight:bold">www.khojeko.com/<?php echo $user_info_user_name?></a>
								<a class="online_offline" href="#!" title="online/offline"><i class="fa fa-user"></i></a>
							</div>
							<div class="clearfix"></div>

							<div class="user_menu">
								<a href="#" class="users_menu_item">My Profile</a>
								<a href="#" class="users_menu_item">|</a>
								<a href="#" class="users_menu_item">My post ad</a>
								<a href="#" class="users_menu_item">|</a>
								<a href="#" class="users_menu_item">Self Buy</a>
								<a href="#" class="users_menu_item">|</a>
								<a href="#" class="users_menu_item">Favourite (10)</a>
								<a href="#" class="users_menu_item">|</a>
								<a href="#" class="users_menu_item">Buyer ask</a>
								<a href="#" class="users_menu_item">|</a>
								<a href="#" class="users_menu_item">Offline Buyer Message (5)</a>
								<a href="#" class="users_menu_item">|</a>
								<a href="#" class="premium">Premium (Paid ads)</a>

							</div><!--user_menu-->
							<div class="clearfix"></div>

							<div class="alert_message">
								<i class="fa fa-warning"></i>
								<a>Urgent Alert ! </a><a>Your account is temporary block due to report scam/anti money laundry.</a>
							</div>

							<div class="ad_count">
								<button style="background:#FF9"><a>Total<br> Ad</a><br><a class="number"><?php echo $this_user_item?></a></button>
								<button style="background:#0CC"><a>Active<br> Ad</a><br><a class="number"><?php echo $this_user_active_item?></a></button>
								<button style="background:#0C0"><a>Sold<br> Ad</a><br><a class="number"><?php echo $this_user_sold_item?></a></button>
								<button style="background:#069"><a>Expired<br> Ad</a><br><a class="number">16</a></button>
								<button style="background:#093"><a>Deleted<br> Ad</a><br><a class="number">16</a></button>
								<button style="background:#396"><a>Spam<br> Report</a><br><a class="number">16</a></button>
								<button style="background:#90F"><a>Alert<br> Message</a><br><a class="number">16</a></button>
								<button style="background:#0C9"><a>Admin<br> Message</a><br><a class="number">16</a></button>
							</div>
							<div class="owner_ad_display">
								<div class="all_ads_section">
									<a>Your Ads Details:</a>
									<a class="search_sec">
										<input type="text" placeholder="search your ads">
										<button><i class="fa fa-search"> </i> Search</button></a>
									</div><!--all_ads_section-->

									<div class="owner_detail_ad">
										<ol>
										<?php
											$date1 = date_create(date("Y-m-d"));

											foreach ($item as $oneitem) {

												if($oneitem->visibility) {
													$date = date($dateFormat, $oneitem->published_date);
													$date2 = date_create($date);
													$diff = date_diff($date1, $date2);
													echo '
												<li>
													<div class="col-sm-2">
														<img src="' . base_url('public') . '/images/item_images/' . $oneitem->image . '" alt="image" class="img-rounded">
													</div>
													<div class="col-sm-2">
														<price>Rs. ' . $oneitem->price . '</price><br>
														<name>' . $oneitem->title . '</name><br>
														<date>' . $date . '</date><br>
														<!--<time>12:00 am</time>-->
													</div>
													<div class="col-sm-2" style="font-size:14px">
														<running>Running: ' . $diff->format("%a") . ' days</running><br>
														<view>' . $oneitem->views . ' views</view><br>
														<a href="#!"> <comment>8 comment</comment></a>
													</div>
													<div class="col-sm-2" style="font-size:14px">
														<extend>Extend for:30 days</extend><br>
														<expiry>Expiry: After 7 days</expiry><br>
														<a class="green" href="#!">Renew now</a>
													</div>
													<div class="col-sm-2" style="padding-left:15px;">
														<a class="red" href="#!">Sold</a>
														<a class="green" href="#!">Unsold</a><br>
														<a class="red" href="#!">Hide</a>
														<a class="green" href="#!">Unhide</a>
													</div>
													<div class="col-sm-1">' .

														form_open('upanel/' . $user_name . '/' . $c_name, array('method' => 'get'))

														. '<label class="red" title="delete">
																<i class="fa fa-trash-o">
																	' . form_hidden('delete', $oneitem->item_id) .
														'<button type="submit">De</button>
																</i>
															</label>
														</form>' .

														form_open('upanel/' . $user_name . '/' . $c_name, array('method' => 'get'))
														. '<label class="blue" title="edit">
																<i class="fa fa-edit">
																	' . form_hidden('edit', $oneitem->item_id) .
														'<button type="submit">Ed</button>
																</i>
															</label>																
														</form>
													</div>
													<div class="col-sm-1" style="padding-left:5px">
														<a class="red" href="#!">Active</a><br>
														<a href="#!">View Ad</a>
													</div>
												</li>';
												}
											}
										?>

										</ol>
										<div class="col-sm-12" style="border-top:1px solid">
												<a href="#" class="green" style="float:left"><< Previous</a>
												<a href="#" class="green" style="float:right">Next >></a>
										</div>
									</div><!--owner_detail_ad-->
								</div><!--owner_ad_display-->
								

</div><!--guts-->
</div> <!--col-sm-9-->

</div>  <!--row ends-->