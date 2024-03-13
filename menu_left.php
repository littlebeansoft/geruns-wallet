<div id="sidebar" class="sidebar sidebar-fixed expandable sidebar-light">
	<div class="sidebar-inner">

		<div class="ace-scroll flex-grow-1" data-ace-scroll="{}">

			<div class="sidebar-section my-2">
				<!-- the shortcut buttons -->
				<div class="sidebar-section-item fadeable-left">
					<div class="fadeinable sidebar-shortcuts-mini">
						<!-- show this small buttons when collapsed -->
						<span class="btn btn-success p-0 opacity-1"></span>
						<span class="btn btn-info p-0 opacity-1"></span>
						<span class="btn btn-orange p-0 opacity-1"></span>
						<span class="btn btn-danger p-0 opacity-1"></span>
					</div>

					<div class="fadeable">
						<!-- show this small buttons when not collapsed -->
						<div class="sub-arrow"></div>
						<div>
							<button class="btn px-25 py-2 text-95 btn-success opacity-1">
								<i class="fa fa-signal f-n-hover"></i>
							</button>

							<button class="btn px-25 py-2 text-95 btn-info opacity-1">
								<i class="fa fa-edit f-n-hover"></i>
							</button>

							<button class="btn px-25 py-2 text-95 btn-orange opacity-1">
								<i class="fa fa-users f-n-hover"></i>
							</button>

							<button class="btn px-25 py-2 text-95 btn-danger opacity-1">
								<i class="fa fa-cogs f-n-hover"></i>
							</button>
						</div>
					</div>
				</div>

				<?php /*
                <!-- the search box -->
                <div class="sidebar-section-item">
					<i class="fadeinable fa fa-search text-info-m1 mr-n1"></i>
					
					<div class="fadeable d-inline-flex align-items-center ml-3 ml-lg-0">
						<i class="fa fa-search mr-n3 text-info-m1"></i>
						<input type="text" class="sidebar-search-input pl-4 pr-3 mr-n2" maxlength="60" placeholder="Search ..." aria-label="Search" />
						<a href="#" class="ml-n25 px-2 py-1 radius-round bgc-h-secondary-l2 mb-2px">
							<i class="fa fa-microphone px-3px text-dark-tp5"></i>
						</a>
					</div>
				</div>*/ ?>
			</div>
			<hr>
			<ul class="nav has-active-border active-on-right">


				<li class="nav-item-caption">
					<span class="fadeable pl-3">Main Menu</span>
					<span class="fadeinable mt-n2 text-125">&hellip;</span>
					<!--
               			OR something like the following (with `.hideable` text)
					-->
					<!--
               			<div class="hideable">
						<span class="pl-3">MAIN</span>
               			</div>
               			<span class="fadeinable mt-n2 text-125">&hellip;</span>
					-->
				</li>
				<?php
				foreach ($menu as $key => $value) {
					echo "<li class='nav-item $ac'>";
					echo "<a href='$key/' class='nav-link'>";
					echo "<i class='nav-icon fa $value[icon]'></i>";
					echo '<span class="nav-text fadeable">';
					echo "<span>$value[title]</span>";
					echo '</span>';
					echo '</a>';
					echo '</li>';
				}
				/*
				$sql = "select menu_id,menu_title,menu_url,menu_type,menu_icon,menu_file,rec_order";
				$sql .= " from menu ";
				$sql .= " where 1=1 and status='1' ";
				//$sql.="where status not like '2' ";
				if (isset($_SESSION['username'])) {
					switch ($_SESSION['user_type_id']) {
						case '1':
							//$sql .=" and menu_id in ('3','6','7','10','13','17','23')";
							break;
						case '2':
							$sql .= " and menu_id in ('28','24','25','26','27','8','9','19')";
							break;
						case '3':
							$sql .= " and menu_id in ('28','24','25','26','9','19')";
							break;
					}
				} else {
					$sql .= " and menu_id in ('17','22') ";
				}
				$sql .= " order by rec_order ";
				//$_SESSION['xxx']=$sql;
				$query = $conn->prepare($sql);
				try {
					$query->execute();
					while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
						switch ($data['menu_type']) {
							case '1':
								if ($part['1'] == $data['menu_url']) {
									$ac = ' active ';
								} else {
									$ac = '';
								}
								echo "<li class='nav-item $ac'>";
								echo "<a href='$data[menu_url]/' class='nav-link'>";
								echo "<i class='nav-icon fa $data[menu_icon]'></i>";
								echo '<span class="nav-text fadeable">';
								if ($_SESSION['user_type_id'] == '1') {
									echo "<span>$data[menu_id] $data[menu_title]</span>";
								} else {
									echo "<span>$data[menu_title]</span>";
								}
								echo '</span>';
								echo '</a>';
								echo '<b class="sub-arrow"></b>';
								echo '</li>';
								break;
							case '3':
								if ($part['1'] == $data['menu_url']) {
									$ac = 'active';
								} else {
									$ac = '';
								}
								echo "<li class='nav-item $ac'>";
								echo "<a href='$data[menu_file]' class='nav-link' >";
								echo "<i class='nav-icon fa $data[menu_icon]'></i>";
								echo '<span class="nav-text fadeable">';
								if ($_SESSION['user_type_id'] == '1') {
									echo "<span>$data[menu_id] $data[menu_title]</span>";
								} else {
									echo "<span>$data[menu_title]</span>";
								}
								echo '</span>';
								echo '</a>';
								echo '<b class="sub-arrow"></b>';
								echo '</li>';
								break;
							default:
								if ($part['1'] == $data['menu_url']) {
									$ac = 'active';
								} else {
									$ac = '';
								}
								echo '<li class="nav-item">';
								echo '<a href="#" class="nav-link dropdown-toggle collapsed">';
								echo "<i class='nav-icon fa $data[menu_icon]'></i>";
								echo '<span class="nav-text fadeable">';
								echo "<span>$data[menu_id] $data[menu_title]</span>";
								echo '</span>';
								echo '<b class="caret fa fa-angle-left rt-n90"></b>';
								echo '</a>';
								echo '<div class="hideable submenu collapse">';
								echo '<ul class="submenu-inner">';
								$sql2 = "select menu2_id,menu2_title,menu2_url,rec_order,menu2_icon ";
								$sql2 .= " from menu2 ";
								$sql2 .= " where menu_id='$data[menu_id]' ";
								$sql .= "and status not like '2' ";
								/*switch($_SESSION['user_type_id']){
										case '1':
										$sql2 .=" and menu2_id in ('1','2') ";
										break;
										case '2':
										$sql2 .=" and menu2_id in ('15','22','50','44','114','61','98','110','104','105','106','107','108','109') ";						
										break;
										case '3':
										$sql2 .=" and menu2_id in ('114') ";						
										break;						
										case '4':
										$sql2 .=" and menu2_id in ('9','10','11') ";						
										break;					
									}
								$sql2 .= " order by rec_order ";
								$query2 = $conn->prepare($sql2);
								try {
									$query2->execute();
									if ($query2->rowCount() > 0) {
										while ($data2 = $query2->fetch(PDO::FETCH_ASSOC)) {
											if ($part['2'] == $data2['menu2_url']) {
												$ac2 = ' active ';
											} else {
												$ac2 = '';
											}
											echo "<li class='nav-item $ac2 '>";
											echo "<a href='$data[menu_url]/$data2[menu2_url]/' class='nav-link'>";
											echo '<span class="nav-text">';
											echo "<span>$data2[menu2_id] $data2[menu2_title]</span>";
											echo '</span>';
											echo '</a>';
											echo '</li>';
										}
									}
								} catch (PDOException $er) {
									echo 'Error :' . $er->getMessage();
								}
								echo '</ul>';
								break;
						}
					}
				} catch (PDOException $er) {
					echo 'Error :' . $er->getMessage();
				}*/
				?>

			</ul>

		</div><!-- /.sidebar scroll -->

		<?php if (isset($_SESSION['utitle'])) { ?>
			<div class="sidebar-section">
				<div class="sidebar-section-item fadeable-bottom">
					<div class="fadeinable">
						<!-- shows this when collapsed -->
						<div class="pos-rel">
							<img alt="Alexa's Photo" src="assets/image/avatar/avatar3.jpg" width="42" class="px-1px radius-round mx-2 border-2 brc-default-m2" />
							<span class="bgc-success radius-round border-2 brc-white p-1 position-tr mr-1 mt-2px"></span>
						</div>
					</div>

					<div class="fadeable hideable w-100 bg-transparent shadow-none border-0">
						<!-- shows this when full-width -->
						<div id="sidebar-footer-bg" class="d-flex align-items-center bgc-white shadow-sm mx-2 mt-2px py-2 radius-t-1 border-x-1 border-t-2 brc-primary-m3">
							<div class="d-flex mr-auto py-1">
								<div class="pos-rel">
									<img alt="Alexa's Photo" src="assets/image/avatar/avatar3.jpg" width="42" class="px-1px radius-round mx-2 border-2 brc-default-m2" />
									<span class="bgc-success radius-round border-2 brc-white p-1 position-tr mr-1 mt-2px"></span>
								</div>

								<div>
									<span class="text-blue-d1 font-bolder"><?php echo $_SESSION['FirstName']; ?></span>
									<div class="text-80 text-grey">
										<?php echo $_SESSION['utitle']; ?>
									</div>
								</div>
							</div>
							<a href="<?php echo $web['domain']; ?>logout/" class="d-style btn btn-outline-orange btn-h-light-orange btn-a-light-orange border-0 p-2 mr-1" title="Logout">
								<i class="fa fa-sign-out-alt text-150 text-orange-d2 f-n-hover"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

	</div>
</div>