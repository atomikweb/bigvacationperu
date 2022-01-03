<?php

global $wpdb;
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
$message = '';

if (isset($_POST['bannerbtn'])) {
    if ($mode == 'edit') {
        $wpdb->update($wpdb->prefix . 'polls', array('poll_question' => addslashes($_POST['poll_question']), 'poll_options' => $_POST['poll_options']), array('id' => $_POST['bannerid']));
    } else {
        $wpdb->insert($wpdb->prefix . 'polls', array('poll_question' => addslashes($_POST['poll_question']), 'poll_options' => $_POST['poll_options']));
    }
    $message = __('Record has been saved.', 'eaddons');
}
if ($mode == 'delete') {
    $wpdb->query("delete from " . $wpdb->prefix . "polls where id=$_REQUEST[pid]");
    $message = __('Record has been deleted.', 'eaddons');
} ?>

<div id="wrap">
    <div class="wrap">
        <h2> <img src="<?php echo  plugin_dir_url(dirname(__FILE__)); ?>assets/img/addons.png"><?php _e('Community Polls', 'eaddons'); ?>
            <a href="<?php echo admin_url('admin.php?page=eaddons-polls'); ?>&mode=add" class="button button-primary button-small"><?php _e('Add New', 'eaddons'); ?></a>
        </h2>
    </div>
    <?php if (!empty($message)) : ?>
        <div class="wrap">
            <div id="message" class="updated" style="margin-left:0; padding:10px;"><?php echo $message; ?></div>
        </div>
    <?php endif; ?>
    <table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
        <tr>
            <td width="40%">
                <table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
                    <form name="bannerfrm" action="" method="post" enctype="multipart/form-data">
                        <?php
                        if ($mode == 'edit') {
                            $result_update = $wpdb->get_row("select * from " . $wpdb->prefix . "polls where id=$_REQUEST[pid]");
                        } ?>
                        <thead>
                            <tr>
                                <th> <strong>
                                        <?php
                                        if ($mode == 'edit') {
                                            echo __('Update', 'eaddons');
                                        } else {
                                            echo __('Add', 'eaddons');
                                        }
                                        _e('Community Polls', 'eaddons'); ?></strong>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <label> <?php _e('Questions', 'eaddons'); ?> : </label> <br /> <input type="text" name="poll_question" style="width:100%;" id="poll_question" value="<?php if ($mode == 'edit') {
                                                                                                                                                                                                echo stripslashes($result_update->poll_question);
                                                                                                                                                                                            } ?>" />
                                    <input type="hidden" name="bannerid" value="<?php if ($mode == 'edit') echo $result_update->id; ?>" />
                                    <p class="howto"> <?php _e('Please add questions here.', 'eaddons'); ?> </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label> <?php _e('Options', 'eaddons'); ?> : </label> <br />
                                    <textarea name="poll_options" id="poll_options" style="width:100%; height:60px;"><?php if ($mode == 'edit') {
                                                                                                                            echo stripslashes($result_update->poll_options);
                                                                                                                        } ?></textarea>
                                    <p class="howto">
                                        <?php
                                        $thisurl = 'https://developers.facebook.com/docs/apps/register';
                                        _e('Please add question\'s options here. Separate options with "%%". ( E. g. <code> the time of day%% the speaker%% your prejudices%% all of the above.</code>)', 'eaddons'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="submit" class="button button-primary button-large" name="bannerbtn" value="<?php esc_attr_e('Save',  'eaddons'); ?>" style="cursor:pointer;" /></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>
                                    <?php
                                    $thisurl = admin_url('widgets.php');
                                    echo sprintf(wp_kses(__('<strong>Note</strong>: Please <a href="%s">click here</a> to activate poll in sidebar.', 'eaddons'), array('a' => array('href' => array()))), esc_url($thisurl)); ?>
                                </th>
                            </tr>
                        </tfoot>

                    </form>
                </table>
            </td>
            <td width="60%">
                <table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="31%"><?php _e("Questions", "eaddons"); ?> </th>
                            <th width="20%"><?php _e("Options", "eaddons"); ?></th>
                            <th width="15%"><?php _e("Date", "eaddons"); ?></th>
                            <th width="12%"><?php _e("Active Poll", "eaddons"); ?></th>
                            <th width="15%"><?php _e("Actions", "eaddons"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $wpdb->get_results("select * from " . $wpdb->prefix . "polls WHERE 1= 1 order by id DESC ");
                        $active_poll_id =  $this->eaddons_active_poll();
                        if ($result) {
                            $count = 1;
                            $class = '';
                            foreach ($result as $entry) {
                                $total_vote = $this->eaddons_count_poll_option_result($entry->id, '');
                                if ($count % 2 == 1) {
                                    $class = 'class="alternate "';
                                } else {
                                    $class = '';
                                } ?>

                                <tr <?php echo $class; ?>>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo stripslashes($entry->poll_question); ?></td>
                                    <td><?php
                                                $poll_options = explode('%%', $entry->poll_options);
                                                $datapoints = array();
                                                $title = array();
                                                if (count($poll_options) > 0) {
                                                    $cnt = 0;
                                                    echo '<ul class="poll_options">';
                                                    foreach ($poll_options as $opt) {
                                                        $cnt++;
                                                        echo '<li>' . ucwords($opt) . '</li>';
                                                        /* Graph data start here */
                                                        $option_vote = $this->eaddons_count_poll_option_result($entry->id, $cnt);
                                                        $vote_percentage = $this->eaddons_poll_option_vote_percentage($total_vote, $option_vote);
                                                        if (empty($vote_percentage)) {
                                                            $vote_percentage = 0;
                                                        }
                                                        $datapoints[] = array(
                                                            "headline"     => $opt,
                                                            "value"         => intval($vote_percentage),
                                                            "length"         => 100,
                                                            "description"     => $opt . ', Vote : ' . $option_vote . ', Percentage : ' . intval($vote_percentage) . '%'
                                                        );
                                                        /* Graph data ends here */
                                                    }
                                                    echo '</ul>';
                                                } ?>
                                        <script type="text/javascript">
                                            jQuery(document).ready(function() {
                                                object = <?php echo json_encode($datapoints); ?>;
                                                jQuery("#eaddons-pie-chart-<?php echo $entry->id; ?>").skillset({
                                                    object: object,
                                                    duration: 40
                                                });
                                            });
                                        </script>

                                    </td>
                                    <td><?php echo date('Y-m-d', strtotime($entry->added_date));  ?></td>

                                    <td>
                                        <?php if (!empty($active_poll_id) && $active_poll_id == $entry->id) {
                                                    echo '<img title="Active Poll" src="' . plugin_dir_url(dirname(__FILE__))  . 'assets/img/active.png">';
                                                } ?>
                                    </td>
                                    <td><a href="#TB_inline?width=340&height=450&inlineId=poll-result-<?php echo $entry->id; ?>" class="thickbox"><img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>assets/img/graph.png" title="View Result"> </a> &nbsp;<a href="<?php echo admin_url('admin.php?page=eaddons-polls'); ?>&pid=<?php echo $entry->id; ?>&mode=edit"><img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>assets/img/edit.png" title="Edit"></a> &nbsp;<a href="<?php echo admin_url('admin.php?page=eaddons-polls'); ?>&pid=<?php echo $entry->id; ?>&mode=delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>assets/img/delete.png" title="Delete"> </a></td>
                                </tr>
                            <?php
                                    $count++;
                                }
                            } else { ?>
                            <tr class="alternate ">
                                <td colspan="6"><?php _e("No Record Found.", "eaddons"); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%">#</th>
                            <th width="31%"><?php _e("Questions", "eaddons"); ?> </th>
                            <th width="20%"><?php _e("Options", "eaddons"); ?></th>
                            <th width="15%"><?php _e("Date", "eaddons"); ?></th>
                            <th width="12%"><?php _e("Active Poll", "eaddons"); ?></th>
                            <th width="15%"><?php _e("Actions", "eaddons"); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>
    <?php
    if ($result) {
        foreach ($result as $entry) {
            $total_vote = $this->eaddons_count_poll_option_result($entry->id, ''); ?>
            <div id="poll-result-<?php echo $entry->id; ?>" style="display:none;">
                <p class="question_title">Q. <?php echo stripslashes($entry->poll_question); ?> </p>
                <div id="eaddons-pie-chart-<?php echo $entry->id; ?>" class="column"> </div>
                <p class="question_title"> <strong><?php _e('Total Votes', 'eaddons'); ?> : <?php echo $total_vote; ?></strong></p>
            </div>
    <?php
        }
    } ?>
</div>
<style>
    .poll_options {
        margin: 0;
        padding: 0;
    }

    .poll_options li {
        list-style: lower-alpha;
    }

    .question_title {
        padding-bottom: 20px;
    }
</style>