<div class="row">
    <?php
    // use this instagram access token generator http://instagram.pixelunion.net/
    $access_token="48280409.1677ed0.50157b2b2361449fab5e79b066f1e49d";
    $photo_count=9;

    $json_link="https://api.instagram.com/v1/users/self/media/recent/?";
    $json_link.="access_token={$access_token}&count={$photo_count}";

    $json = file_get_contents($json_link);
    $obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

    foreach ($obj['data'] as $post) {

    $pic_text=$post['caption']['text'];
    $pic_link=$post['link'];
    $pic_like_count=$post['likes']['count'];
    $pic_comment_count=$post['comments']['count'];
    $pic_src=str_replace("http://", "https://", $post['images']['standard_resolution']['url']);
    $pic_created_time=date("F j, Y", $post['caption']['created_time']);
    $pic_created_time=date("F j, Y", strtotime($pic_created_time . " +1 days"));

    echo "<div class='col-md-4 col-sm-6 col-xs-12 item_box'>";
    echo "<a href='{$pic_link}' target='_blank'>";
    echo "<img class='img-responsive photo-thumb' src='{$pic_src}' alt='{$pic_text}'>";
    echo "</a>";
    echo "<p>";
    echo "<p>";
    echo "<div style='color:#888;'>";
    echo "<a href='{$pic_link}' target='_blank'>{$pic_created_time}</a>";
    echo "</div>";
    echo "</p>";
    echo "<p>{$pic_text}</p>";
    echo "</p>";
    echo "</div>";
}
?>

<h1 class="pics"><a href="https://instagram.com/mistabasco">More images here</a></h1>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->