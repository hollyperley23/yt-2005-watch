<?php
// watch.php for watching videos
include("includes/youtubei/createRequest.php");
if (!isset($_GET['v'])) {
    echo "Please provide a valid video id";
} else {
    $id = $_GET['v'];
    // request player :hsuk:
    $response_object = requestPlayer($id);

    $mainResponseObject = json_decode($response_object);
    //print_r($mainResponseObject);
    $videoDetails = array(
        "videoTitle" => $mainResponseObject->videoDetails->title,

        "videoDescription" => "<span class='redtext' style='color: red'><i>No description</i></span>",
        // "videoTags" => array(
        // $mainResponseObject->keywords
        // ),
        "videoLengthInSeconds" => $mainResponseObject->videoDetails->lengthSeconds,
        "videoViews" => $mainResponseObject->videoDetails->viewCount,
        "videoAuthor" => $mainResponseObject->microformat->playerMicroformatRenderer->ownerChannelName,
        "videoUploadDate" => $mainResponseObject->microformat->playerMicroformatRenderer->uploadDate
    );

    // get video tags(annoying)
    if (isset($mainResponseObject->videoDetails->keywords)) {
        $tagarr = $mainResponseObject->videoDetails->keywords;
        $tagcount = sizeof($tagarr);
        if ($tagcount >= 1) {
            $tags = $tagarr;
        } else {
            $tags = array("None");
        }
    } else {
        $tagcount = 0;
    }
    if (isset($mainResponseObject->microformat->playerMicroformatRenderer->description->simpleText)) {
        $videoDetails['videoDescription'] = $mainResponseObject->microformat->playerMicroformatRenderer->description->simpleText;
    }


    // video source file
    $videoSrc = $mainResponseObject->streamingData->formats[0]->url;


?>
    <!DOCTYPE html>
    <html lang="en" data-cast-api-enabled="false">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>YouTube - Your Digital Video Repository</title>
        <script type="text/javascript" src="yts/jsbin/flashobject.js"></script>
        <link rel="icon" href="yts/imgbin/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="yts/imgbin/favicon.ico" type="image/x-icon">
        <link href="yts/cssbin/styles.css" rel="stylesheet" type="text/css">
        <link rel="alternate" type="application/rss+xml" title="YouTube " "="" recently="" added="" videos="" [rss]"="" href="http://www.youtube.com/rss/global/recently_added.rss">
    </head>


    <body class="meta-viewport-enabled year-2005 backend-api-youtubei">

        <table width="800" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
                <tr>
                    <td style="padding-bottom: 25px;" bgcolor="#FFFFFF">


                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr valign="top">
                                    <td rowspan="2" style="padding: 0px 5px 5px 5px;" width="130"><a href="index.php"><img src="yts/imgbin/logo_sm.gif" alt="YouTube" width="120" height="48" border="0"></a></td>
                                    <td valign="top">

                                        <table width="670" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr valign="top">
                                                    <td style="padding: 0px 5px 0px 5px; font-style: italic;">Upload, tag and share your videos worldwide!</td>
                                                    <td align="right">
                                                        <table cellspacing="0" cellpadding="0" border="0">
                                                            <tbody>
                                                                <tr>

                                                                    <td><a href="signup.php" class="bold">Sign Up</a></td>
                                                                    <td>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
                                                                    <td><a href="login.php">Log In</a></td>
                                                                    <td>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
                                                                    <td style="padding-right: 5px;"><a href="help.php">Help</a></td>


                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="100%">

                                        <div style="font-size: 12px; font-weight: bold; float: right; padding: 10px 5px 0px 5px;"><a href="my_videos_upload.php">Upload</a> &nbsp;//&nbsp; <a href="browse.php">Browse</a> &nbsp;//&nbsp; <a href="my_friends_invite.php">Invite</a></div>

                                        <table cellspacing="0" cellpadding="2" border="0">
                                            <tbody>
                                                <tr>
                                                    <form method="GET" action="results.php">
                                                        <td>
                                                            <input type="text" value="" name="search" size="30" maxlength="128" style="color:#ff3333; font-size: 14px; padding: 2px;">
                                                        </td>
                                                        <td>
                                                            <input type="submit" value="Search Videos">
                                                        </td>
                                                    </form>

                                                </tr>
                                            </tbody>
                                        </table>

                                    </td>
                                </tr>


                            </tbody>
                        </table>

                        <table style="margin: 5px 0px 10px 0px;" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#D5E5F5" align="center">
                            <tbody>
                                <tr>
                                    <td><img src="yts/imgbin/box_login_tl.gif" width="5" height="5"></td>
                                    <td><img src="yts/imgbin/pixel.gif" width="1" height="5"></td>
                                    <td><img src="yts/imgbin/box_login_tr.gif" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="yts/imgbin/pixel.gif" width="5" height="1"></td>

                                    <td width="100%">

                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table cellspacing="0" cellpadding="2" border="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td>&nbsp;<a href="index.php">Home</a></td>
                                                                    <td>&nbsp;|&nbsp;</td>
                                                                    <td><a href="my_videos.php">My Videos</a></td>
                                                                    <td>&nbsp;|&nbsp;</td>
                                                                    <td><a href="my_favorites.php">My Favorites</a></td>
                                                                    <td>&nbsp;|&nbsp;</td>
                                                                    <td><a href="my_friends.php">My Friends</a>&nbsp;<img src="yts/imgbin/new.gif"></td>
                                                                    <td>&nbsp;|&nbsp;</td>
                                                                    <td><a href="my_profile.php">My Profile</a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </td>

                                    <td><img src="yts/imgbin/pixel.gif" width="5" height="1"></td>
                                </tr>
                                <tr>
                                    <td><img src="yts/imgbin/box_login_bl.gif" width="5" height="5"></td>
                                    <td><img src="yts/imgbin/pixel.gif" width="1" height="5"></td>
                                    <td><img src="yts/imgbin/box_login_br.gif" width="5" height="5"></td>
                                </tr>
                            </tbody>
                        </table>

                        <div style="padding: 0px 5px 0px 5px;">


                            <iframe id="invisible" name="invisible" src="" scrolling="yes" marginheight="0" marginwidth="0" width="0" height="0" frameborder="0"></iframe>

                            <script>
                                function CheckLogin() {

                                    alert("You must be logged in to to perform this action!");
                                    return false;


                                    return true;
                                }

                                function FavoritesHandler() {
                                    if (CheckLogin() == false)
                                        return false;

                                    alert("Video has been added to Favorites!");
                                    return true;
                                }

                                function CommentHandler() {
                                    if (CheckLogin() == false)
                                        return false;

                                    var comment = document.comment_form.comment;
                                    var comment_button = document.comment_form.comment_button;

                                    if (comment.value.length == 0 || comment.value == null) {
                                        alert("You must enter a comment!");
                                        comment.focus();
                                        return false;
                                    }

                                    if (comment.value.length > 500) {
                                        alert("Your comment must be shorter than 500 characters!");
                                        comment.focus();
                                        return false;
                                    }

                                    comment_button.disabled = 'true';
                                    comment_button.value = 'Thanks for your comment!';

                                    return true;
                                }
                            </script>

                            <table width="795" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody>
                                    <tr valign="top">
                                        <td style="padding-right: 15px;" width="515">

                                            <div class="tableSubTitle"><?php echo $videoDetails["videoTitle"]; ?></div>
                                            <div style="font-size: 13px; font-weight: bold; text-align:center;">
                                                <a href="mailto:?subject=<?php echo $videoDetails["videoTitle"]; ?>&body=http://www.youtube.com/?v=vy8evhya_9E">Share</a>
                                                // <a href="#comment">Comment</a>
                                                // <a href="add_favorites.php?video_id=vy8evhya_9E" target="invisible" onclick="return FavoritesHandler();">Add to Favorites</a>
                                                // <a href="outbox.php?user=<?php echo $videoDetails["videoAuthor"]; ?>&subject=Re: <?php echo $videoDetails['videoTitle']; ?>1">Contact Me</a>
                                            </div>

                                            <div style="text-align: center; padding-bottom: 10px;">
                                                <div id="flashcontent">
                                                    <video controls src="<?php echo $videoSrc; ?>" class="video-player googlevideo-player" style="width: 427px; margin:center;">
                                                </div>
                                            </div>

                                            <script type="text/javascript">
                                                // <![CDATA[
                                                // wtf is this flashobject thing :womit:
                                                var fo = new FlashObject("player.swf?video_id=vy8evhya_9E&l=30", "player", "425", "350", 7, "#FFFFFF");
                                                fo.write("flashcontent");

                                                // ]]>
                                            </script>

                                            <table width="425" cellspacing="0" cellpadding="0" border="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="watchDescription"><?php echo $videoDetails["videoDescription"]; ?><div class="watchAdded" style="margin-top: 5px;">
                                                                </div>
                                                            </div>
                                                            <div class="watchTags">Tags //
                                                                <?php
                                                                for ($i = 0; $i < $tagcount; $i++) { ?>
                                                                    <a href="results.php?search=<?php echo $tags[$i]; ?>"><?php echo $tags[$i]; ?></a> :
                                                                <?php } ?>
                                                            </div>


                                                            <div class="watchAdded">
                                                                Added: <?php echo $videoDetails["videoUploadDate"]; ?> by <a href="profile.php?user=<?php echo $videoDetails["videoAuthor"]; ?>"><?php echo $videoDetails["videoAuthor"]; ?></a> //
                                                                <a href="profile_videos.php?user=<?php echo $videoDetails["videoAuthor"]; ?>">Videos</a> (64) | <a href="profile_favorites.php?user=<?php echo $videoDetails["videoAuthor"]; ?>">Favorites</a> (0) | <a href="profile_friends.php?user=<?php echo $videoDetails["videoAuthor"]; ?>">Friends</a> (16)
                                                            </div>

                                                            <div class="watchDetails">
                                                                Views: <?php echo $videoDetails['videoViews']; ?> | <a href="#comment">Comments</a>: 8 </div>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <!-- watchTable -->

                                            <div style="padding: 15px 0px 10px 0px;">
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#E5ECF9" align="center">
                                                    <tbody>
                                                        <tr>
                                                            <td><img src="yts/imgbin/box_login_tl.gif" width="5" height="5"></td>
                                                            <td width="100%"><img src="yts/imgbin/pixel.gif" width="1" height="5"></td>
                                                            <td><img src="yts/imgbin/box_login_tr.gif" width="5" height="5"></td>
                                                        </tr>
                                                        <tr>
                                                            <form name="linkForm" id="linkForm"></form>
                                                            <td><img src="yts/imgbin/pixel.gif" width="5" height="1"></td>
                                                            <td align="center">

                                                                <div style="font-size: 11px; font-weight: bold; color: #CC6600; padding: 5px 0px 5px 0px;">Share this video! Copy and paste this link:</div>
                                                                <div style="font-size: 11px; padding-bottom: 15px;">
                                                                    <input name="video_link" type="text" onclick="javascript:document.linkForm.video_link.focus();document.linkForm.video_link.select();" value="http://www.youtube.com/?v=<?php echo $id; ?>" size="50" readonly="true" style="font-size: 10px; text-align: center;">
                                                                </div>

                                                            </td>
                                                            <td><img src="yts/imgbin/pixel.gif" width="5" height="1"></td>

                                                        </tr>
                                                        <tr>
                                                            <td><img src="yts/imgbin/box_login_bl.gif" width="5" height="5"></td>
                                                            <td><img src="yts/imgbin/pixel.gif" width="1" height="5"></td>
                                                            <td><img src="yts/imgbin/box_login_br.gif" width="5" height="5"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <a name="comment"></a>
                                            <div style="padding-bottom: 5px; font-weight: bold; color: #444;">Comment on this video:</div>

                                            <form name="comment_form" id="comment_form" method="post" action="add_comment.php" target="invisible" onsubmit="return CommentHandler();">
                                                <input type="hidden" name="video_id" value="vy8evhya_9E">

                                                <textarea name="comment" cols="55" rows="3"></textarea>
                                                <br>
                                                <input type="submit" name="comment_button" value="Add Comment">


                                            </form>
                                            <br>

                                            <div class="commentsTitle">Comments (8):</div>

                                            <div class="commentsEntry">"nice shot"<br>
                                                - (9 days, 15 hours, 34 minutes ago)</div>
                                            <div class="commentsEntry">"By he way, Vilnius is Lithuania's Capital. Riga is Latvia's capital is Riga. I'km living in Lthuania, so ... :) And This was performed by Jurgis Kairys.Not Paksas !!!"<br>
                                                - (29 days, 20 hours, 52 minutes ago)</div>
                                            <div class="commentsEntry">"This was done by Jurgis Kairys in Kaunas, Lithuania in 2001."<br>
                                                - (31 days, 2 hours, 33 minutes ago)</div>
                                            <div class="commentsEntry">"yeah yeah nice shot man ..."<br>
                                                - (33 days, 14 hours, 31 minutes ago)</div>
                                            <div class="commentsEntry">"This was performed by Jurgis Kairys.<br>
                                                Not Paksas"<br>
                                                - (33 days, 18 hours, 59 minutes ago)</div>
                                            <div class="commentsEntry">"Vilnius/LITHUANIA you mean ;)"<br>
                                                - (34 days, 2 hours, 38 minutes ago)</div>
                                            <div class="commentsEntry">"This trick was done in Vilnius/Latvia in Eastern Europe (old USSR baltiv republic) by Mr Paksas formerly known as later president of this country...deleted by impeachment ;))"<br>
                                                - (40 days, 19 hours, 44 minutes ago)</div>
                                            <div class="commentsEntry">"awsome!"<br>
                                                - <a href="profile.php?user=larfus">larfus</a> // <a href="profile_videos.php?user=larfus">Videos</a> (41) | <a href="profile_favorites.php?user=larfus">Favorites</a> (6) | <a href="profile_friends.php?user=larfus">Friends</a> (0) - (41 days, 13 hours, 53 minutes ago)</div>
                                        </td>
                                        <td width="280">

                                            <table width="280" cellspacing="0" cellpadding="0" border="0" bgcolor="#CCCCCC" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td><img src="yts/imgbin/box_login_tl.gif" width="5" height="5"></td>
                                                        <td><img src="yts/imgbin/pixel.gif" width="1" height="5"></td>
                                                        <td><img src="yts/imgbin/box_login_tr.gif" width="5" height="5"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="yts/imgbin/pixel.gif" width="5" height="1"></td>
                                                        <td width="270">
                                                            <div class="moduleTitleBar">
                                                                <table width="270" cellspacing="0" cellpadding="0" border="0">
                                                                    <tbody>
                                                                        <tr valign="top">
                                                                            <td>
                                                                                <div class="moduleFrameBarTitle">Tag // <?php echo htmlspecialchars($videoDetails['videoTitle']); ?></div>
                                                                            </td>
                                                                            <td style="text-align:right;">
                                                                                <div style="font-size: 11px; margin-right: 5px;"><a href="results.php?&amp;search=aerobatic+sukhoi+airplane+stunt+trick" target="_parent">See more Results</a></div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>


                                                        </td>
                                                        <td><img src="yts/imgbin/pixel.gif" width="5" height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="yts/imgbin/box_login_bl.gif" width="5" height="5"></td>
                                                        <td><img src="yts/imgbin/pixel.gif" width="1" height="5"></td>
                                                        <td><img src="yts/imgbin/box_login_br.gif" width="5" height="5"></td>
                                                    </tr>
                                                </tbody>
                                            </table><br>

                                            <table width="280" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFCC" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td><img src="yts/imgbin/box_login_tl.gif" width="5" height="5"></td>
                                                        <td><img src="yts/imgbin/pixel.gif" width="1" height="5"></td>
                                                        <td><img src="yts/imgbin/box_login_tr.gif" width="5" height="5"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="yts/imgbin/pixel.gif" width="5" height="1"></td>
                                                        <td width="270">
                                                            <div style="padding: 5px;">
                                                                <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                                                                </script>
                                                            </div>
                                                        </td>
                                                        <td><img src="yts/imgbin/pixel.gif" width="5" height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="yts/imgbin/box_login_bl.gif" width="5" height="5"></td>
                                                        <td><img src="yts/imgbin/pixel.gif" width="1" height="5"></td>
                                                        <td><img src="yts/imgbin/box_login_br.gif" width="5" height="5"></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div style="font-weight: bold; color: #333; margin: 10px 0px 5px 0px;">Related tags:</div>
                                            <?php
                                            // echo tags
                                            for ($i = 0; $i < $tagcount; $i++) {
                                            ?>
                                                <div style="padding: 0px 0px 5px 0px; color: #999;">» <a href="results.php?search=<?php echo $tags[$i]; ?>" target="_blank"><?php echo $tags[$i]; ?></a></div>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                    </tr>



                                </tbody>
                            </table>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table cellspacing="0" cellpadding="10" border="0" align="center">
            <tbody>
                <tr>
                    <td valign="center" align="center"><span class="footer"><a href="whats_new.php">What's New</a> | <a href="about.php">About Us</a> | <a href="help.php">Help</a> | <a href="terms.php">Terms of Use</a> | <a href="privacy.php">Privacy Policy</a>
                            <br><br>Copyright © 2005 YouTube, LLC™. Frontend made by <a href="https://github.com/pixdoet">Ian</a> | <a href="rss/global/recently_added.rss"><img src="yts/imgbin/rss.gif" style="vertical-align: text-top;" width="36" height="14" border="0"></a></span></td>
                </tr>
            </tbody>
        </table>



    </body>

    </html>

<?php } ?>