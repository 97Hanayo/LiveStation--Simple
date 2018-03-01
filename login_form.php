					<form method="post" action="login.php">
					<div class="mdui-dialog" id="login">
    					<div class="mdui-textfield mdui-m-l-2 mdui-m-r-2">
  							<label class="mdui-textfield-label">用户名</label>
  							<input class="mdui-textfield-input" type="text" name="username" id="username">
						</div>
						<div class="mdui-textfield mdui-m-l-2 mdui-m-r-2">
  							<label class="mdui-textfield-label">密码</label>
  							<input class="mdui-textfield-input" type="password" name="password" id="password">
  						</div>
  							<label class="mdui-checkbox mdui-m-t-1 mdui-m-l-2">
  								<input type="checkbox" name="remember" id="remember">
  								<i class="mdui-checkbox-icon"></i>记住用户名
							</label>
						
    						<div class="mdui-dialog-actions">
      							<button class="mdui-btn mdui-ripple" type="button" onclick="location.href='forget.php'">忘记用户名或密码</button>
      							<button class="mdui-btn mdui-ripple" type="submit" name="submit" onclick="saveUserInfo()" id="log_Commit">登录</button>
    						</div>
  						</div>
					</div>
				</form>