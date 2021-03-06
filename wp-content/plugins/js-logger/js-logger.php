<?php

/* 

Plugin Name: JavaScript Logger

Description: Log all JavaScripts errors. Log stored in plugin directory in errors.txt

Version: 0.1.0

Author: Inverse Paradox 

*/

function js_logger($type){ ?>
    
    <script type="text/javascript">
        window.onerror = function(message, file, line) {
            var error_log = '<?php echo plugins_url('/ajax.php',__FILE__);?>';
            var error_msg = '<?php echo $type;?> [<?php echo date("m-d-Y g:i:s A",time());?>]: ' + file + ' on line ' + line + '\n' + message + '\n' + navigator.userAgent + '\n\n';
            jQuery.ajax({
                type: 'POST',
                url: error_log,
                data: {error : error_msg}
            }); 
        };
    </script>

<?php }
	
function logger_admin(){js_logger('admin');}
function logger_frontend(){js_logger('frontend');}
// admin
add_action('admin_head','logger_admin', 0);

// front-end
add_action('wp_head', 'logger_frontend', 0);

?>
