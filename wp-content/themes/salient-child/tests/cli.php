<?php
//error_reporting(-1);
/**
 * ----------------------------------------------------
 * CLI tool to quickly test/debug specific API methods.
 * ----------------------------------------------------
 */

// composer auto loader
require __DIR__.'/../vendor/autoload.php';

define('BENCHMARK_ENABLED', false);
define('LOGGER_ENABLED', false);
define('LOGGER_ENABLE_PRINT_TIME', false);

// parse characters
// view Lodestone/Modules/Routes for more urls.

$option = 'fc';
$id = isset($argv[2]) ? trim($argv[2]) : false;
if (!$option) {
    die('Please provide an option: character, fc, ls');
}

// create api instance
$api = new \Lodestone\Api;

// switch on options
$hash = false;
switch($option) {
    case 'character':
        $data = $api->getCharacter(15831245);
        break;

    case 'character_friends':
        $data = $api->getCharacterFriends($id ? $id : 730968);
        break;

    case 'fc':
        $data = $api->getFreeCompanyMembers($id ? $id : '9234490298434916243');
        break;

    case 'ls':
        $data = $api->getLinkshellMembers($id ? $id : '19984723346535274');
        break;

    case 'devposts':
        $data = $api->getDevPosts();
        break;

    case 'lodestone_topics':
        $data = $api->getLodestoneTopics();
        break;
}

if (!$data) {
    print_r("\nNo data, was the command correct? > ". $option);
    print_r("\n");
    die;
}

$data = json_encode($data);



?>

<!DOCTYPE html>
<html>
<head>
    <title>Hello World</title>
    <style type="text/css">
    body {
        background: #1a2330;
        padding-top: 5%;
    }
    img {
            width: 50px;
    float: left;
    height: auto;
    margin-right: 10px;
    }
    ul {
            max-width: 1100px;
    margin: 0 auto;
    }
    li {
            background: #232e3e;
    border: 1px solid #3c4858;
    display: inline-block;
    margin: 2px 5px;
    border-radius: 3px;
    overflow: hidden;
    width: 250px;
}
li:hover {
    background: #2d3a4e;
    transition: all .3s ease;
    cursor: pointer;
}

        .name {
     color: #f7d13f;
    font-weight: 700;
    line-height: 100%;
        }
        .rank {
            color: #8391a7;
    line-height: 100%;
        }
    </style>
</head>
<body>

<ul id="fcList">

</ul>

</body>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<script type="text/javascript">
    
var stuff = <?php print $data; ?>;



console.info("THE OBJECT", stuff.members);

for(var i = 0; i < stuff.members.length; i++) {
 var str = "<li><img src='" + stuff.members[i].avatar + "'><span class='name'>" + stuff.members[i].name + "</span><br><span class='rank'>" + stuff.members[i].rank + "</span></li>";
 $("#fcList").append(str);
}




</script>
</html>