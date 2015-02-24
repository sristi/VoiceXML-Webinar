<?php
$morning = new DateTime('6am');
$noon = new DateTime('12pm');
$evening = new DateTime('6pm');

$now = new DateTime();

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<vxml version = "2.1">
    <var name="department" expr=""/>
    <var name="message" expr=""/>

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
                <prompt>You said <value expr="department" />.</prompt>
            </filled>
        </field>

        <record name="message">
            <prompt>Please leave a message for that department.</prompt>
            <filled>
                <prompt>Here's your message <value expr="message" />.</prompt>
            </filled>
        </record>

        <filled>
            <assign name="document.department" expr="department" />
            <assign name="document.message" expr="message" />

            <prompt>Thanks for contacting us.</prompt>
            <goto next="#status" />
        </filled>
    </form>

    <form id="status">
        <field name="status">
            <prompt>Press 1 for urgent, press 2 for normal delivery.</prompt>
            <grammar mode="dtmf" root="toplevel">
                <rule id="toplevel">
                    <one-of>
                        <item> 1 </item>
                        <item> 2 </item>
                    </one-of>
                </rule>
            </grammar>
        </field>

        <filled>
            <if cond="status == 1">
                <prompt>Your message will be delivered urgently.</prompt>
            </if>
            <if cond="status == 2">
                <prompt>Your message will be delivered normally.</prompt>
            </if>

            <submit next="http://requestb.in" namelist="status department message" method="post" enctype="multipart/form-data"/>
        </filled>
    </form>
</vxml>