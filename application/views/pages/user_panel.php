<div class="clearfix"></div>


<div class="status_of_account">
	<?php if($personal_info->u_verified): ?>
		<label style="color: green;">Verified Account</label>
	<?php else:?>
		<label style="color: red;">Unverified Account</label>
	<?php endif; ?>
</div>

<div class="welcome_div">
	<a style="float:left">Welcome, <?php echo $personal_info->name; ?></a>
	<a>Your listing url:&nbsp;&nbsp;www.khojeko.com/<?php echo $personal_info->khojeko_username;?></a>
	<a class="online_offline" href="#!" title="online/offline"><i class="fa fa-user"></i></a>
</div>
<div class="clearfix"></div>

<div class="user_menu">
	<a class="users_menu_item">My Profile</a>
	<a class="users_menu_item">|</a>
	<a class="users_menu_item">My post ad</a>
	<a class="users_menu_item">|</a>
	<a class="users_menu_item">Self Buy</a>
	<a class="users_menu_item">|</a>
	<a class="users_menu_item">Favourite (<?php echo $total_favourited_items;?>)</a>
	<a class="users_menu_item">|</a>
	<a class="users_menu_item">Buyer ask</a>
	<a class="users_menu_item">|</a>
	<a class="users_menu_item">Offline Buyer Message (5)</a>
	<a class="users_menu_item">|</a>
	<a class="premium">Premium (Paid ads)</a>

</div><!--user_menu-->
<div class="clearfix"></div>

<!--<div class="alert_message">
		<i class="fa fa-warning"></i>
	<a>Urgent Alert ! </a><a>Your account is temporary block due to report scam/anti money laundry.</a>
</div>-->

<div class="ad_count">
	<button style="background:#FF9"><a>Total<br> Ad</a><br><a class="number"><?php echo $user_item_counts->total_items; ?></a></button>
	<button style="background:#0CC"><a>Active<br> Ad</a><br><a class="number"><?php echo $user_item_counts->active_items; ?></a></button>
	<button style="background:#0C0"><a>Sold<br> Ad</a><br><a class="number"><?php echo $user_item_counts->sold_items; ?></a></button>
	<button style="background:#069"><a>Expired<br> Ad</a><br><a class="number"><?php echo $user_item_counts->total_items; ?></a></button>
	<button style="background:#093"><a>Deleted<br> Ad</a><br><a class="number"><?php echo $user_item_counts->deleted_items; ?></a></button>
	<button style="background:#396"><a>Spam<br> Report</a><br><a class="number"><?php echo $user_item_counts->spam_reports; ?></a></button>
	<button style="background:#90F"><a>Alert<br> Message</a><br><a class="number"><?php echo $user_item_counts->total_items; ?></a></button>
	<button style="background:#0C9"><a>Admin<br> Message</a><br><a class="number"><?php echo $user_item_counts->total_items; ?></a></button>
</div>
<div class="owner_ad_display">
	<div class="all_ads_section">
		<a>Your Ads Details:</a>
		<a class="search_sec">
			<input type="text" placeholder="search your ads">
			<button><i class="fa fa-search"> </i> Search</button></a>
	</div><!--all_ads_section-->

	<div class="owner_detail_ad">
		<?php echo $message; ?>
		<ol>
			<?php foreach ($all_personal_items as $item): ?>
				<li>
					<a href="<?php echo base_url('details/'.$item->item_id); ?>">
						<div class="col-sm-2">
							<img src="<?php echo base_url('public/images/item_images/'.$item->image); ?>" alt="image" class="img-rounded">
						</div>
					</a>
					<div class="col-sm-2">
						<price>RS <?php echo $item->price; ?></price><br>
						<name><?php echo $item->title; ?></name><br>
						<?php $published_date = date('Y-m-d', $item->published_date);?>
						<date><?php echo $published_date; ?></date><br>
					</div>
					<div class="col-sm-2" style="font-size:14px">
						<?php
						$today_date = date_create(date("Y-m-d"));
						$published_date = date_create($published_date);
						$difference = date_diff($today_date, $published_date);
						?>
						<running>Running: <?php echo $difference->format("%a");?> days</running><br>
						<view><?php echo $item->views;?> views</view><br>
					</div>
					<div class="col-sm-2" style="font-size:14px">
						<?php $remaining = $item->ad_duration-$difference->format("%a"); ?>
						<?php if($remaining >= 0): ?>
							<expiry>Expiry: After <?php echo $remaining;?> days</expiry><br>
						<?php else: ?>
							<expiry style="color:red;">Expired</expiry><br>
							<a class="green" href="#!">Renew now</a>
						<?php endif; ?>
					</div>
					<div class="col-sm-2" style="padding-left:15px;">
						<?php if($item->sales_status): ?>
							<a class="green" href="#!">Unsold</a><br>
						<?php else: ?>
							<a class="red" href="#!">Sold</a>
						<?php endif; ?>
					</div>
					<div class="col-sm-1">
						<?php echo form_open('delete'); ?>
							<?php echo form_hidden('item_id', $item->item_id) ?>
							<button type="submit" class="delete"><i class="fa fa-trash-o"></i></button>
						<?php echo form_close(); ?>
						<?php echo form_open('edit'); ?>
							<?php echo form_hidden('item_id', $item->item_id) ?>
						<button type="submit" class="edit"><i class="fa fa-edit"></i></button>
						<?php echo form_close(); ?>
					</div>
					<div class="col-sm-1" style="padding-left:5px">
						<a class="red" href="#!">Active</a><br>
					</div>
				</li>
			<?php endforeach;?>
		</ol>

		<div class="col-sm-12">
			<div class="col-sm-5"></div>
			<div class="col-sm-7">
				<a class="green"><< Previous</a>
				<a class="green" style="float:right">Next >></a>
			</div>
		</div>
	</div><!--owner_detail_ad-->
</div><!--owner_ad_display-->
</div>
</div>
</div>