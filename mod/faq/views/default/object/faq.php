<?php

global $CONFIG;

$faq = $vars["entity"];
$selected = $vars["selected"];
$hitcount = $vars["hitcount"];

if(elgg_is_admin_logged_in()) {
    $delBody = elgg_view("input/hidden", array("name" => "guid", "value" => $faq->guid));
    $delForm = elgg_view("input/form", array("id" => "delForm" . $faq->guid, "action" => $CONFIG->wwwroot . "action/faq/delete", "body" => $delBody));
}

?>

<div>
    <table>
        <tr>
            <?php if(elgg_is_admin_logged_in()) { ?>
                <td><div id="faqSelect<?php echo $faq->guid; ?>" class="faqSelect"><input type="checkbox" name="selectQuestion" id="selectQuestion<?php echo $faq->guid; ?>" value="<?php echo $faq->guid; ?>" /></div></td>
            <?php } ?>
            <td width="100%">
                <?php if(!empty($hitcount)) { ?>
                    <a href="<?php echo $CONFIG->wwwroot; ?>faq/list?categoryId=<?php echo get_metastring_id($faq->category); ?>"><?php echo $faq->category; ?></a>&nbsp;>
                <?php } ?>
                <a href="javascript:void(0);" id="qID<?php echo $faq->guid; ?>" onClick="$('#aID<?php echo $faq->guid; ?>').toggle();"><?php echo $faq->question; ?></a>
            </td>
            <?php if(!empty($hitcount)) { ?>
                <!-- Hitcounter -->
                <td class="hitcount"><?php echo elgg_echo("faq:search:hitcount") . " " . $hitcount; ?></td>
            <?php } ?>
            <?php if(elgg_is_admin_logged_in()) { ?>
                <!-- ADMIN options -->
                <td>
                    <div class="faqedit" onClick="document.location.href='<?php echo $CONFIG->wwwroot; ?>faq/edit?id=<?php echo $faq->guid; ?>'"></div>
                </td>
                <td>
                    <div class="elgg-icon elgg-icon-delete" onClick="$('#delForm<?php echo $faq->guid; ?>').submit();">
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('#delForm<?php echo $faq->guid; ?>').submit(function(){
                                    return confirm("<?php echo elgg_echo("faq:delete:confirm"); ?>");
                                });
                            });
                        </script>
                        <?php echo $delForm; ?>
                    </div>
                </td>
            <?php } ?>
        </tr>
    </table>
    <div id="aID<?php echo $faq->guid; ?>" class="answer">
        <?php echo $faq->answer; ?>
    </div>
</div>
