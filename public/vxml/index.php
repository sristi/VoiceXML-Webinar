<?php
$morning = new DateTime('6am');
$noon = new DateTime('12pm');
$evening = new DateTime('6pm');

$now = new DateTime();

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<vxml version = "2.1">
    <form>
        <block>
            <?php if($now < $morning): ?>
                <prompt>You're working late - or early, best to you </prompt>
            <?php elseif($now < $noon): ?>
                <prompt>Well good morning </prompt>
            <?php elseif($now < $evening): ?>
                <prompt>Good afternoon </prompt>
            <?php else: ?>
                <prompt>A good evening</prompt>
            <?php endif; ?>

            <prompt>from Nex mo</prompt>
        </block>
    </form>
</vxml>