
<div id="sidebar" class="sidebar sidebar-fixed sidebar-hover sidebar-h sidebar-white sidebar-top" data-swipe="true" data-backdrop="true" data-dismiss="true">
	<div class="sidebar-inner border-r-0 border-b-1 brc-secondary-l2 shadow-md">
		<div class="container container-plus px-0 d-flex flex-column flex-xl-row">
			
            <div class="flex-grow-1 d-xl-flex flex-xl-row ace-scroll" data-ace-scroll="{}">
				<!-- ace-scroll is not applied in desktop view, but it's used in mobile view -->
				<div class="sidebar-section">
					<div class="sidebar-section-item fadeable-below fadeable-center px-3">
						
						<div class="fadeinable sidebar-shortcuts-mini w-auto" role="button">
							<div>
								<div>
									<span class="btn btn-success p-0"></span><span class="btn btn-primary p-0"></span>
								</div>
								<div class="mt-n2">
									<span class="btn btn-warning p-0"></span><span class="btn btn-danger p-0"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<ul class="nav nav-spaced nav-active-sm has-active-border active-on-top">
					
					
					<li class="nav-item-caption">
						<span class="fadeable pl-3">MAIN</span>
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
						$sql="select menu_id,menu_title,menu_url,menu_type,menu_icon,menu_file,rec_order";
						$sql .=" from menu ";
						$sql .=" where 1=1 and status='1' ";
						//$sql.="where status not like '2' ";
						if(isset($_SESSION['username'])){
							switch($_SESSION['user_type_id']){
								case '1':
								//$sql .=" and menu_id in ('3','6','7','10','13','17','23')";
								break;
								case '2':
								$sql .=" and menu_id in ('28','24','25','26','27','8','9','19')";
								break;
								case '3':
								$sql .=" and menu_id in ('28','24','25','26','27','9','19')";
								break;				
							}
							}else{
							$sql .=" and menu_id in ('17','22') ";
						}
						$sql .=" order by rec_order ";
						//$_SESSION['xxx']=$sql;
						$query=$conn->prepare($sql);
						try{
							$query->execute();
							while($data=$query->fetch(PDO::FETCH_ASSOC)){
								switch($data['menu_type']){
									case '1':
									if($part['1']==$data['menu_url']){$ac=' active ';}else{$ac='';}
									echo "<li class='nav-item $ac'>";
									echo "<a href='$data[menu_url]/' class='nav-link'>";
									echo "<i class='nav-icon fa $data[menu_icon]'></i>";
									echo '<span class="nav-text fadeable">';
									if($_SESSION['user_type_id']=='1'){
										echo "<span>$data[menu_id] $data[menu_title]</span>";
										}else{
										echo "<span>$data[menu_title]</span>";
									}
									echo '</span>';
									echo '</a>';
									echo '<b class="sub-arrow"></b>';
									echo '</li>';
									break;
									case '3':
									if($part['1']==$data['menu_url']){$ac='active';}else{$ac='';}
									echo "<li class='nav-item $ac'>";
									echo "<a href='$data[menu_file]' class='nav-link' >";
									echo "<i class='nav-icon fa $data[menu_icon]'></i>";
									echo '<span class="nav-text fadeable">';
									if($_SESSION['user_type_id']=='1'){
										echo "<span>$data[menu_id] $data[menu_title]</span>";
										}else{
										echo "<span>$data[menu_title]</span>";
									}
									echo '</span>';
									echo '</a>';
									echo '<b class="sub-arrow"></b>';
									echo '</li>';
									break;
									default:
									if($part['1']==$data['menu_url']){$ac='active';}else{$ac='';}
									echo '<li class="nav-item">';
									echo '<a href="#" class="nav-link dropdown-toggle collapsed">';
									echo "<i class='nav-icon fa $data[menu_icon]'></i>";
									echo '<span class="nav-text fadeable">';
									if($_SESSION['user_type_id']==1){
										echo "<span>$data[menu_id] $data[menu_title]</span>";
										}else{
										echo "<span>$data[menu_title]</span>";								
									}
									echo '</span>';
									echo '<b class="caret fa fa-angle-left rt-n90"></b>';
									echo '</a>';
									echo '<div class="hideable submenu collapse">';
									echo '<ul class="submenu-inner">';
									$sql2="select menu2_id,menu2_title,menu2_url,rec_order,menu2_icon ";
									$sql2 .=" from menu2 ";
									$sql2 .=" where menu_id='$data[menu_id]' ";
									$sql.="and status not like '2' ";									
									switch($_SESSION['user_type_id']){
										case '1':
										//$sql2 .=" and menu2_id in ('1','2') ";
										break;
										case '2':
										$sql2 .=" and menu2_id in ('9','10','11','12','13') ";						
										break;
										case '3':
										$sql2 .=" and menu2_id in ('9','10','11','12','13') ";						
										break;						
										case '4':
										$sql2 .=" and menu2_id in ('9','10','11') ";						
										break;					
									}
									$sql2 .=" order by rec_order ";
									$query2=$conn->prepare($sql2);
									try{
										$query2->execute();
										if($query2->rowCount()>0){
											while($data2=$query2->fetch(PDO::FETCH_ASSOC)){
												if($part['2']==$data2['menu2_url']){$ac2=' active ';}else{$ac2='';}								
												echo "<li class='nav-item $ac2 '>";
												echo "<a href='$data[menu_url]/$data2[menu2_url]/' class='nav-link'>";
												echo '<span class="nav-text">';
												if($_SESSION['user_type_id']==1){
													echo "<span>$data2[menu2_id] $data2[menu2_title]</span>";
													}else{
													echo "<span>$data2[menu2_title]</span>";
												}
												echo '</span>';
												echo '</a>';
												echo '</li>';
											}
										}
										}catch(PDOException $er){
										echo 'Error :'.$er->getMessage();
									}
									echo '</ul>';
									break;
								}
							}
							}catch(PDOException $er){
							echo 'Error :'.$er->getMessage();
						}					
					?>
					
					
					
				</ul>
			</div>
			
            <div class="sidebar-section d-none d-xl-flex ml-xl-auto pl-xl-4">
				<!-- the logout and settings button, only shown in desktop view -->
				<div class="sidebar-section-item fadeable-below fadeable-center">
					<div class="fadeinable w-auto">
						<a href="change-password/" title="เปลี่ยนรหัสผ่าน" class="btn btn-outline-yellow btn-brc-tp radius-3px py-2">
							<i class="fa fa-key text-140"></i> 
						</a>
					</div>
				</div>
				<div class="sidebar-section-item fadeable-below fadeable-center">
					<div class="fadeinable w-auto">
						<a href="logout/" title="ออกจากระบบ" class="btn btn-outline-red btn-brc-tp radius-3px py-2">
							<i class="fa fa-power-off text-140"></i>
						</a>
					</div>
				</div>
			</div>
			
            <div class="sidebar-section d-xl-none ml-xl-auto">
				<!-- sidebar footer, only show in mobile view -->
				<div class="sidebar-section-item fadeable-left fadeable-top">
					<div id="sidebar-footer" class="fadeable text-center border-t-1 brc-secondary-l3 w-95">
						<div class="py-2">
							<a href="change-password/" title="เปลี่ยนรหัสผ่าน" class="btn btn-yellow btn-brc-tp radius-3px py-2">
								<i class="fa fa-key text-140"></i>
							</a>
							<a href="logout/" title="ออกจากระบบ" class="btn btn-red btn-brc-tp radius-3px py-2">
								<i class="fa fa-power-off text-140"></i>
							</a>						
						</div>
					</div>
				</div>
			</div>
			
		</div><!-- .container -->
	</div><!-- .sidebar-inner -->
</div>

