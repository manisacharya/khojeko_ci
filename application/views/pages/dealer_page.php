<div class="dealer_info">
	<div class="col-sm-9 dealer_details">
		<div class="col-sm-2 dealer_logo">
			<img src="<?php echo base_url('public/images/dealer_logos/'.$dealer_info->logo); ?>" class="img-rounded">
		</div>
		<div class="col-sm-10 dealer_all_info">
			<name><?php echo $dealer_info->name; ?></name>
			<?php if($dealer_info->u_verified): ?>
				<label style="color: green;">(Verified Account)</label>
			<?php else:?>
				<label style="color: red;">(Unverified Account)</label>
			<?php endif; ?>
			<br>
			<address1>New Baneshwor, BICC west gate</address1><br>
			<address2>Prime Bank Building,Ground Floor</address2><br>
			Tel:<number><?php echo $dealer_info->tel_no; ?></number><br>
			Mob:<mob><?php echo $dealer_info->primary_mob; ?></mob><br>
			URL:<email>www.khojeko.com/<?php echo $dealer_info->khojeko_username; ?></email><br>
			<p>Contact seller via email: <?php echo $dealer_info->email; ?></p>
		</div>
		<div class="col-sm-12 dealer_profile">
			<label>Profile: </label>
			<p><?php echo $dealer_info->detail; ?></p>
		</div>
	</div>

	<div class="col-sm-3 dealer_snap">
		<div class="media">
			<div class="pull-left">
				<?php foreach ($store_images as $key => $image): ?>
					<img src="<?php echo base_url('public/images/store_images/'. $image->si_name); ?>" class="img-rounded">
				<?php endforeach; ?>
			</div>
		</div>
	</div>

</div><!--dealerinfo ends-->
<div class="clearfix"></div>

<div class="listCon">
	<div id="viewcontrols" data-enhance="false">
        <a class="gridview" href="#!"><span class="glyphicon glyphicon-th"></span></a>
        <a class="listview" href="#!"><span class="glyphicon glyphicon-th-list"></span></a>
		<a class="info" onMouseOver="this.style.color='#ffffff'" onMouseOut="this.style.color='#ffffff'">Ad by This User</a>

		<a class="filter_dropdown">Filter By:</a>
		<select class="select">
			<option value="1">Mobile Phones</option>
			<option value="2">Nokia</option>
			<option value="3">Samsung</option>
			<option value="4">Lg</option>
			<option value="5">Tablets Pcs</option>
			<option value="6">Colors</option>
			<option value="7">Mobile Accesories</option>
			<option value="8">Mobile Accesories</option>
			<option value="9">Mobile Accesories</option>
		</select>

	</div>

	<ul class="list">
		<?php foreach ($all_dealer_items as $item): ?>
            <a href="<?php echo base_url('details/'.$item->item_id)?>">
            <li>
				<div class="col-sm-2" id="image_content">
					<img src="<?php echo base_url('public/images/item_images/'.$item->image);?>" class="img-responsive"/>
				</div>
				<div class="col-sm-10" id="info_content">
					<section class="list-right">
                    <span class="price">
                        <a class="button">
                            <?php
                                echo ($item->gg_parent) ? $item->gg_parent.' >> ' : '';
                                echo ($item->g_parent) ? $item->g_parent.' >> ' : '';
                                echo ($item->parent) ? $item->parent.' >> ' : '';
                                echo $item->category;
                            ?>
                        </a><br>
						<label style="float: right;">
                            <?php echo $item->views; ?>
                            <span class="glyphicon glyphicon-eye-open"></span>
                            <span class="glyphicon glyphicon-time"></span>
                            <span class="glyphicon glyphicon-heart"></span>
                            <span class="glyphicon glyphicon-comment"></span>
                        </label>
                    </span>
					</section>
					<section class="list-left">
						<span class="title">
							<b>Rs <?php echo $item->price; ?><label style="color:red;">&nbsp;(<?php echo $item->item_type; ?>)</label></b>
                            <?php if ($item->is_verified): ?>
                                <i class="fa fa-check-circle" id="tick"></i>
                            <?php endif; ?>
                            <br>
							<a class="sub" href="#"><?php echo $item->title; ?></a><br>
							<span class="address">
								<span><?php echo $item->full_address; ?></span>
								<span><?php echo date('Y-m-d', $item->published_date); ?></span>
							</span>
						</span>
						<p><?php echo $item->specs; ?></p>
					</section>
				</div>
			</li>
            </a>
		<?php endforeach;?>
	</ul>

</div><!--listcon ends-->
<div class="clearfix"></div>

</div><!--guts-->
</div> <!--col-sm-9-->
</div>  <!--row ends-->