<?php

function mimf_get_slogans()
{
    // add list of slogans
    $slogans = "See you space cowboy
All limitations are self-imposed
Never regret anything that made you smile
Change the game, don’t let the game change you
I'm not going there to die. I'm going to find out if I'm really alive
Men always seem to think about their past before they die, as though they were frantically searching for proof that they truly lived.
Bang
Yesterday you said tomorrow. Just do it.
I have nothing to lose but something to gain
Normality is a paved road: it’s comfortable to walk but no flowers grow.
Oh the things you can find, if you don’t stay behind
I don’t need it to be easy, I need it to be worth it
Reality is wrong, dreams are for real
Try to be a rainbow in someone’s cloud";

    //split it into lines
    $slogans = explode("\n", $slogans);

    //randomly choose a line
    return wptexturize($slogans[ mt_rand(0, count($slogans) - 1) ]);
}

//echoes the chosen random line
function mimf_happy()
{
    $chosen = mimf_get_slogans();

    if (get_option('mimf_slogan_show')) {
        echo "<p id='happy-slogan'>$chosen</p>";
    } else {
        echo "<p id='happy-slogan2'><strong>See you space cowboy</strong></p>";
    }
}

add_action('admin_notices', 'mimf_happy');

//CSS to position the slogan
function mimf_happy_css()
{
    // This makes sure that the positioning is also good for right-to-left languages
    $x = is_rtl() ? 'left' : 'right';

    echo "
	<style type='text/css'>
	#happy-slogan {
		float: $x;
		padding-$x: 30px;
		padding-top: 5px;
		margin: 0;
		font-size: 11px;
	}
  #happy-slogan2 {
		float: $x;
		padding-$x: 30px;
		padding-top: 5px;
		margin: 0;
		font-size: 14px;
    font-family: 'ZCOOL QingKe HuangYou', cursive;
	}
	.block-editor-page #happy-slogan {
		display: none;
	}
	</style>
	";
}

add_action('admin_head', 'mimf_happy_css');
