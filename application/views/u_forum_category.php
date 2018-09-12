<!DOCTYPE html>
<html dir="ltr" lang="en-gb"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link rel="alternate" type="application/atom+xml" title="Feed - Gramziu Themes" href="https://gramziu.pl/phpBB/feed.php">		<link rel="alternate" type="application/atom+xml" title="Feed - New Topics" href="https://gramziu.pl/phpBB/feed.php?mode=topics">
<!--[if IE]><link rel="shortcut icon" href="./styles/ariki/theme/images/favicon.ico"><![endif]-->
<link rel="apple-touch-icon-precomposed" href="https://gramziu.pl/phpBB/styles/ariki/theme/images/apple-touch-icon-precomposed.gif">
<link rel="icon" href="https://gramziu.pl/phpBB/styles/ariki/theme/images/favicon.gif">
<link rel="icon" sizes="16x16" href="https://gramziu.pl/phpBB/styles/ariki/theme/images/favicon.ico">
<link href="<?php echo base_url()?>files/css" rel="stylesheet" type="text/css" media="screen, projection">
<link href="<?php echo base_url()?>files/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen, projection">
<link href="<?php echo base_url()?>files/stylesheet.css" rel="stylesheet" type="text/css" media="screen, projection">
<link href="<?php echo base_url()?>files/colours.css" rel="stylesheet" type="text/css" media="screen, projection">
</head>
<body id="phpbb" class="notouch section-index ltr hasjs" style="">
<div id="overall-wrap">
	<a id="top" class="anchor" accesskey="t"></a>
	<div id="wrap-head">
		<div id="site-nav" role="navigation">
			<div class="chunk">
				<div class="site-nav">
                    <div id="site-search" role="search">
							<fieldset>
								<input name="keywords" type="Поиск" maxlength="128" title="Поиск" size="20" value="" placeholder="Поиск"><button type="submit" title="Поиск"></button><input type="hidden" name="style" value="3">
							</fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>
<div id="wrap-body">
	<div class="chunk">

<div id="forumlist">
<div id="forumlist-inner">

<div class="forabg">
			<div class="inner">
			<ul class="topiclist">
				<li class="header">
					<dl class="icon">
						<dt><div class="list-inner"><a href=""><?php echo $cats[0]['category_name']?></a></div></dt>
						<dd class="topics">Просмотры</dd>
						<dd class="posts">Комментарии</dd>
						<dd class="lastpost">Добавление</dd>
					</dl>
					
				</li>
			</ul>
            <?php foreach($themes as $zow){?>
			<ul class="topiclist forums">
                <li class="row">
                    <dl class="icon forum_read">
                        <dt title="No unread posts">
                            <div class="list-inner">
                                <a href="http://urist.kg/U_forum_index_control/theme/<?php echo $zow['id']?>" class="forumtitle"><?php echo $zow['theme_name']?></a>										
                                <div class="responsive-show" style="display: none;">
                                     <strong><?php echo $zow['theme_views']?></strong>
                                </div>
                            </div>
                        </dt>
                        <dd class="topics"><?php echo $zow['views']?></dd>
                        <dd class="posts"><?php echo $zow['comments']?></dd>
                        <dd class="lastpost">
                            <?php echo $zow['theme_date']?>				
                        </dd>
                    </dl>
                </li>
            </ul>
            <?php }?>
    </div>
</div>

	
<!--
<div class="stat-block online-list">
    <h3>Who is online</h3>						
    <p>
        In total there are <strong>3</strong> users online :: 0 registered, 0 hidden and 3 guests (based on users active over the past 5 minutes)<br>Most users ever online was <strong>51</strong> on 11 Apr 2017, 10:11<br> <br>Registered users: No registered users
        <br><em>Legend: <a style="color:#AA0000" href="https://gramziu.pl/phpBB/memberlist.php?style=3&amp;mode=group&amp;g=5">Administrators</a>, <a style="color:#00AA00" href="https://gramziu.pl/phpBB/memberlist.php?style=3&amp;mode=group&amp;g=4">Global moderators</a>, <span style="color:#9E8DA7">Bots</span>, <a href="https://gramziu.pl/phpBB/memberlist.php?style=3&amp;mode=group&amp;g=2">Registered users</a></em>				
    </p>
    <p id="online-list-stat">
        Total posts <strong>68</strong> • Total topics <strong>20</strong> • Total members <strong>9</strong> • Our newest member <strong><a href="https://gramziu.pl/phpBB/memberlist.php?style=3&amp;mode=viewprofile&amp;u=2995" class="username">Sample</a></strong>
    </p>
</div>				
-->
</div>
</div>
</div>
</div>
<div id="wrap-footer">
		<div id="site-footer-nav" role="navigation">
			<div class="chunk">
				<ul class="site-footer-nav" role="menubar">
					<li class="small-icon icon-home breadcrumbs">
                        <span class="crumb">Школа Права</span>
                    </li>
                </ul>
			</div>
		</div>
</div>
    
    
    
    
    
<script type="text/javascript" src="./Gramziu Themes - Index page_files/jquery.min.js.Без названия"></script>
<script type="text/javascript">window.jQuery || document.write('\x3Cscript src="./assets/javascript/jquery.min.js?assets_version=178">\x3C/script>');</script><script type="text/javascript" src="./Gramziu Themes - Index page_files/core.js.Без названия"></script>
<script>
	$(function() {
		$("#st, #sd, #sk, #ch").chosen({
			disable_search: true,
			width: "auto"
		});
	});
</script>

<script>
	$(function() {

		var sidebarRecentPostDiv = document.getElementById("sidebar-recent-posts");

		$.get('https://gramziu.pl/phpBB/feed.php', function (data) {
			$(data).find("entry").each(function (i) {
				var el = $(this);
				var entryWrap = document.createElement("div");

				var entryTitle = document.createElement("a");
				var entryAuthor = document.createElement("span");
				var entryContent = document.createElement("span");

				entryTitle.className = ("sidebar-recent-title");
				entryAuthor.className = ("sidebar-recent-author");
				entryContent.className = ("sidebar-recent-content");

				function cutText(name) {
					var elementText = el.find(name).text();

					if (name == "title") {
						elementText = elementText.substring(elementText.indexOf("•") + 2);
					} else if (name == "content") {
						elementText = elementText.replace(/(<([^>]+)>)/ig,"");
					}

					if (elementText.length > 50) {
						return elementText.substr(0, 50);
					} else {
						return elementText;	
					};
				};

				entryTitle.textContent = cutText("title");
				entryAuthor.textContent = "by " + cutText("author");
				entryContent.textContent = cutText("content");
				entryURL = el.find("id").text();

				$(entryTitle).attr("href", entryURL);

				entryWrap.appendChild(entryTitle);
				entryWrap.appendChild(entryAuthor);
				entryWrap.appendChild(entryContent);

				sidebarRecentPostDiv.appendChild(entryWrap);

				if (++i >= 5) {
					return false;
				}
			});
		});

	});
</script>
<script type="text/javascript" src="./Gramziu Themes - Index page_files/forum_fn.js.Без названия"></script>
<script type="text/javascript" src="./Gramziu Themes - Index page_files/ajax.js.Без названия"></script>
<script type="text/javascript" src="./Gramziu Themes - Index page_files/chosen.jquery.min.js.Без названия"></script>
</div>
</body>
</html>