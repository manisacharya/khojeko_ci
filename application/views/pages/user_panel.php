<div class="clearfix"></div>


<div class="status_of_account">
	<a><i class="fa fa-warning"></i> unverified ac</a>
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
	<a class="users_menu_item">Favourite (10)</a>
	<a class="users_menu_item">|</a>
	<a class="users_menu_item">Buyer ask</a>
	<a class="users_menu_item">|</a>
	<a class="users_menu_item">Offline Buyer Message (5)</a>
	<a class="users_menu_item">|</a>
	<a class="premium">Premium (Paid ads)</a>

</div><!--user_menu-->
<div class="clearfix"></div>

<div class="alert_message">
	<i class="fa fa-warning"></i>
	<a>Urgent Alert ! </a><a>Your account is temporary block due to report scam/anti money laundry.</a>
</div>

<div class="ad_count">
	<button style="background:#FF9"><a>Total<br> Ad</a><br><a class="number">16</a></button>
	<button style="background:#0CC"><a>Active<br> Ad</a><br><a class="number">16</a></button>
	<button style="background:#0C0"><a>Sold<br> Ad</a><br><a class="number">16</a></button>
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
			<?php foreach ($all_personal_items as $item): ?>
				<li>
					<div class="col-sm-2">
						<img src="<?php echo base_url('public/images/item_images/'.$item->image); ?>" alt="image" class="img-rounded">
					</div>
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
						<a href="#!"> <comment>8 comment</comment></a>
					</div>
					<div class="col-sm-2" style="font-size:14px">
						<extend>Extend for:30 days</extend><br>
						<expiry>Expiry: After 7 days</expiry><br>
						<a class="green" href="#!">Renew now</a>
					</div>
					<div class="col-sm-2" style="padding-left:15px;">
						<?php if($item->sales_status): ?>
							<a class="red" href="#!">Sold</a>
						<?php else: ?>
							<a class="green" href="#!">Unsold</a><br>
						<?php endif; ?>
					</div>
					<div class="col-sm-1">
						<a href="#!" class="red" title="delete"><i class="fa fa-trash-o"></i></a>
						<a href="#!" class="blue" title="edit"><i class="fa fa-edit"></i></a>
					</div>
					<div class="col-sm-1" style="padding-left:5px">
						<a class="red" href="#!">Active</a><br>
						<a href="#!">View Ad</a>
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