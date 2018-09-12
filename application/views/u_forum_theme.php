<!DOCTYPE html>
<!-- saved from url=(0054)https://gramziu.pl/phpBB/viewtopic.php?style=3&f=3&t=3 -->
<html dir="ltr" lang="en-gb"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title></title>

	<link rel="alternate" type="application/atom+xml" title="Feed - Gramziu Themes" href="https://gramziu.pl/phpBB/feed.php">			<link rel="alternate" type="application/atom+xml" title="Feed - New Topics" href="https://gramziu.pl/phpBB/feed.php?mode=topics">		<link rel="alternate" type="application/atom+xml" title="Feed - Forum - General examples" href="https://gramziu.pl/phpBB/feed.php?f=3">	<link rel="alternate" type="application/atom+xml" title="Feed - Topic - Basic poll" href="https://gramziu.pl/phpBB/feed.php?f=3&amp;t=3">
	

<!--[if IE]><link rel="shortcut icon" href="./styles/ariki/theme/images/favicon.ico"><![endif]-->
<link rel="apple-touch-icon-precomposed" href="https://gramziu.pl/phpBB/styles/ariki/theme/images/apple-touch-icon-precomposed.gif">
<link rel="icon" href="https://gramziu.pl/phpBB/styles/ariki/theme/images/favicon.gif">
<link rel="icon" sizes="16x16" href="https://gramziu.pl/phpBB/styles/ariki/theme/images/favicon.ico">

<link rel="canonical" href="https://gramziu.pl/phpBB/viewtopic.php?style=3&amp;t=3">


<link href="<?php echo base_url()?>files/css" rel="stylesheet" type="text/css" media="screen, projection">
<link href="<?php echo base_url()?>files/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen, projection">

<link href="<?php echo base_url()?>files/stylesheet.css" rel="stylesheet" type="text/css" media="screen, projection">
<link href="<?php echo base_url()?>files/colours.css" rel="stylesheet" type="text/css" media="screen, projection">
	





</head>
<body id="phpbb" class="notouch section-viewtopic ltr hasjs" style="">


<div id="overall-wrap">
	<div id="wrap-head">


		<div id="site-nav" role="navigation">
			<div class="chunk">

				
				<div class="site-nav">

					
										<div id="site-search" role="search">
							<fieldset>
								<input name="keywords" type="search" maxlength="128" title="Search for keywords" size="20" value="" placeholder="Search"><button type="submit" title="Search"></button><input type="hidden" name="style" value="3">

							</fieldset>
					</div>
					

				</div>
			</div>
		</div>
	</div>

	
	<a id="start_here" class="anchor"></a>
		
		


<div id="wrap-body">
	<div class="chunk">
        <div class="panel">
            <div class="inner">
                <div class="content">
                    <h2 class="poll-title"><?php echo $theme[0]['theme_name']?></h2>
                       <div class="content"><?php echo $theme[0]['theme_desc']?></div>
                    <div class="vote-submitted hidden">Your vote has been cast.</div>
                </div>
            </div>
        </div>
        
        <?php foreach($comments as $row){ ?>
        <div id="p3" class="post has-profile bg2">
            <div class="inner">
                <dl class="postprofile" id="profile3">
                    <dt class="has-profile-rank has-avatar">
                        <a href="https://gramziu.pl/phpBB/memberlist.php?style=3&amp;mode=viewprofile&amp;u=2" style="color: #AA0000;" class="username-coloured"><?php echo $row['user_name']?></a>
                    </dt>
                    <dd class="profile-rank"><?php echo $row['user_email']?></dd>
                </dl>
                <div class="postbody">
                    <div id="post_content3">
                        <div class="content"><?php echo $row['comment_text']?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
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
<script type="text/javascript" src="./Basic poll - Gramziu Themes_files/jquery.min.js.Без названия"></script>
<script type="text/javascript">window.jQuery || document.write('\x3Cscript src="./assets/javascript/jquery.min.js?assets_version=178">\x3C/script>');</script><script type="text/javascript" src="./Basic poll - Gramziu Themes_files/core.js.Без названия"></script>

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


<script type="text/javascript" src="./Basic poll - Gramziu Themes_files/forum_fn.js.Без названия"></script>

<script type="text/javascript" src="./Basic poll - Gramziu Themes_files/ajax.js.Без названия"></script>

<script type="text/javascript" src="./Basic poll - Gramziu Themes_files/chosen.jquery.min.js.Без названия"></script>




</div>



</body></html>