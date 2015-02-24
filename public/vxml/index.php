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
            <prompt>Say a product and a department</prompt>
            <grammar mode="voice" root="toplevel">
                <rule id="toplevel">
                    <ruleref uri="#product"/> <ruleref uri="#department"/>
                </rule>

                <rule id="product">
                    <one-of>
                        <item> sms </item>
                        <item> voice </item>
                        <item> verify </item>
                    </one-of>
                </rule>

                <rule id="department">
                    <one-of>
                        <item> sales </item>
                        <item> support </item>
                    </one-of>
                </rule>
            </grammar>
            <filled>
                <prompt>You said <value expr="department" /></prompt>
            </filled>
        </field>
    </form>
</vxml>