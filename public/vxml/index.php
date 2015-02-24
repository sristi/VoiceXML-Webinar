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

            <prompt>from Nex mo.</prompt>
        </block>

        <field name="department">
            <prompt>Press 1 or say sales, press 2 or say support.</prompt>
            <grammar mode="voice" root="toplevel">
                <rule id="toplevel">
                    <one-of>
                        <item> sales </item>
                        <item> support </item>
                    </one-of>
                </rule>
            </grammar>
            <grammar mode="dtmf" root="toplevel">
                <rule id="toplevel">
                    <one-of>
                        <item> 1 <tag> out.department="sales"; </tag></item>
                        <item> 2 <tag> out.department="support"; </tag></item>
                    </one-of>
                </rule>
            </grammar>
            <filled>
                <prompt>You said <value expr="department" /></prompt>
            </filled>
        </field>
    </form>
</vxml>