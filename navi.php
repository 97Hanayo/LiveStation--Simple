		<div class="mdui-appbar mdui-appbar-fixed mdui-theme-primary-pink">
			<div class="mdui-toolbar mdui-color-theme">
				<span class="mdui-btn mdui-btn-icon mdui-ripple" mdui-drawer="{target: '#main-drawer', swipe: true}" mdui-tooltip="{content: '直播中心'}">
					<i class="mdui-icon material-icons">menu</i>
				</span>
				<a href="index.php" class="mdui-typo-headline" mdui-tooltip="{content: '首页'}">Live—はな</a>
				<div class="mdui-toolbar-spacer"></div>
				<a href="javascript:location.reload();" class="mdui-btn mdui-btn-icon mdui-ripple" mdui-tooltip="{content: '刷新'}">
					<i class="mdui-icon material-icons">refresh</i>
				</a>
				<?php if(isset($_SESSION['username'])&&($_SESSION['username'])=='admin'){?>
				<a href="admin.php" class="mdui-btn mdui-btn-icon mdui-ripple" mdui-tooltip="{content: '控制台'}">
					<i class="mdui-icon material-icons" >settings</i>
				</a>
					<?php } ?>
				<?php if((isset($_SESSION['username']))&&$row['livestats']=='checked'){?>
				<a href="chat.php?name=<?php echo "".$_SESSION['username']."" ?>" class="mdui-btn mdui-btn-icon mdui-ripple" mdui-tooltip="{content: '独立聊天室'}" target="_blank">
					<i class="mdui-icon material-icons" >textsms</i>
				</a>
				<a href="room.php?name=<?php echo "".$_SESSION['username']."" ?>" class="mdui-btn mdui-btn-icon mdui-ripple" mdui-tooltip="{content: '我的直播间'}">
					<i class="mdui-icon material-icons" >home</i>
				</a>
		<?php		}?>
				<a href="personal.php" class="mdui-btn mdui-btn-icon mdui-ripple" mdui-tooltip="{content: '用户中心'}">
					<i class="mdui-icon material-icons" >account_circle</i>
				</a>
			</div>
		</div>
			
		<div class="mdui-drawer mdui-drawer-close" id="main-drawer">
				<ul class="mdui-list">
					<li class="mdui-list-item mdui-ripple">
							<i class="mdui-list-item-icon mdui-icon material-icons">games</i>
							<a href="index.php#net" class="mdui-list-item-content">网络游戏</a>
					</li>
					<li class="mdui-list-item mdui-ripple">
						<i class="mdui-list-item-icon mdui-icon material-icons">videogame_asset</i>
						<a href="index.php#self" class="mdui-list-item-content">单机游戏</a>
					</li>
					<li class="mdui-list-item mdui-ripple">
						<i class="mdui-list-item-icon mdui-icon material-icons">book</i>
						<a href="index.php#study" class="mdui-list-item-content">学习</a>
					</li>
					<li class="mdui-list-item mdui-ripple">
						<i class="mdui-list-item-icon mdui-icon material-icons">movie</i>
						<a href="index.php#movie" class="mdui-list-item-content">电影</a>
					</li>
					<li class="mdui-list-item mdui-ripple">
						<i class="mdui-list-item-icon mdui-icon material-icons">library_music</i>
						<a href="index.php#music" class="mdui-list-item-content">音乐</a>
					</li>
				</ul>
		</div>